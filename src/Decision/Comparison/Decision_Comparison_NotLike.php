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
 * Ensure that our config is NOT contained in the context string
 * @author rfink
 * @since  Feb 22, 2011
 */
class Decision_Comparison_NotLike extends Decision_Comparison_Abstract {


	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Comparison/Decision_Comparison_Interface#set_context()
	 */
	public function set_context($contextVar) {

		$this->_validate_as_string($contextVar);
		parent::set_context($contextVar);
		return $this;

	}


	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Comparison/Decision_Comparison_Interface#set_config()
	 */
	public function set_config($config) {

		$this->_validate_as_string($config);
		parent::set_config($config);
		return $this;

	}


	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Comparison/Decision_Comparison_Interface#compare()
	 */
	public function compare() {

		return (stripos((string) $this->_context, (string) $this->_config) === FALSE);

	}


	/**
	 * Validate our given value to see if it can be converted to string
	 * @param mixed $val
	 * @throws InvalidArgumentException
	 */
	protected function _validate_as_string($val) {

		if (is_array($val) || (is_object($val) && !method_exists($val, '__toString'))) {

			throw new InvalidArgumentException('Value must be a string or have the __toString method defined');

		}

	}

}
