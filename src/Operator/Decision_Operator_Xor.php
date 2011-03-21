<?php

/**
 *
 * @author rfink
 *
 */
class Decision_Operator_Xor extends Decision_Operator_Abstract {

	/**
	 *
	 * @return boolean
	 */
	public function compare() {

		return $this->_LeftNode->compare() xor $this->_RightNode->compare();

	}

}
