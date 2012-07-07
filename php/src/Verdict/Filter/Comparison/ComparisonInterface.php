<?php

/**
 * Interface having some convenience methods for our comparison objects.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  May 14, 2012
 */

namespace Verdict\Filter\Comparison;

interface ComparisonInterface
{
    /**
     * This gets the operator equivalent of the class
     * @return string
     */
    public static function getDisplay();
}
