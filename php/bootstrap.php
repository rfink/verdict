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


define('VERDICT_DIRECTORY', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'src');
define('PEAR_DIRECTORY', '/usr/share/pear');


/**
 * Autoloader class for verdict tests and example cases
 * @author rfink
 * @since  Mar 21, 2011
 */
class VerdictAutoloader {

	/**
	 * Run our autoloading functionality
	 * @param string $className
	 * @return boolean
	 */
	public static function load($className) {
		
		// Explode on our namespace char, and shift off "verdict"
		$dirArray = explode('\\', $className);
		array_shift($dirArray);
		
		// Join back together using the directory separator
		$dirString = implode(DIRECTORY_SEPARATOR, $dirArray);
		$fileName = VERDICT_DIRECTORY . DIRECTORY_SEPARATOR . $dirString . '.php';

		if (file_exists($fileName)) {

			require_once($fileName);
			return TRUE;

		}

		return FALSE;

	}

}

// Add our autoload class onto the SPL autoload stack
spl_autoload_register(array('VerdictAutoloader', 'load'));
set_include_path(get_include_path() . PATH_SEPARATOR . PEAR_DIRECTORY);
