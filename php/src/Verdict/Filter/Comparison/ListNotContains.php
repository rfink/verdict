<?php

/**
 * Compile our configuration to a "list not contains" (!in_array) clause.
 * @author  Ryan Fink <rfink@redventures.net>
 * @since   May 15, 2012
 */

namespace Verdict\Filter\Comparison;

use Verdict\Filter\FilterInterface,
    InvalidArgumentException;

class ListNotContains extends ComparisonAbstract implements FilterInterface, ComparisonInterface
{
    /**
     * @inheritDoc
     */
	protected $requiredParams = array(
		'configValue'
	);

    /**
     * @inheritDoc
     */
	public function evaluate()
	{
        $value = $this->context->getValue($this->contextKey);
        if (!is_array($value))
        {
            throw new InvalidArgumentException('Property ' . $this->contextKey . ' is not an array');
        }
        return !in_array($this->params['configValue'], $value);
	}
    
    /**
     * @inheritDoc
     */
    public static function getDisplay()
    {
        return 'List Not Contains';
    }
}
