<?php

class Module_Page extends Module{	
	
	public function setup($params){
		parent::setup($params);
	}
	public function autoRefresh(){
		return false;
	}

	public function getContent(){
		parent::getContent();
		
		
		
		
		
		if(isset($this->params['contentid'])){
			$db = $this->getDatabase();
			$db->whereAdd('id', $this->params['contentid']);
			$contents = $db->find('jx_content');
			
			if(count($contents) > 0){
				$content = reset($contents);
				
				$this->assign('content', $content);
			}
		}else{
			echo "es wurde keine kontent zugewiesen";
		}
		
		
		
		

	}

}