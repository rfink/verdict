<?php

/**
 * Compare our given context and config for equality
 * @author rfink
 * @since  Feb 21, 2011
 */
class Decision_Comparison_Equals extends Decision_Comparison_Abstract {

	/**
	 * Compare our 2 values for equality (==)
	 * @return boolean
	 */
	public function compare() {

		return $this->_context == $this->_config;

	}

}
