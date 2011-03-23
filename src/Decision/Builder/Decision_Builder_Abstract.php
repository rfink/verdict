<?php

/**
 * Verdict - Decision Engine Library
 * Copyright (c) 2011-2011 Ryan Fink <rfink@redventures.net>
 *
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Abstract base class for decision builder context classes to extend
 * @author rfink
 * @since  Mar 19, 2011
 */
abstract class Decision_Builder_Abstact implements Decision_Builder_Interface {

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
