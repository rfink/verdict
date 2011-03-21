<?php

/**
 * Interface defining public access to decision nodes
 * @author rfink
 * @since  Mar 13, 2011
 */
interface Decision_Node_Interface {

	/**
	 * Add node to our internal array
	 * @param Decision_Node_Abstract $Node
	 * @return Decision_Node_Abstract
	 */
	public function add_node(Decision_Node_Abstract $Node);

	/**
	 * Evaluate our decision
	 * @return Decision_Node_Value
	 */
	public function evaluate();

}
