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
 * Interface for defining comparison class required methods
 * @author rfink
 * @since  Feb 21, 2011
 */
interface Decision_Comparison_Interface {

	/**
	 * Set the context (actual value) on the object
	 * @param mixed $contextVar
	 * @return Decision_Comparison_Interface
	 */
	public function set_context($contextVar);

	/**
	 * Set the config value (desired value) on the object
	 * @param mixed $configVal
	 * @return Decision_Comparison_Interface
	 */
	public function set_config($configVal);

	/**
	 * Compare our internal variables
	 * @return boolean
	 */
	public function compare();

}
