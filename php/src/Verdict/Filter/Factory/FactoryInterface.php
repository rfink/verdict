<?php

/**
 * Interface for our factory classes to implement.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  May 14, 2012
 */

namespace Verdict\Filter\Factory;

interface FactoryInterface
{
    /**
     * Build our verdict filter object and return it
     * @return FilterInterface
     */
    public function build();
}
