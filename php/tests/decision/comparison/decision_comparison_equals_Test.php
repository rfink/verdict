<?php

require_once(dirname(__FILE__) . '/../../../bootstrap.php');

use Verdict\Decision\Comparison\Equals;

/**
 * Test our equals comparison
 * @author rfink
 * @since  Mar 21, 2011
 */
class Decision_Comparison_Equals_Test extends PHPUnit_Framework_TestCase {


	/**
	 * Test a very basic boolean condition
	 * @return void
	 */
	public function test_boolean() {

		$Comparison = new Equals(TRUE, TRUE);
		$this->assertTrue($Comparison->compare());

	}


	/**
	 * Test that two different types still evaluating to true still works
	 * @return void
	 */
	public function test_different_types_same_value() {

		$Comparison = new Equals(TRUE, 1);
		$this->assertTrue($Comparison->compare());

		$Comparison = new Equals('1', 1);
		$this->assertTrue($Comparison->compare());

	}


	/**
	 * Test that two not equal values do not evaluate to trues
	 * @return void
	 */
	public function test_not_equal_values() {

		$Comparison = new Equals(3, 2);
		$this->assertFalse($Comparison->compare());

	}

}
