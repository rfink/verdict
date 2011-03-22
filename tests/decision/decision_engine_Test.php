<?php

require_once(dirname(__FILE__) . '/../../bootstrap.php');

/**
 * Testing the base class of the decision engine
 * @author rfink
 * @since  Mar 21, 2011
 */
class Decision_Engine_Test extends PHPUnit_Framework_TestCase {

	/**
	 * Decision engine object
	 * @var Decision_Engine
	 */
	protected $_Engine = null;

	/**
	 * Called before each test is run
	 * @return void
	 */
	protected function setUp() {

		parent::setUp();
		$this->_Engine = new Decision_Engine();

	}


	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_execute_without_node() {

		$this->_Engine->evaluate();

	}

}
