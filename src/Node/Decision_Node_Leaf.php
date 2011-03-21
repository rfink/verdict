<?php

/**
 * Class for decision node for value nodes (final decision)
 * @author rfink
 * @since  Mar 13, 2011
 */
class Decision_Node_Leaf extends Decision_Node_Abstract {

	/**
	 * Contains the value that is desired by the tree
	 * @var mixed
	 */
	protected $_value;


	/**
	 * Set our value on the object
	 * @param mixed $value
	 * @return Decision_Node_Leaf
	 */
	public function set_value($value) {

		$this->_value = $value;
		return $this;

	}


	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Node/Decision_Node_Abstract#evaluate()
	 */
	public function evaluate() {

		// First, attempt to evaluate our current condition
		//   If it does not evaluate, discontinue traversing this path
		if (!$this->_ConditionNode->compare()) {

			return null;

		}

		return $this;

	}


	/**
	 * Get our value
	 * @return mixed
	 */
	public function get_value() {

		return $this->_value;

	}

}
