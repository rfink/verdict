<?php

/**
 * "String" type for verdict properties.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  May 15, 2012
 */

namespace Verdict\Context\Property\Type;

class StringType implements TypeInterface
{
    /**
     * @includeDoc
     */
    public function isRestrictedSet()
    {
        return false;
    }

    /**
     * @includeDoc
     */
    public function getExcludedDrivers()
    {
        return array(
            'ListContains',
            'ListNotContains'
        );
    }
    
    /**
     * @includeDoc
     */
    public function getIncludedDrivers()
    {
        return array();
    }
}
