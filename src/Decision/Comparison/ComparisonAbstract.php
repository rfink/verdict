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

namespace Verdict\Decision\Comparison;
use Verdict\Decision\Comparison\ComparisonInterface;

/**
 * Abstract base class for comparison classes
 * @author rfink
 * @since  Feb 21, 2011
 */
abstract class ComparisonAbstract implements ComparisonInterface {

	/**
	 * Our context (actual variable)
	 * @var mixed
	 */
	protected $_context = null;

	/**
	 * Our base var (comparison value)
	 * @var mixed
	 */
	protected $_config = null;


	/**
	 * Instantiate our object, pass in our context/config vars
	 * @param mixed $contextVar
	 * @param mixed $config
	 * @return Decision_Comparison_Abstract
	 */
	public function __construct($contextVar, $config) {

		$this->set_context($contextVar);
		$this->set_config($config);

	}


	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Comparison/Decision_Comparison_Interface#set_context($contextVar)
	 */
	public function set_context($contextVar) {

		$this->_context = $contextVar;
		return $this;

	}


	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Comparison/Decision_Comparison_Interface#set_base($config)
	 */
	public function set_config($config) {

		$this->_config = $config;
		return $this;

	}

}
