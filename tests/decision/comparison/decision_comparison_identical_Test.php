<?php

require_once(dirname(__FILE__) . '/../../../bootstrap.php');

/**
 * Test our identical comparison
 * @author rfink
 * @since  April 16, 2011
 */
class Decision_Comparison_Identical_Test extends PHPUnit_Framework_TestCase {


	/**
	 * Test a very basic boolean condition
	 * @return void
	 */
	public function test_basic() {

		$Comparison = new Decision_Comparison_Identical(1, 1);
		$this->assertTrue($Comparison->compare());

		$Comparison->set_context(array(1))->set_config(array(1));
		$this->assertTrue($Comparison->compare());

		$Comparison->set_context(1)->set_config(0);
		$this->assertFalse($Comparison->compare());

	}


	/**
	 * Test some object comparisons
	 * @return void
	 */
	public function test_objects() {

		$Comparison = new Decision_Comparison_Identical(1, 1);

		$Comparison->set_context((object) array('FirstVar' => 'yay'))
			->set_config((object) array('FirstVar' => 'yay'));
		$this->assertFalse($Comparison->compare());

		$Object = new stdClass();
		$Object->FirstVar = 'yay!';
		$Object2 = clone $Object;

		$Comparison->set_context($Object)->set_config($Object2);
		$this->assertFalse($Comparison->compare());

		$Object2 = $Object;
		$Comparison->set_config($Object2);
		$this->assertTrue($Comparison->compare());

		$Object2->FirstVar = 'dude';
		$this->assertTrue($Comparison->compare());

	}


	/**
	 * Test some non equal types
	 * @return void
	 */
	public function test_types() {

		$Comparison = new Decision_Comparison_Identical(1, '1');
		$this->assertFalse($Comparison->compare());

	}

}
