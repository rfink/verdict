<?php

/**
 * JSON specific implementation of verdict segment tree factory, take a JSON array
 *   and turn it into a segment tree.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  May 14, 2012
 */

namespace Verdict\Segment\Factory;

use Verdict\Segment\Tree,
    Verdict\Context\ContextInterface,
    Verdict\Filter\Factory\Json as FilterFactory;

class Json implements FactoryInterface
{
    
    /**
     * Our json array
     * @var array
     */
    private $data = array();
    
    /**
     * Context object
     * @var ContextInterface
     */
    private $context = null;
    
    /**
     * Constructor
     * @param array $data
     * @param ContextInterface $context 
     */
    public function __construct(array $data, ContextInterface $context)
    {
        // TODO: Allow data to be a json string
        $this->data = $data;
        $this->context = $context;
    }
    
    /**
     * Recursively build our tree
     * @return Tree
     */
    public function build()
    {
        return $this->doBuild($this->data, $this->context);
    }
    
    /**
     * Broke this out to more easily make it recursive
     * @param array $data
     * @param ContextInterface $context
     * @return Tree 
     */
    private function doBuild(array $data, ContextInterface $context)
    {
        $filter = new FilterFactory($context, $data['Condition']);
        $tree = new Tree($filter->build());
        $tree->setSegmentName($data['segmentName']);
        $tree->setSegmentId($data['segmentId']);
        if (is_array($data['children']))
        {
            foreach ($data['children'] as $child)
            {
                $segment = $this->doBuild($child, $context);
                $segment->setParent($tree);
                $tree->addChild($segment);
            }
        }
        return $tree;
    }
    
}
