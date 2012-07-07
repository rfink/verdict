<?php

/**
 * Compile our configuration to a reg ex clause.
 * @author  Ryan Fink <rfink@redventures.net>
 * @since   April 16, 2012
 */

namespace Verdict\Filter\Comparison;

use Verdict\Filter\FilterInterface;

class RegEx extends ComparisonAbstract implements FilterInterface, ComparisonInterface
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
		return (boolean) preg_match('/' . $this->params['configValue'] . '/', $this->context->getValue($this->contextKey));
	}
    
    /**
     * @inheritDoc
     */
    public static function getDisplay()
    {
        return 'Reg Ex';
    }
}
