<?php

/**
 * Interface for defining comparison class required methods
 * @author rfink
 * @since  Feb 21, 2011
 */
interface Decision_Comparison_Interface {

	/**
	 * Set the context (actual value) on the object
	 * @param mixed $contextVar
	 * @return Decision_Comparison_Interface
	 */
	public function set_context($contextVar);

	/**
	 * Set the config value (desired value) on the object
	 * @param mixed $configVal
	 * @return Decision_Comparison_Interface
	 */
	public function set_config($configVal);

	/**
	 * Compare our internal variables
	 * @return boolean
	 */
	public function compare();

}
