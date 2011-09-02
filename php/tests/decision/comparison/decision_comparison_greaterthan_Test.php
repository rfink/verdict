<?php

require_once(dirname(__FILE__) . '/../../../bootstrap.php');

use Verdict\Decision\Comparison\GreaterThan;

/**
 * Test our greater than comparison
 * @author rfink
 * @since  April 16, 2011
 */
class Decision_Comparison_GreaterThan_Test extends PHPUnit_Framework_TestCase {


	/**
	 * Test a very basic boolean condition
	 * @return void
	 */
	public function test_basic() {

		$Comparison = new GreaterThan(2, 1);
		$this->assertTrue($Comparison->compare());

		$Comparison->set_context('y')->set_config('Y');
		$this->assertTrue($Comparison->compare());

		$Comparison->set_context(0)->set_config(1);
		$this->assertFalse($Comparison->compare());

	}

}
