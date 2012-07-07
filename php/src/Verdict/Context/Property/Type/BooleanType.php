<?php

/**
 * "Boolean" type for verdict properties.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  May 15, 2012
 */

namespace Verdict\Context\Property\Type;

class BooleanType implements TypeInterface
{
    /**
     * @inheritDoc
     */
    public function isRestrictedSet()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getExcludedDrivers()
    {
        return array();
    }

    /**
     * @inheritDoc
     */
    public function getIncludedDrivers()
    {
        return array(
            'Equals',
            'NotEquals'
        );
    }

    /**
     * Get source of available values
     * @return array
     */
    public function getSource($params)
    {
        return array(
            array(
                'label' => 'true',
                'value' => 1
            ),
            array(
                'label' => 'false',
                'value' => 0
            )
        );
    }
}
