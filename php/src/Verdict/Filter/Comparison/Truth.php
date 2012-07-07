<?php

/**
 * Compile our configuration to an always true clause clause.
 * @author  Ryan Fink <rfink@redventures.net>
 * @since   April 16, 2012
 */

namespace Verdict\Filter\Comparison;

use Verdict\Filter\FilterInterface;

class Truth extends ComparisonAbstract implements FilterInterface, ComparisonInterface
{
    /**
     * @inheritDoc
     */
	protected $requiredParams = array();

    /**
     * @inheritDoc
     */
	public function evaluate()
	{
		return true;
	}
   
    /**
     * @inheritDoc
     */
    public static function getDisplay()
    {
        return 'Always True';
    }
}
