<?php

/**
 * Check to see if our config (as a string) is contained inside the context
 * @author rfink
 * @since  Feb 21, 2011
 */
class Decision_Comparison_Like extends Decision_Comparison_Abstract {

	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Comparison/Decision_Comparison_Interface#compare()
	 */
	public function compare() {

		return (stripos($this->_context, $this->_config) !== FALSE);

	}

}
