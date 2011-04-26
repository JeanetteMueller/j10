<?php

class core_base{
	
	public function __construct(){
		$this->log("Load Extension: Base");
	}
	
	public function __call($functionName, $params){
		
		$prefix = substr($functionName, 0, 3);
		$includeName = substr($functionName, 3);
		
		if($prefix == 'get'){
			
			if(isset($this->includes[ucfirst(strtolower($includeName))])){
				
				//echo $includeName." ";
				
				
				
				if(!empty($params) && $params[0] === true){
					//echo "class: ".$includeName.' neu laden <br />';
					
					$result = $this->loadIncludeClass($includeName);
					
					//var_dump($result);
					
					return $result;
					
				}else{
					
					$object = $this->includes[ucfirst(strtolower($includeName))];
					
					if($includeName == 'database'){
						$object = clone($object);
					}
					return $object;
				}
				
				
				
			}
		}
		
		echo 'CANT LOAD:' . $functionName;
			echo "<pre>";
			var_dump($params);
			echo "</pre>";
			
		return false;
	}
}