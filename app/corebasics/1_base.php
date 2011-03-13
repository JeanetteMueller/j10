<?php

class core_base{
	
	public function __construct(){
		$this->log("Load Extension: Base");
	}
	
	public function __call($functionName, $params){
		
		$prefix = substr($functionName, 0, 3);
		$includeName = substr($functionName, 3);
		
		if($prefix == 'get'){
			if(isset($this->includes[$includeName])){
				
				if(!empty($params) && $params[0] === true){
					//echo "class: ".$includeName.' neu laden <br />';
					return $this->loadIncludeClass($includeName);
					
				}else{
					return $this->includes[$includeName];
				}
				
				
				
			}
		}
		
		echo 'CANT LOAD:' . $functionName;
			echo "<pre>";
			var_dump($params);
			echo "</pre>";
	}
}