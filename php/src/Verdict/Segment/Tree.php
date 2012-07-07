<?php

/**
 * Generic "tree" class for verdict, allows verdict objects to be nested indefinitely, allowing
 *   deep configurations.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  May 14, 2012
 */

namespace Verdict\Segment;

use Verdict\Filter\FilterInterface,
    InvalidArgumentException;

class Tree implements SegmentInterface
{
    /**
     * Child tree objects
     * @var array
     */
    private $children = array();
    
    /**
     * Pointer to parent object (null for root)
     * @var Tree
     */
    private $parent = null;
    
    /**
     * Segment name
     * @var string
     */
    private $segmentName = null;
    
    /**
     * Segment id
     * @var integer
     */
    private $segmentId = null;
    
    /**
     * Our filter object, can be anything that implements the filter interface
     * @var FilterInterface
     */
    private $condition = null;
    
    /**
     * Counter (ordering) of leaf
     * @var integer
     */
    private $counter = null;
    
    /**
     * Constructor
     * @param FilterInterface $condition 
     */
    public function __construct(FilterInterface $condition = null)
    {
        $this->condition = $condition;
    }
    
    public function getSegmentName()
    {
        return $this->segmentName;
    }
    
    /**
     * Set the segment name
     * @param string $name
     * @return Tree 
     */
    public function setSegmentName($name)
    {
        $this->segmentName = $name;
        return $this;
    }
    
    public function getSegmentId()
    {
        return $this->segmentId;
    }
    
    /**
     * Set the segment id
     * @param integer $segmentId
     * @return Tree 
     */
    public function setSegmentId($segmentId)
    {
        $this->segmentId = $segmentId;
        return $this;
    }
    
    /**
     * Get our condition
     * @return FilterInterface
     */
    public function getCondition()
    {
        return $this->condition;
    }
    
    /**
     * Set parent pointer
     * @param Tree $parent
     * @return Tree 
     */
    public function setParent(Tree $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }
    
    /**
     * Add child to our internal array
     * @param Tree $child
     * @return Tree 
     */
    public function addChild(Tree $child)
    {
        $this->children[] = $child;
        return $this;
    }
    
    /**
     * Set all children at once
     * @param array $children
     * @return Tree 
     */
    public function setChildren(array $children)
    {
        /* @var $child Tree */
        foreach ($children as $child)
        {
            $this->addChild($child);
        }
        return $this;
    }
    
    /**
     * Get children
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }
    
    /**
     * Set our counter var
     * @param integer $counter 
     * @return Tree
     */
    public function setCounter($counter)
    {
        $this->counter = (integer) $counter;
        return $this;
    }
    
    /**
     * Get our counter var
     * @return integer
     */
    public function getCounter()
    {
        return $this->counter;
    }
    
    /**
     * Evaluate our condition and return the boolean result
     * @return boolean
     */
    public function evaluateCondition()
    {
        if (isset($this->condition))
        {
            return $this->condition->evaluate();
        }
        return true;
    }
    
    /**
     * Is our tree a leaf node?
     * @return boolean
     */
    public function isLeafNode()
    {
        return (boolean) !count($this->children);
    }
    
    /**
     * Iterate our tree (in pre-order traversal) and apply the callback to each node
     * @param callback $callback 
     * @return Tree
     */
    public function each($callback)
    {
        if (!is_callable($callback))
        {
            throw new InvalidArgumentException('Callback must be a valid callable function');
        }
        $callback($this);
        /* @var $child Tree */
        foreach ($this->children as $child)
        {
            $child->each($callback);
        }
        return $this;
    }
    
    /**
     * Get our first leaf node that evaluates to true
     * @TODO: This may need to return a custom object
     * @return array
     */
    public function getLeafNode()
    {
        $path = array();
        $node = $this->walkTree($this, $path);
        return array(
            'path' => $path,
            'node' => $node
        );
    }
    
    /**
     * Get an array of all leaf nodes that evaluate to true
     * @return array
     */
    public function runAllLeafNodes()
    {
        $matchingNodes = array();
        return $this->walkAllNodes($this, $matchingNodes);
    }
    
    /**
     * Walk all nodes, append to an array each one that evaluates to true, and then return
     * @param Tree $segment
     * @param array $matchingNodes
     * @return array
     */
    private function walkAllNodes(Tree $segment, & $matchingNodes)
    {
        if ($segment->evaluateCondition())
        {
            if ($segment->isLeafNode())
            {
                $matchingNodes[] = $segment;
            }
        }
        foreach ($segment->getChildren() as $child)
        {
            $this->walkAllNodes($child, $matchingNodes);
        }
        return $matchingNodes;
    }
    
    /**
     * Private method, does the brunt of getLeafNode, but is separate to allow recursion
     * @param Tree $segment
     * @param array $path
     * @return Tree 
     */
    private function walkTree(Tree $segment, & $path)
    {   
        if (!$segment->evaluateCondition())
        {
            return null;
        }
        if ($segment->isLeafNode())
        {
            return $segment;
        }
        $path[] = $segment;
        /* @var $child Tree */
        foreach ($segment->getChildren() as $child)
        {
            $val = $this->walkTree($child, $path);
            if (isset($val))
            {
                return $val;
            }
        }
        // Branch evaluated to false, pop the last path off
        array_pop($path);
    }
    
    /**
     * Get an array of all leaves
     * @return Tree 
     */
    public function getAllLeaves()
    {
        $segments = array();
        if ($this->isLeafNode())
        {
            $segments[] = $this;
        }
        $this->each(function($segment) use (& $segments) {
            if ($segment->isLeafNode())
            {
                $segments[] = $segment;
            }
        });
        return $segments;
    }
    
    /**
     * Enumerate each leaf and return the total count
     * @return int 
     */
    public function enumerate()
    {
        $counter = 0;
        $this->setCounter($counter);
        $this->each(function($segment) use (& $counter) {
            $segment->setCounter(++$counter);
        });
        return $counter;
    }
    
}
