<?php

/**
 * "Any" filter, basically a string of "or" conditions.
 * @author  Ryan Fink <rfink@redventures.net>
 * @since   April 16, 2012
 */

namespace Verdict\Filter\Composite;

use Verdict\Filter\FilterInterface;

class Any extends CompositeAbstract implements FilterInterface
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
                return true;
            }
		}
        return false;
	}
}
