<?php

class Module_Navigationbar extends Module{
	

	
	
	public function setup($params){
		
	}
	public function autoRefresh(){
		return false;
	}

	public function getContent(){

		$Sites = $this->core->getSites();

		$this->assign('tree', $Sites->getNavigationTree($this->core->Get('root', 0)));
	
	}

}