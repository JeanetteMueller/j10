<?php

class Module {
	
	public $core;
	public $id;
	public $name;
	public $params;
	public $Template;
	
	public function __call($functionName, $params){
		
		$prefix = substr($functionName, 0, 3);
		$includeName = substr($functionName, 3);
		
		if($prefix == 'get'){
			
			if(count($params) > 0){
				
				switch(count($params)){
					case 1:
						return $this->core->$functionName($params[0]);
					break;
					case 2:
						return $this->core->$functionName($params[0], $params[1]);
					break;
					case 3:
						return $this->core->$functionName($params[0], $params[1], $params[2]);
					break;
					case 4:
						return $this->core->$functionName($params[0], $params[1], $params[2], $params[3]);
					break;
					case 5:
						return $this->core->$functionName($params[0], $params[1], $params[2], $params[3], $params[4]);
					break;
					case 6:
						return $this->core->$functionName($params[0], $params[1], $params[2], $params[3], $params[4], $params[5]);
					break;
				}
				
				
			}
			
			return $this->core->$functionName();
		}
		return false;
	}
	public function __construct($core, $id, $name){
		$this->core = $core;
		$this->id = $id;
		$this->name = $name;
		$this->params = new stdClass();
		
		$this->Template = $this->core->getTemplate(true);

		$this->Template->setTemplateToModule($this->name);
	}
	
	public function getMyTemplate(){
		$Template = $this->core->getTemplate(true);
		$Template->setTemplateToModule($this->name);
		
		return $Template;
	}
	
	public function assign($key, $value){

		$this->Template->assign($key, $value);
		
	}
	public function fetch($template){

		$this->Template->prepareThemeDirectories($template);
		
		return $this->Template->fetch($template);

	}
	
	
	public function setup($params){
		if(!empty($params)){
			if(is_string($params)){
				$params = json_decode($params, true);
			}
			$this->params = $params;
			
		}
	}
	public function autoRefresh(){
		return false;
	}
	public function getHeader(){
		return false;
	}
	public function loadHeader(){
		
		if($this->getHeader() === false){
			return false;
		}
		if(!file_exists('modules/'.$this->name.'/templates/head.tpl')){
			return false;
		}

		return $this->fetch('head.tpl');
	}
	
	
	public function getContent(){
		
		return false;
	}
	public function loadContent(){
		if($this->getContent() === false){
			return false;
		}
		if(!file_exists('modules/'.$this->name.'/templates/content.tpl')){
			return false;
		}
		return $this->fetch('content.tpl');
	}
	
	
	public function getFooter(){
		return false;
	}
	public function loadFooter(){
		
		if($this->getFooter() === false){
			return false;
		}
		if($this->getFooter() === false && !file_exists('modules/'.$this->name.'/templates/footer.tpl')){
			return false;
		}
		return $this->fetch('footer.tpl');
	}
}