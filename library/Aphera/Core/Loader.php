<?php
/**
 * Copyright 2011 Martin Vium
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace Aphera\Core;

/**
 * Class autoloader
 */
class Loader
{
	static public function registerAutoload()
	{
		spl_autoload_register(array('Aphera\Core\Loader', 'autoload'));
	}

	/**
	 * Actual autoloader method
	 * 
	 * @param string $class
	 */
	static public function autoload($class)
	{
		if(class_exists($class, false) || interface_exists($class, false)) {
			return;
		}

		$file = str_replace('\\', \DIRECTORY_SEPARATOR, $class) . '.php';
		require_once $file;
	}
}