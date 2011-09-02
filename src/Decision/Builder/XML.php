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

namespace Verdict\Decision\Builder;
use Verdict\Decision\Builder\BuilderAbstract;

/**
 * Build a decision engine from an XML file
 * @author rfink
 * @since  Mar 19, 2011
 */
class XML extends BuilderAbstact {

	/**
	 * Our XML file name to operate on
	 * @var string
	 */
	protected $_fileName = '';


	/**
	 * Instantiate our object and set the file name on the object
	 * @param string $fileName
	 * @return Decision_Builder_XML
	 */
	public function __construct($fileName) {

		$this->set_file_name($fileName);

	}


	/**
	 * Set our file name on the object
	 * @param string $fileName
	 * @return XML
	 * @throws InvalidArgumentException
	 */
	public function set_file_name($fileName) {

		if (!is_readable($fileName)) {

			throw new \InvalidArgumentException('File ' . $fileName . ' is not readable');

		}

		$this->_fileName = $fileName;
		return $this;

	}


	/**
	 * Build our decision engine from the given xml file
	 * @return Engine
	 */
	public function build() {



	}

}
