<?php

/**
 * Ensure that our config is NOT contained in the context string
 * @author rfink
 * @since  Feb 22, 2011
 */
class Decision_Comparison_NotLike extends Decision_Comparison_Abstract {

	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Comparison/Decision_Comparison_Interface#compare()
	 */
	public function compare() {

		return (stripos($this->_context, $this->_config) === FALSE);

	}

}
