<?php

class dataobject {
	private $_core 		= null;
	private $_changed 	= array();
	private $_table 	= null;
	
	public $id 			= null;
	public $created 	= null;
	public $edited 		= null;
	public $deleted 	= null;
	
	public function __construct($core){
		$this->_core = $core;
	}
	public function setTable($table){
		$this->_table = $table;
	}
	public function setValue($key, $value){
		
		$this->_changed[] = $key;
		array_unique($this->_changed);
		
		$this->$key = $value;
	
	}
	
	public function syncronize(){
		if(!empty($this->_table) && is_string($this->_table) && $this->_table !== '' && $this->_core !== null){

			if($this->id > 0 ){
				//Update
				$updateSql = 'UPDATE '.$this->_table.' SET ';

				foreach($this->_changed as $key){
					
					if(in_array($this->$key, array('now()'))){
						$updateSql.= $key.' = '.$this->$key.',';
					}else{
						$updateSql.= $key.' = "'.$this->$key.'",';
					}
					
				}
				$edittime = date('Y-m-d H:i:s', time());
				$updateSql.= 'edited = "'.$edittime.'"';

				$updateSql.= ' WHERE ID = "'.$this->id.'"; ';

				$this->_core->update($updateSql);
				
				$this->edited = $edittime;
			}else{
				//Insert
				foreach($this as $key=>$value){
					$this->_core->set($key, $value);
				}
				$this->id = $this->_core->insert($this->_table);
			}
			
		}
	}
	public function resetChanges(){
		$this->_changed = array();
	}
}