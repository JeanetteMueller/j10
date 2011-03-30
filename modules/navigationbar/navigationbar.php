<?php

class Module_Navigationbar extends Module{
	

	
	
	public function setup($params){
		
	}
	public function autoRefresh(){
		return false;
	}

	public function getContent(){

		$this->assign('tree', $this->getSites()->getNavigationTree($this->Get('root', 0)));
	
	}
	public function getHeader(){
		return true;
	}
	public function getFooter(){
		return true;
	}

}