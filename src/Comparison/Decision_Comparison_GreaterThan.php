<?php

/**
 * See if our context was greater than the configuration
 * @author rfink
 * @since  Feb 21, 2011
 */
class Decision_Comparison_GreaterThan extends Decision_Comparison_Abstract {

	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Comparison/Decision_Comparison_Interface#compare()
	 */
	public function compare() {

		return $this->_context > $this->_config;

	}

}
