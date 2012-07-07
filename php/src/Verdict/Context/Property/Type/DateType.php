<?php

/**
 * "Date" type for verdict properties.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  May 15, 2012
 */

namespace Verdict\Context\Property\Type;

class DateType implements TypeInterface
{
    /**
     * @includeDoc
     */
    public function isRestrictedSet()
    {
        return true;
    }

    /**
     * @includeDoc
     */
    public function getExcludedDrivers()
    {
        return array();
    }
    
    /**
     * @includeDoc
     */
    public function getIncludedDrivers()
    {
        return array(
            'Equals',
            'NotEquals',
            'GreaterThan',
            'GreaterThanEqualTo',
            'LessThan',
            'LessThanEqualTo'
        );
    }
}
