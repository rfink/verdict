<?php

/**
 * Class for evaluating a decision tree collection
 * @author rfink
 * @since  Mar 13, 2011
 */
class Decision_Engine {

	/**
	 * Root node for the tree
	 * @var Decision_Node_Abstract
	 */
	protected $_RootNode = null;


	/**
	 * Set the root node on the tree
	 * @param Decision_Node_Abstract $Node
	 * @return Decision_Engine
	 */
	public function set_root_node(Decision_Node_Abstract $Node) {

		$this->_RootNode = $Node;
		return $this;

	}


	/**
	 * Evaluate our tree to find our decision
	 * @return Decision_Node_Value
	 */
	public function evaluate() {

		return $this->_RootNode->evaluate();

	}

}
