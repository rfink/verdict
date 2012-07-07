<?php

/**
 * Interface for our property types in verdict.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  May 15, 2012
 */

namespace Verdict\Context\Property\Type;

interface TypeInterface
{
    /**
     * Get default setting of is restricted set
     * @return boolean
     */
    public function isRestrictedSet();
    
    /**
     * Get a list of default excluded drivers for the type
     * @return array
     */
    public function getExcludedDrivers();
    
    /**
     * Get a list of default included drivers for the type
     * @return array
     */
    public function getIncludedDrivers();
}
