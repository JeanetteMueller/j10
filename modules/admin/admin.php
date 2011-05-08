<?php

class Module_Admin extends Module{	
	
	public function setup($params){
		parent::setup($params);
	}
	public function autoRefresh(){
		return false;
	}
	public function ajax_getBar(){
		$Template = $this->getMyTemplate();
		
		return array(
			'content'	=> $Template->fetch('content.tpl')
		);
	}
	public function getContent(){
		
		return true;
	}
	public function getHeader(){
		return false;
	}
	public function getFooter(){
		return false;
	}

}