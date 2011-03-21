<?php

/**
 * Check to see if our context is in the config array
 * @author rfink
 * @since  Feb 22, 2011
 */
class Decision_Comparison_In extends Decision_Comparison_Abstract {

	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Comparison/Decision_Comparison_Interface#compare()
	 */
	public function compare() {

		return in_array($this->_context, (array) $this->_config);

	}

}
