<?php

/**
 * Interface for segment factory specific implementations (json, xml, etc) to implement.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  June 8, 2012
 */

namespace Verdict\Segment\Factory;

interface FactoryInterface
{
    /**
     * Build our segment tree for the given input and return
     * @return SegmentInterface
     */
    public function build();
}
