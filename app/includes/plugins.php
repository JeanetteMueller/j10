<?php

require_once('app/includes/plugins/plugin.php');

class Plugins extends Includes{
	
	private $pathForExtension 	= 'plugins/';
	public 	$pluginsAll 		= array();
	public 	$plugins 			= array();
	
	public function __construct($core, $name){
		parent::__construct($core, $name);
		

	}
}