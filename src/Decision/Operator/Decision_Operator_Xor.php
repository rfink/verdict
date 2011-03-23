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
 * Operator driver for comparing our left node to our right node using "XOR"
 * @author rfink
 * @since  Mar 21, 2011
 */
class Decision_Operator_Xor extends Decision_Operator_Abstract {

	/**
	 * Execute our comparison using the logical 'XOR'
	 * @return boolean
	 */
	public function compare() {

		return $this->_LeftNode->compare() xor $this->_RightNode->compare();

	}

}
