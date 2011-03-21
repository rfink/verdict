<?php

/**
 * Determine if our context is less than our config
 * @author rfink
 * @since  Feb 21, 2011
 */
class Decision_Comparison_LessThan extends Decision_Comparison_Abstract {

	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Comparison/Decision_Comparison_Interface#compare()
	 */
	public function compare() {

		return $this->_context < $this->_config;

	}

}
