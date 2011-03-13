<?php

$this->theme 					= 'jeanette';
$this->rewriteRule 				= true;


$this->rootPath 				= implode('/', array_slice(explode('/', $this->core->GetServer('PHP_SELF')), 0,-1));
$this->themePath 				= "themes/";
$this->defaultTheme 			= 'base';
$this->pluginsPath 				= "app/includes/template";
$this->externalsPath 			= 'externals/';

/* Defaultwerte nutzen */
/*

$this->smarty_left_delimiter 	= '<@';
$this->smarty_right_delimiter 	= '@>';

$this->smarty_compile_dir 		= "files/cache/template_compiled/";

*/