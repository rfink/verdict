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
 * Class for evaluating a decision tree collection
 * @author rfink
 * @since  Mar 13, 2011
 */
class Decision_Engine {

	/**
	 * Root node for the tree
	 * @var Decision_Node_Abstract
	 */
	protected $_RootNode = null;


	/**
	 * Set the root node on the tree
	 * @param Decision_Node_Abstract $Node
	 * @return Decision_Engine
	 */
	public function set_root_node(Decision_Node_Abstract $Node) {

		$this->_RootNode = $Node;
		return $this;

	}


	/**
	 * Evaluate our tree to find our decision
	 * @return Decision_Node_Value
	 */
	public function evaluate() {

		return $this->_RootNode->evaluate();

	}

}
