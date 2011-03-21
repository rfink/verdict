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
 * Interface defining public access to decision nodes
 * @author rfink
 * @since  Mar 13, 2011
 */
interface Decision_Node_Interface {

	/**
	 * Add node to our internal array
	 * @param Decision_Node_Abstract $Node
	 * @return Decision_Node_Abstract
	 */
	public function add_node(Decision_Node_Abstract $Node);

	/**
	 * Evaluate our decision
	 * @return Decision_Node_Value
	 */
	public function evaluate();

}
