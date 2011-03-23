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
 * Interface defining public method access to a decision operator object
 * @author rfink
 * @since  Mar 13, 2011
 */
interface Decision_Operator_Interface {

	/**
	 * Set our left node to evaluate on the object
	 * @param Decision_Node_Abstract $Node
	 * @return Decision_Operator_Interface
	 */
	public function set_left_node(Decision_Node_Abstract $Node);

	/**
	 * Set our right node to evaluate on the object
	 * @param Decision_Node_Abstract $Node
	 * @return Decision_Operator_Interface
	 */
	public function set_right_node(Decision_Node_Abstract $Node);

	/**
	 * Execute our comparison and return the boolean result
	 * @return boolean
	 */
	public function compare();

}
