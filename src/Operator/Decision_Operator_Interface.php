<?php

/**
 * Interface defining public method access to a decision operator object
 * @author rfink
 * @since  Mar 13, 2011
 */
interface Decision_Operator_Interface {

	/**
	 *
	 * @param Decision_Node_Abstract $Node
	 */
	public function set_left_node(Decision_Node_Abstract $Node);

	/**
	 *
	 * @param Decision_Node_Abstract $Node
	 */
	public function set_right_node(Decision_Node_Abstract $Node);

	/**
	 *
	 * @return boolean
	 */
	public function compare();

}
