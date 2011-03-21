<?php

/**
 * Abstract base class for decision builder context classes to extend
 * @author rfink
 * @since  Mar 19, 2011
 */
abstract class Decision_Builder_Abstact extends Decision_Builder_Interface {

	/**
	 * Context model
	 * @var Model
	 */
	protected $_Context = null;


	/**
	 * Set the context model on our object
	 * @param Model $Context
	 * @return Decision_Builder_Abstract
	 */
	public function set_context_model(Model $Context) {

		$this->_Context = $Context;
		return $this;

	}

}
