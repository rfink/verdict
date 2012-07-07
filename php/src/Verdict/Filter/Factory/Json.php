<?php

/**
 * JSON specific implementation of our factory filter, takes a json string (or generic array)
 *   and builds it into a verdict filter object.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  May 14, 2012
 */

namespace Verdict\Filter\Factory;

use Verdict\Context\ContextInterface,
    Verdict\Filter\Comparison\Truth,
    ArrayIterator,
    ReflectionClass,
    RuntimeException,
    InvalidArgumentException;

class Json implements FactoryInterface
{
    /**
     * Our context object
     * @var ContextInterface
     */
    private $context = null;

    /**
     * Data array
     * @var array
     */
    private $data = array();
    
    /**
     * Instantiate our object
     * @param ContextInterface $context
     * @param type $json 
     */
    public function __construct(ContextInterface $context, $json = null)
    {
        $this->context = $context;
        if (!isset($json))
        {
            return;
        }
        // Quick type checking
        if (!is_string($json) && !is_array($json))
        {
            throw new InvalidArgumentException('JSON must be a string or array');
        }
        if (is_string($json))
        {
            $this->data = json_decode($json, true);
            $lastError = json_last_error();
            if ($lastError !== JSON_ERROR_NONE)
            {
                throw new InvalidArgumentException('Error decoding json - ' . $lastError);
            }
        }
        else
        {
            $this->data = $json;
        }
    }
    
    /**
     * Build our object and return
     * @return FilterInterface
     */
    public function build()
    {
        if (empty($this->data))
        {
            return new Truth($this->context);
        }
        return $this->getObject($this->data);
    }
    
    /**
     * Make this its own method, to allow easier recursion
     * @param array $data 
     * @return FilterInterface
     */
    private function getObject(array $data)
    {
        if (!isset($data['nodeType']) || !isset($data['nodeDriver']))
        {
            throw new RuntimeException('Node did not contain a node type or a node driver');
        }
        switch (strtolower($data['nodeType']))
        {
            case 'composite':
                $nodes = new ArrayIterator();
                foreach ((array) $data['children'] as $child)
                {
                    $nodes->append($this->getObject($child));
                }
                $reflect = new ReflectionClass('\\Verdict\\Filter\\Composite\\' . ucfirst($data['nodeDriver']));
                return $reflect->newInstance($nodes);
                break;
            case 'comparison':
                $reflect = new ReflectionClass('\\Verdict\\Filter\Comparison\\' . ucfirst($data['nodeDriver']));
                $properties = new ArrayIterator();
                // First, check if we have configured a 'config value'
                if (array_key_exists('configValue', $data))
                {
                    $properties['configValue'] = is_string($data['configValue']) ? strtolower($data['configValue']) : $data['configValue'];
                }
                // Other params to the method call, attach them to our array
                if (is_array($data['params']))
                {
                    foreach ($data['params'] as $key => $val)
                    {
                        $properties[$key] = is_string($val) ? strtolower($val) : $val;
                    }
                }
                return $reflect->newInstance($this->context, $data['contextKey'], $properties);
                break;
            default:
                throw new RuntimeException('nodeType must be either composite or comparison');
        }
    }
}
