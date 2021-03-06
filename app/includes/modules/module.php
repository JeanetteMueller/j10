<?php

class Module {
	
	public $core;
	public $id;
	public $name;
	public $params;
	public $Template;
	
	public $options = array();
	
	public $reorder = false;
	
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
		$this->params = array(); //new stdClass();
		
		$this->Template = $this->getTemplate(true);
		$this->Template->setTemplateToModule($this->name);
	}
	
	public function getMyTemplate(){
		$Template = $this->getTemplate(true);
		$Template->setTemplateToModule($this->name);
		
		
		
		return $Template;
	}
	
	public function assign($key, $value){

		$this->Template->assign($key, $value);
		
	}
	public function fetch($template){

		$this->Template->prepareThemeDirectories($template);
		$this->assign('reorder', $this->reorder);

		return $this->Template->fetch($template);

	}
	
	
	public function setup($params){
		
		if(!empty($params)){
			if(is_string($params)){
				$params = json_decode($params, true);
			}
			$this->params = $params;
		}
		
		
		foreach($this->getOptionKeys() as $key){
			$this->optionTitles[$key] = $this->getTitleForOption($key);
			$this->options[$key] = $this->getOptionsFor($key);
		}
		
	}
	public function getOptionKeys(){
		return array();
	}
	public function getTitleForOption($key){
		switch($key){
			case 'appendLoadCount':
				return 'Anzahl der nachzuladenden Einträge';
			break;
			case 'contentid':
				return 'Beitrag';
			break;
			
		}
		return $key;
	}
	public function getOptionsFor($key){
		
		switch($key){
			case 'appendLoadCount':
				return $this->getConverter()->getNumberArray(1,20);
			break;
			case 'contentid':
			
				$db = $this->getDatabase();
				$contents = $db->find('jx_content');
				

				$result = array(0=>' – Beitrag wählen – ');
				
				foreach($contents as $item){
					$result[$item->id] = utf8_encode($item->ueberschrift);
				}
				
				return $result;
			break;
			
		}
		
		return array();
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