<?php

/**
 * Service used to discover available context values.
 * @return Ryan Fink <ryanjfink@gmail.com>
 * @since  May 14, 2012
 */

namespace Verdict\Service\Context;

use Verdict\Context\ContextInterface,
    Verdict\Context\Property\PropertyInterface;

class Discover
{
    /**
     * Convert our context to a generic json array
     * @param ContextInterface $context 
     * @return array
     */
    public function toJson(ContextInterface $context)
    {
        return $this->doConvertJson($context);
    }
    
    /**
     * Recursive conversion of our context to a generic json array
     * @param ContextInterface $context
     * @param array $ret
     * @return array
     */
    private function doConvertJson(ContextInterface $context)
    {
        $ret = array();
        // Iterate the properties
        foreach($context->getProperties() as $key => $property)
        {
            if ($property instanceof PropertyInterface)
            {
                $excludedDrivers = array_map('lcfirst', $property->getProperty('excludedDrivers'));
                $includedDrivers = array_map('lcfirst', $property->getProperty('includedDrivers'));
                $ret[$key] = array(
                    'isRestrictedSet' => (boolean) $property->getProperty('isRestrictedSet'),
                    'excludedDrivers' => $excludedDrivers,
                    'includedDrivers' => $includedDrivers,
                    'hasSource' => is_callable($property->getProperty('getSource')),
                    'isContextProperty' => true
                );
                // Strip the namespace
                $className = array_pop(explode('\\', get_class($property->getType())));
                // Lowercase the first letter, get rid of the "type" suffix
                $ret[$key]['type'] = lcfirst(str_replace('Type', '', $className));
            }
            else
            {
                $ret[$key] = $this->doConvertJson($property);
            }
        }
        return $ret;
    }
}
