<?php

/**
 * "None" filter, basically a string of "and" conditions, negated
 * @author  Ryan Fink <rfink@redventures.net>
 * @since   April 16, 2012
 */

namespace Verdict\Filter\Composite;

use Verdict\Filter\FilterInterface;

class None extends CompositeAbstract implements FilterInterface
{
    /**
     * @inheritDoc
     */
	public function evaluate()
	{
		/* @var $item FilterInterface */
		foreach ($this->items as $item)
		{
			if ($item->evaluate())
			{
				return false;
			}
		}
		return true;
	}
}
