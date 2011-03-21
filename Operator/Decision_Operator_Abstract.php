<?php

/**
 * Abstract base class for decision 'operators' that run logic on nodes against each other
 * @author rfink
 * @since  Mar 19, 2011
 */
abstract class Decision_Operator_Abstract implements Decision_Operator_Interface {

	/**
	 * Left node to compare
	 * @var Decision_Comparison_Interface
	 */
	protected $_LeftNode = null;

	/**
	 * Right node to compare
	 * @var Decision_Comparison_Interface
	 */
	protected $_RightNode = null;


	/**
	 * Set our left node
	 * @param Decision_Node_Abstract $Node
	 * @return Decision_Operator_Abstract
	 */
	public function set_left_node(Decision_Node_Abstract $Node) {

		$this->_LeftNode = $Node;
		return $this;

	}


	/**
	 * Set our right node
	 * @param Decision_Node_Abstract $Node
	 * @return Decision_Operator_Abstract
	 */
	public function set_right_node(Decision_Node_Abstract $Node) {

		$this->_RightNode = $Node;
		return $this;

	}

}
