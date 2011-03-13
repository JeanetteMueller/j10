<?php

class Includes{
	public $name = null;
	public $core = null;
	
	public function __construct($core,$name){
		$this->core = $core;
		$this->name = $name;
		
		$this->loadConfig();
	}
	public function loadConfig(){
		
		if(file_exists('configs/'.strtolower($this->name).'.php')){
			require('configs/'.strtolower($this->name).'.php');
			
		}
	}
	public function __call($functionName, $params){
		
		$prefix = substr($functionName, 0, 3);
		$includeName = substr($functionName, 3);
		
		if($prefix == 'get'){
			if(isset($this->core->includes[$includeName])){
				
				if(!empty($params) && $params[0] === true){
					//echo "class: ".$includeName.' neu laden <br />';
					return $this->core->loadIncludeClass($includeName);
					
				}else{
					return $this->core->includes[$includeName];
				}
			}
		}

		echo 'CANT LOAD:' . $functionName;
		echo "<pre>";
		var_dump($params);
		echo "</pre>";
		
	}
}
