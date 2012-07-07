<?php

/**
 * Abstract base class for verdict comparison objects, contains some common functionality
 *   should you care to extend it.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  May 14, 2012
 */

namespace Verdict\Filter\Comparison;

use Verdict\Context\ContextInterface,
	ArrayIterator,
	InvalidArgumentException;

abstract class ComparisonAbstract
{
    /**
     * Context object
     * @var ContextInterface
     */
    protected $context;
    /**
     * Context key from context to evaulate on
     * @var string
     */
    protected $contextKey;
	/**
	 * Array of parameters
	 * @var ArrayIterator
	 */
	protected $params;
	/**
	 * Array of required params (extended in individual comparison classes)
	 * @var array
	 */
	protected $requiredParams = array();

	/**
	 * Instantiate with dependencies
	 * @param ContextInterface $context
     * @param string $contextKey
	 * @param ArrayIterator $params
	 */
	public function __construct(ContextInterface $context = null, $contextKey = null, ArrayIterator $params = null)
    {
        $this->context = $context;
        $this->contextKey = $contextKey;
		$this->params = isset($params) ? $params : new ArrayIterator();
		// Iterate and make sure we have all the necessary parameters
		foreach ($this->requiredParams as $requiredParam)
        {
			if (!isset($params[$requiredParam]))
            {
				throw new InvalidArgumentException('Required params ' . $requiredParam . ' was not found');
			}
		}
	}
    
    public function getContextKey()
    {
        return $this->contextKey;
    }
    
    public function getParams()
    {
        return $this->params;
    }

}
