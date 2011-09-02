<?php

require_once(dirname(__FILE__) . '/../../../bootstrap.php');

use Verdict\Decision\Comparison\NotIn;

/**
 * Run unit tests on our comparison "Not In" array operator
 * @author rfink
 * @since  Mar 22, 2011
 */
class Decision_Comparison_NotIn_Test extends PHPUnit_Framework_TestCase {

	/**
	 * Test the basic in_array functionality
	 * @return void
	 */
	public function test_basic() {

		$Comparison = new NotIn('4', array('1', '2', '3'));
		$this->assertTrue($Comparison->compare());

		$Comparison = new NotIn('1', array('1', '2'));
		$this->assertFalse($Comparison->compare());

	}


	/**
	 * Test that a non-array fails for the configuration
	 * @expectedException InvalidArgumentException
	 */
	public function test_non_array_fails() {

		$Comparison = new NotIn(1, 1);

	}


	/**
	 * Test that an empty array is valid
	 * @return void
	 */
	public function test_empty_array() {

		$Comparison = new NotIn(1, array());
		$this->assertTrue($Comparison->Compare());

	}


}
