<?php

/**
 * Validator service for the segment tree.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  May 14, 2012
 */

namespace Verdict\Service\Tree;

use Verdict\Segment\Tree,
    Verdict\Filter\Comparison\Truth,
    Verdict\Filter\FilterInterface,
    RuntimeException;

class Validator
{
    /**
     * Our tree object
     * @var Tree
     */
    private $tree = null;
    
    /**
     * Constructor
     * @param Tree $tree
     */
    public function __construct(Tree $tree)
    {
        $this->tree = $tree;
    }
    
    /**
     * Validate our tree, throw an exception if invalid
     * @return void
     * @throws RuntimeException
     */
    public function validate()
    {
        $this->validateNode($this->tree);
    }
    
    /**
     * Validate given segment tree (or subtree, whatever it happens to be)
     * @param Tree $tree 
     * @return void
     * @throws RuntimeException
     */
    private function validateNode(Tree $tree)
    {
        $children = $tree->getChildren();
        for ($i = 0, $len = count($children); $i < $len; ++$i)
        {
            if ($i === ($len - 1))
            {
                break;
            }
            $condition = $children[$i]->getCondition();
            $segmentName = $children[$i]->getSegmentName();
            if (!(isset($condition)))
            {
                throw new RuntimeException('The segment ' . $segmentName . ' is not a default node, but has no valid condition');
            }
            $conditionType = $this->getConditionType($condition);
            if ($conditionType === 'composite')
            {
                $this->validateComposite($condition, $segmentName);
            }
            else if ($conditionType === 'comparison')
            {
                $this->validateComparison($condition, $segmentName);
            }
            $this->validateNode($children[$i]);
        }
    }
    
    /**
     * Validate our comparison object
     * @param FilterInterface $condition
     * @param string $segmentName 
     * @return void
     * @throws RuntimeException
     */
    private function validateComparison(FilterInterface $condition, $segmentName)
    {
        if ($condition instanceof Truth)
        {
            throw new RuntimeException('The segment ' . $segmentName . ' is not a default node, but has an "always true" condition.');
        }
        $contextKey = $condition->getContextKey();
        if (!strlen($contextKey))
        {
            throw new RuntimeException('The segment ' . $segmentName . ' has an empty or invalid context key.');
        }
    }
    
    /**
     * Validate our composite object
     * @param FilterInterace $condition
     * @param string $segmentName
     * @return void
     * @throws RuntimeException
     */
    private function validateComposite(FilterInterface $condition, $segmentName)
    {
        $conditionType = $this->getConditionType($condition);
        if ($conditionType === 'composite')
        {
            $children = $condition->getItems();
            if (!count($children))
            {
                throw new RuntimeException('The segment ' . $segmentName . ' has a composite condition but no children');
            }
            for ($i = 0, $len = count($children); $i < $len; ++$i)
            {
                $this->validateComposite($children[$i], $segmentName);
            }
        }
        else
        {
            $this->validateComparison($condition, $segmentName);
        }
    }
    
    /**
     * Get our condition type from the condition object
     * @param FilterInterface $condition
     * @return string
     * @throws RuntimeException
     */
    private function getConditionType(FilterInterface $condition)
    {
        $conditionClass = get_class($condition);
        if (stripos($conditionClass, 'Verdict\\Filter\\Composite') !== false)
        {
            return 'composite';
        }
        else if (stripos($conditionClass, 'Verdict\\Filter\\Comparison') !== false)
        {
            return 'comparison';
        }
        else
        {
            throw new RuntimeException('Invalid condition type specified');
        }
    }
}
