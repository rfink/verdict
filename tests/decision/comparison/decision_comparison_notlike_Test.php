<?php

require_once(dirname(__FILE__) . '/../../../bootstrap.php');

/**
 * Test our "like" comparison (checking for partial string match)
 * @author rfink
 * @since  April 16, 2011
 */
class Decision_Comparison_NotLike_Test extends PHPUnit_Framework_TestCase {


	/**
	 * Test a very basic boolean condition
	 * @return void
	 */
	public function test_boolean() {

		$Comparison = new Decision_Comparison_NotLike('test', 't');
		$this->assertFalse($Comparison->compare());

		$Comparison->set_context('string1')->set_config('string2');
		$this->assertTrue($Comparison->compare());

		$Comparison->set_context('1234')->set_config(12);
		$this->assertFalse($Comparison->compare());

	}


	/**
	 * Test invalid inputs
	 * @expectedException InvalidArgumentException
	 * @return void
	 */
	public function test_object_as_context_invalid() {

		$Comparison = new Decision_Comparison_NotLike(new stdClass(), 'junk text');

	}


	/**
	 * Test that an array is invalid input
	 * @expectedException InvalidArgumentException
	 * @return void
	 */
	public function test_array_as_context_invalid() {

		$Comparison = new Decision_Comparison_NotLike(array(), 'junk text');

	}


	/**
	 * Test that an array is invalid input
	 * @expectedException InvalidArgumentException
	 * @return void
	 */
	public function test_object_as_config_invalid() {

		$Comparison = new Decision_Comparison_NotLike('junk text', new stdClass());

	}


	/**
	 * Test that an array is invalid input
	 * @expectedException InvalidArgumentException
	 * @return void
	 */
	public function test_array_as_config_invalid() {

		$Comparison = new Decision_Comparison_NotLike('junk text', array());

	}

}
