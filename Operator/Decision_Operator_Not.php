<?php

/**
 *
 * @author rfink
 *
 */
class Decision_Operator_Not extends Decision_Operator_Abstract {

	/**
	 *
	 * @return boolean
	 */
	public function compare() {

		return !$this->_LeftNode->compare();

	}

}
