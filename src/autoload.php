<?php
spl_autoload_register(
	function ($class)
	{
		$basedir = __DIR__.DIRECTORY_SEPARATOR;
		$file = $basedir.str_replace("\\", DIRECTORY_SEPARATOR, $class).'.php';
		if (file_exists($file))
		{
			require $file;
		}
	}
);