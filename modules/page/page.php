<?php

class Module_Page extends Module{	
	
	private $_content = null;

	private $_contentid = "0";

	
	public function setup($params){
		parent::setup($params);
		
		if(!isset($this->params['contentid'])){
			$this->params['contentid'] = $this->_contentid;
		}
		
		if(is_array($this->params) && isset($this->params['contentid'])){
			$db = $this->getDatabase();
			$db->whereAdd('jx_content.id', $this->params['contentid']);
			$db->joinAdd('jx_users', 'jx_users.id = jx_content.user_id');
			$contents = $db->find('jx_content');
			
			if(count($contents) > 0){
				$this->_content = reset($contents);
				
				$this->assign('content', $this->_content);
			}
		}
	}
	public function autoRefresh(){
		return false;
	}
	
	public function getContent(){
		parent::getContent();
		
		return true;
	}
	
	public function getHeader(){
		if ($this->_content->dachzeile == null){

			return false;
		}
	}
	public function getFooter(){
		return true;
	}
	public function getOptionKeys(){
		return array('contentid');
	}
	// public function getTitleForOption($key){
	// 	return parent::getTitleForOption($key);
	// }
	// public function getOptionsFor($key){
	// 	return parent::getOptionsFor($key);
	// }
}