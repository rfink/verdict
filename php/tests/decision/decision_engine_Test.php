<?php

require_once(dirname(__FILE__) . '/../../bootstrap.php');

use Verdict\Decision\Engine;
use Verdict\Decision\Node\Branch;
use Verdict\Decision\Node\Leaf;
use Verdict\Decision\Comparison\Equals;

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
		$this->_Engine = new Engine();

	}


	/**
	 * Test our tree with just a single node
	 * @return void
	 */
	public function test_single_node() {

		$Condition = new Equals(TRUE, TRUE);

		$Leaf = new Leaf();

		$Node = new Branch();
		$Node->set_condition_node($Condition);
		$Node->add_node($Leaf);

		$this->_Engine->set_root_node($Node);
		$this->assertEquals($Leaf, $this->_Engine->evaluate());

	}


	/**
	 * Test that calling evaluate without a correct root node throws an exception
	 * @expectedException InvalidArgumentException
	 * @return void
	 */
	public function test_execute_without_node() {

		$this->_Engine->evaluate();

	}

}
