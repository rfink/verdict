<?php

require_once(dirname(__FILE__) . '/../../../bootstrap.php');

/**
 * Mocked class with a __toString method
 * @author rfink
 * @since  April 16, 2011
 */
class Mock_Class_With_ToString {

	/**
	 * Return some text to be tested against
	 * @return string
	 */
	public function __toString() {

		return 'test';

	}

}

/**
 * Test our "like" comparison (checking for partial string match)
 * @author rfink
 * @since  April 16, 2011
 */
class Decision_Comparison_Like_Test extends PHPUnit_Framework_TestCase {


	/**
	 * Test a very basic boolean condition
	 * @return void
	 */
	public function test_boolean() {

		$Comparison = new Decision_Comparison_Like('test', 't');
		$this->assertTrue($Comparison->compare());

		$Comparison->set_context('string1')->set_config('string2');
		$this->assertFalse($Comparison->compare());

		$Comparison->set_context('1234')->set_config(12);
		$this->assertTrue($Comparison->compare());

	}


	/**
	 * Test invalid inputs
	 * @expectedException InvalidArgumentException
	 * @return void
	 */
	public function test_object_as_context_invalid() {

		$Comparison = new Decision_Comparison_Like(new stdClass(), 'junk text');

	}


	/**
	 * Test that an array is invalid input
	 * @expectedException InvalidArgumentException
	 * @return void
	 */
	public function test_array_as_context_invalid() {

		$Comparison = new Decision_Comparison_Like(array(), 'junk text');

	}


	/**
	 * Test that an array is invalid input
	 * @expectedException InvalidArgumentException
	 * @return void
	 */
	public function test_object_as_config_invalid() {

		$Comparison = new Decision_Comparison_Like('junk text', new stdClass());

	}


	/**
	 * Test that an array is invalid input
	 * @expectedException InvalidArgumentException
	 * @return void
	 */
	public function test_array_as_config_invalid() {

		$Comparison = new Decision_Comparison_Like('junk text', array());

	}


	/**
	 * Test an object with a __toString method
	 * @return void
	 */
	public function test_object_with_to_string() {

		$Comparison = new Decision_Comparison_Like(new Mock_Class_With_ToString(), 'test');
		$this->assertTrue($Comparison->compare());
		$this->assertTrue($Comparison->set_config('test')->compare());

	}

}
