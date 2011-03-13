<?php

class Module {
	
	public $core;
	public $name;
	public $Template;
	
	public function __construct($core, $name){
		$this->core = $core;
		$this->name = $name;
		
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
		
	}
	public function autoRefresh(){
		return false;
	}
	public function getHeader(){
		return false;
	}
	public function loadHeader(){
		
		if($this->getHeader() === false && !file_exists('modules/'.$this->name.'/templates/head.tpl')){
			return false;
		}

		return $this->fetch('head.tpl');
	}
	
	
	public function getContent(){
		return false;
	}
	public function loadContent(){
		if($this->getContent() === false && !file_exists('modules/'.$this->name.'/templates/content.tpl')){
			return false;
		}
		return $this->fetch('content.tpl');
	}
	
	
	public function getFooter(){
		return false;
	}
	public function loadFooter(){
		

		if($this->getFooter() === false && !file_exists('modules/'.$this->name.'/templates/footer.tpl')){
			return false;
		}
		return $this->fetch('footer.tpl');
	}
}