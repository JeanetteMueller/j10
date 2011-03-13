<?php

class Module_Onlineuser extends Module{
	
	public function __construct($core, $name){
		parent::__construct($core, $name);
	}
	
	
	public function setup($params){
		
	}
	public function autoRefresh(){
		return true;
	}

	public function getContent(){
		
		$this->assign('list', array('hänsel', 'gretel', 'hexe', 'wolf'));
	}
	
}