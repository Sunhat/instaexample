<?php


/**
 * This method gets used in Blade templates.
 * It checks if the current route name is matches one of strings provided
 * e.g. isRoute('')
 */

$container = $app->getContainer();

function isRoute() {
	global $container;
	$args = func_get_args();
	foreach($args as $arg) {
		if($arg === $container['currentRoute'])
			return 'active';
	}
	return null;
}

/**
 * I found this function on:
 * https://www.sitepoint.com/use-laravel-mix-non-laravel-projects/
 * The method is messy, and I had to make some modifications for it to actually work
 * ----
 * if I had more time, I would refactor this to be cleaner,
 * make the get method run the logic once and store the result in a static variable in a class
 * ---
 * 
 * Get the path to a versioned Mix file.
 *
 * @param string $path
 * @param string $manifestDirectory
 * @return string
 *
 * @throws \Exception
 */
function mix($path, $manifestDirectory = '')
{
	$publicFolder = '/public';
	$rootPath = getcwd() . '/..';
	$publicPath = $rootPath . $publicFolder;
	if ($manifestDirectory && substr($manifestDirectory, 0, 1) !== '/') {
		$manifestDirectory = "/{$manifestDirectory}";
	}

	if (! file_exists($manifestPath = ($rootPath . $manifestDirectory.'/mix-manifest.json') )) {
		echo $rootPath . $manifestDirectory.'/mix-manifest.json'; die();
		throw new Exception('The Mix manifest does not exist.');
	}
	$manifest = json_decode(file_get_contents($manifestPath), true);

	if (substr($path, 0, 1) !== '/') {
		$path = "/{$path}";
	}
	$isHot = file_exists($rootPath);
	if (!$isHot && !array_key_exists($path, $manifest)) {
		throw new Exception(
			"Unable to locate Mix file: {$path}. Please check your ".
			'webpack.mix.js output paths and try again.'
		);
	}
	return $isHot
				? "http://localhost:8081{$manifest[$path]}"
				: $manifestDirectory.$manifest[$path];
}