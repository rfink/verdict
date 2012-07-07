<?php

/**
 * Interface defining public access to segment objects.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  May 14, 2012
 */

namespace Verdict\Segment;

interface SegmentInterface
{
    /**
     * Is our current object a leaf node
     * @return boolean
     */
    public function isLeafNode();
    
    /**
     * Run the evaluations on the tree and return the first leaf node
     * @return SegmentInterface
     */
    public function getLeafNode();
    
    /**
     * Return an array of all nodes that are leaves
     * @return array
     */
    public function getAllLeaves();
}