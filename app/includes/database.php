<?php

require_once('externals/MDB2-2.4.1/MDB2.php');
require_once('app/includes/database/dataobject.php');

class Database extends Includes{
	private $connections = array();
	private $db 		= array();
	
	private $select 	= '';
	private $where 		= '';
	private $whereGet	= '';
	private $join 		= '';
	private $order 		= '';
	private $group 		= '';
	private $limit 		= '';
	
	private $set		= '';
	
	private $fields		= array();
	
	public $last_query	= '';
	private $sqlFunktionen = array('NULL', 'NOW()');
	private $mdb2;
	
	public function __construct($core, $name){
		parent::__construct($core, $name);
	}
	public function setDatabase($host, $name, $username, $userpass, $type, $port='' ){
		
		$this->db = array(
			'host'		=>$host,
			'name'		=>$name,
			'username'	=>$username,
			'userpass'	=>$userpass,
			'port'		=>$port,
			'type'		=>$type
		);
		return true;
	}
	public function getDatabase(){
		return $this->db;
	}
	public function selectAdd($select){
		if($this->select == ''){
			$this->select .= 'SELECT '.$select;
		}else{
			$this->select .= ', '.$select;
		}
	}
	public function get($id){
		$id = mysql_escape_string($id);
		$this->whereGet = "WHERE ID = '".$id."'";
	}
	public function whereAdd($where, $value='', $type="=", $additionType="AND"){
		
		if($value === NULL || $value == 'NULL'){
			$where = $where." IS NULL";
		}elseif($value !== ''){
			$where = $where." ".$type." '".mysql_escape_string($value)."'";
		}
		
		if($this->where == ''){
			$this->where .= 'WHERE ('.$where.')';
		}else{
			$this->where .= ' '.$additionType.' ('.$where.')';
		}
	}
	public function orderBy($orderby){

		if($this->order == ''){
			$this->order .= 'ORDER BY '.$orderby;
		}else{
			$this->order .= ', '.$orderby;
		}
	}
	public function joinAdd($table, $field, $way='INNER'){
		if(!empty($table) && !empty($field)){
			$this->join .= $way.' JOIN '.$table.' ON '.$field.' ';
		}
	}
	public function groupBy($group){
		if($this->group == ''){
			$this->group .= 'GROUP BY '.$group;
		}else{
			$this->group .= ', '.$group;
		}
	}
	public function limit($limit){
		$this->limit = 'LIMIT '.$limit;
	}
	public function find( $query='', $objectified = true){
		$db = $this->getDatabase();
		
		if($this->MDB2_connect($db['type'], $db['username'], $db['userpass'], $db['host'], $db['name'])){
			if(stristr($query, ' ') != ''){
				//Uebergebenen Query ausfuehren
				$this->last_query = $query;
				$this->reset();
				return $this->MDB2_getResult( $query );
			}else{
				//query zusammenbauen
				if($this->select == ''){
					$this->select = 'SELECT * ';
				}
				
				$buildquery = $this->select.' ';
				$buildquery .= 'FROM '.$query.' ';
				$buildquery .= $this->join.' ';
				
				if($this->whereGet != ''){
					$buildquery .= $this->whereGet.' ';
				}else{
					$buildquery .= $this->where.' ';
				}
				
				$buildquery .= $this->group.' ';
				$buildquery .= $this->order.' ';
				$buildquery .= $this->limit.' ';
				
				$this->last_query = $buildquery;
				
				$this->reset();
				$resultlist = $this->MDB2_getResult( $buildquery );
				if($objectified){
					return $this->prepareObjects($resultlist, $query);
				}
				return $resultlist;
			}
		}
		return false;
	}
	private function prepareObjects($list, $table){
		$results = array();
		foreach($list as $item){
			$object = new dataobject($this);
			$object->setTable($table);
		
			foreach($item as $key=>$value){
				$object->setValue($key, $value);
			}
			$object->resetChanges();
			
			$results[] = $object;
		}
		return $results;
	}
	public function delete($query=''){
		$db = $this->getDatabase();
		
		if($this->MDB2_connect($db['type'], $db['username'], $db['userpass'], $db['host'], $db['name'])){
			if(stristr($query, ' ') != ''){
				//Uebergebenen Query ausfuehren
				$this->last_query = $query;
				$this->reset();
				return $this->MDB2_getResult( $query );
			}else{
				//query zusammenbauen
				
				$buildquery = 'DELETE FROM '.$query.' ';
				
				
				if($this->whereGet != ''){
					$buildquery .= $this->whereGet.' ';
				}else{
					$buildquery .= $this->where.' ';
				}
				
				
				$this->last_query = $buildquery;
				
				$this->reset();
				return $this->MDB2_getResult( $buildquery );
			}
		}
		return false;
	}
	public function reset(){
		$this->select = '';
		$this->where = '';
		$this->whereGet = '';
		$this->join = '';
		$this->order = '';
		$this->group = '';
		$this->limit = '';
		$this->set = '';
		$this->fields = array();
	}
	public function set($field, $value){
		$field = mysql_escape_string($field);
		$value = mysql_escape_string($value);
		
		if(stristr($value, '()') == '()'){
			
		}else{
			$value = '"'.$value.'"';
		}
		
		if($this->set == ''){
			$this->set .= 'SET '.$field.' = '.$value.' ';
		}else{
			$this->set .= ', '.$field.' = '.$value.' ';
		}
	}
	public function update($query=''){
		$db = $this->getDatabase();
		if($this->MDB2_connect($db['type'], $db['username'], $db['userpass'], $db['host'], $db['name'])){
			if(stristr($query, ' ') != ''){
				//Uebergebenen Query ausfuehren
				$this->last_query = $query;
				$this->reset();
				return $this->MDB2_update( $query );
			}else{	
				//query zusammenbauen
				$buildquery = 'UPDATE '.$query.' ';
				$buildquery .= $this->set.' ';
				
				if($this->whereGet != ''){
					$buildquery .= $this->whereGet.' ';
				}else{
					$buildquery .= $this->where.' ';
				}
				
				$this->last_query = $buildquery;
				$this->reset();
				return $this->MDB2_update( $buildquery );
			
				
			}
		}
		return false;
	}
	public function insertValue($key, $value){
		$this->fields[$key] = $value;
	}
	public function insert($query=''){
		$db = $this->getDatabase();
		if($this->MDB2_connect($db['type'], $db['username'], $db['userpass'], $db['host'], $db['name'])){
			if(stristr($query, ' ') != ''){
				//Uebergebenen Query ausfuehren
				$this->last_query = $query;
				$this->reset();
				return $this->MDB2_update( $query );
				
			}else{
				//query zusammenbauen
				$buildquery = 'INSERT INTO '.$query.' ';
				
				$keys = array_keys($this->fields);
				$felder = count($this->fields);
				
				$buildquery .= '('.implode(', ', $keys).') ';
				
				$values = '';
				foreach ($this->fields as $key=>$value) {
							
					if($values == ''){
						if(in_array($value, $this->sqlFunktionen)){
							$values .= ''.$value.' ';
						}else{
							$values .= '"'.$value.'" ';
						}
					}else{
						if(in_array($value, $this->sqlFunktionen)){
							$values .= ', '.$value.' ';
						}else{
							$values .= ', "'.$value.'" ';
						}
						
					}
					
				}
				$buildquery .= 'VALUES ('.$values.')';
				$this->last_query = $buildquery;
				$this->reset();
				return $this->MDB2_update( $buildquery );
			}
		}
		return false;
	}
	/**
	 * DB Connect wird aufgebaut
	 *
	 * @return Object $mdb2
	 */ 
	public function MDB2_connect($type, $user, $password, $host, $name){
		//Datenbank Connection wird mit den Userdaten aufgebaut
		
		if(!isset($this->connections[$type."://".$user.":".$password."@".$host."/".$name])){
			$mdb2 =& MDB2::factory($type."://".$user.":".$password."@".$host."/".$name);
			if (PEAR::isError($mdb2)) 
			{
				//Wenn es zu einem Fehler kommt wird die Fehlermeldung ausgegeben und das Skript an dieser Stelle abgebrochen
		    	die( ($mdb2->getMessage().' - '.$mdb2->getUserinfo()) );
			}
			
			//laed zusaetzliche Erweiterungen
			$mdb2->loadModule('Extended');
			$this->connections[$type."://".$user.":".$password."@".$host."/".$name] = $mdb2;
		}else{
			$mdb2 = $this->connections[$type."://".$user.":".$password."@".$host."/".$name];
		}
		//speichert das Datenobjekt 
		if($this->mdb2 = $mdb2){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * DB Abfrage gibt alle Zeilen als zweidimensionales Assoz. Array zur�ck
	 *
	 * @param Object $mdb2
	 * @param String $query
	 * @param String $fetchmode
	 * @param Array $types
	 * @return Array
	 *
	 */ 
	private function MDB2_getResult($query, $fetchmode = MDB2_FETCHMODE_ASSOC, $types = null) {
		if(!is_object($this->mdb2)){
			return false;
		}
	    $result = $this->mdb2->queryAll($query, $types, $fetchmode);  
    
		// Prueft ob der Query erfolgreich ausgearbeitet wurde und  
		// gibt im Zweifelsfall eine Fehlermeldung zurueck
		// und bricht das Skript an dieser Stelle ab
	    if (PEAR::isError($result)) {
	        die (($result->getMessage().' - '.$result->getUserinfo()));
	    }
    
	    return $result;
	}
	/**
	 * DB Eintraege Updaten
	 * Gibt die Anzahl der geaenderten Zeilen zurueck
	 *
	 * @param Object $mdb2
	 * @param String $query
	 * @return Bool
	 *
	 */
	public function MDB2_update($query, $error=true){
		if(!is_object($this->mdb2)){
			return false;
		}
		
		$result =& $this->mdb2->exec($query);

		// Always check that result is not an error
		if($error == true)
		{
			if (PEAR::isError($result)) {
		        die (($result->getMessage().' - '.$result->getUserinfo()));
		    }
	    }
	    return $result;
	}
}

?>