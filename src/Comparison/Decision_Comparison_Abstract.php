<?php

/**
 * Abstract base class for comparison classes
 * @author rfink
 * @since  Feb 21, 2011
 */
abstract class Decision_Comparison_Abstract implements Decision_Comparison_Interface {

	/**
	 * Our context (actual variable)
	 * @var mixed
	 */
	protected $_context = null;

	/**
	 * Our base var (comparison value)
	 * @var mixed
	 */
	protected $_config = null;


	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Comparison/Decision_Comparison_Interface#set_context($contextVar)
	 */
	public function set_context($contextVar) {

		$this->_context = $contextVar;
		return $this;

	}


	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Comparison/Decision_Comparison_Interface#set_base($config)
	 */
	public function set_config($config) {

		$this->_config = $config;
		return $this;

	}

}
