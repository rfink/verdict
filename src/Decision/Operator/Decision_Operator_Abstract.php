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
 * Abstract base class for decision 'operators' that run logic on nodes against each other
 * @author rfink
 * @since  Mar 19, 2011
 */
abstract class Decision_Operator_Abstract implements Decision_Operator_Interface {

	/**
	 * Left node to compare
	 * @var Decision_Comparison_Interface
	 */
	protected $_LeftNode = null;

	/**
	 * Right node to compare
	 * @var Decision_Comparison_Interface
	 */
	protected $_RightNode = null;


	/**
	 * Set our left node
	 * @param Decision_Node_Abstract $Node
	 * @return Decision_Operator_Abstract
	 */
	public function set_left_node(Decision_Node_Abstract $Node) {

		$this->_LeftNode = $Node;
		return $this;

	}


	/**
	 * Set our right node
	 * @param Decision_Node_Abstract $Node
	 * @return Decision_Operator_Abstract
	 */
	public function set_right_node(Decision_Node_Abstract $Node) {

		$this->_RightNode = $Node;
		return $this;

	}

}
