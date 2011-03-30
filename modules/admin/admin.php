<?php

class Module_Admin extends Module{	
	
	public function setup($params){
		parent::setup($params);
	}
	public function autoRefresh(){
		return false;
	}


}