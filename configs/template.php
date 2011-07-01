<?php

$this->theme 					= 'plane';
$this->rewriteRule 				= true;


$this->rootPath 				= implode('/', array_slice(explode('/', $this->core->GetServer('PHP_SELF')), 0,-1)).'/';
//$this->themePath 				= "themes/";
//$this->defaultTheme 			= 'base';

$serverPath = $_SERVER['SCRIPT_FILENAME'];
$serverPathParts = explode('/', $serverPath);
$file = array_pop($serverPathParts);
$serverPath = implode('/', $serverPathParts);

//$this->pluginsPath 				= $serverPath."/app/includes/template";
//$this->externalsPath 			= 'externals/';

/* Defaultwerte nutzen */
/*

$this->smarty_left_delimiter 	= '<@';
$this->smarty_right_delimiter 	= '@>';

$this->smarty_compile_dir 		= "files/cache/template_compiled/";

*/