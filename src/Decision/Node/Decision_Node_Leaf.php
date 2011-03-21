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
 * Class for decision node for value nodes (final decision)
 * @author rfink
 * @since  Mar 13, 2011
 */
class Decision_Node_Leaf extends Decision_Node_Abstract {

	/**
	 * Contains the value that is desired by the tree
	 * @var mixed
	 */
	protected $_value;


	/**
	 * Set our value on the object
	 * @param mixed $value
	 * @return Decision_Node_Leaf
	 */
	public function set_value($value) {

		$this->_value = $value;
		return $this;

	}


	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Node/Decision_Node_Abstract#evaluate()
	 */
	public function evaluate() {

		// First, attempt to evaluate our current condition
		//   If it does not evaluate, discontinue traversing this path
		if (!$this->_ConditionNode->compare()) {

			return null;

		}

		return $this;

	}


	/**
	 * Get our value
	 * @return mixed
	 */
	public function get_value() {

		return $this->_value;

	}

}
