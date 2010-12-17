<?php
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

		$file = str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
		require_once $file;
	}
}