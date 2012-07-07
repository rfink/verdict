<?php

/**
 * Compile our configuration to a less than / equal to clause
 * @author  Ryan Fink <rfink@redventures.net>
 * @since   April 16, 2012
 */

namespace Verdict\Filter\Comparison;

use Verdict\Filter\FilterInterface;

class LessThanEqualTo extends ComparisonAbstract implements FilterInterface, ComparisonInterface
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
		return $this->context->getValue($this->contextKey) <= $this->params['configValue'];
	}
    
    /**
     * @inheritDoc
     */
    public static function getDisplay()
    {
        return '<=';
    }
}
