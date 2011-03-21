<?php

/**
 * Interface defining public access to the decision builder class
 * @author rfink
 * @since  Mar 19, 2011
 */
interface Decision_Builder_Interface {

	/**
	 * Set our context model on our builder object
	 * @param Model $Context
	 * @return Decision_Builder_Interface
	 */
	public function set_context_model(Model $Context);

	/**
	 * Build our decision engine object and return
	 * @return Decision_Engine
	 */
	public function build();

}
