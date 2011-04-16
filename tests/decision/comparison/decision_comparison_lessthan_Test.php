<?php

require_once(dirname(__FILE__) . '/../../../bootstrap.php');

/**
 * Test our less than comparison
 * @author rfink
 * @since  April 16, 2011
 */
class Decision_Comparison_LessThan_Test extends PHPUnit_Framework_TestCase {


	/**
	 * Test a very basic boolean condition
	 * @return void
	 */
	public function test_basic() {

		$Comparison = new Decision_Comparison_LessThan(1, 2);
		$this->assertTrue($Comparison->compare());

		$Comparison->set_context('Y')->set_config('y');
		$this->assertTrue($Comparison->compare());

		$Comparison->set_context(1)->set_config(0);
		$this->assertFalse($Comparison->compare());

	}

}
