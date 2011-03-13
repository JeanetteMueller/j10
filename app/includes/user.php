<?php 

class User extends Includes{
	
	public function __construct($core, $name){
		parent::__construct($core, $name);
		
	}
	
	public function login($username='', $password=''){
		
	}
	public function getData(){
		
	}
	public function getRights(){
		
	}
	public function isAllowedFor($rightName){
		
	}
	public function getGenders(){
		$db = $this->getDatabase();
		
		return $db->find('jx_user_gender');
		
	}
	public function checkIfIsRegistered($array){
		$felder = array();
		
		
		if(!$this->getMail()->isMail($array['email'])){
			$felder[] = 'email';
		}
		
		if(strlen($array['password']) < 6 || $array['password'] != $array['password2']){
			$felder[] = 'password';
			$felder[] = 'password2';
		}
		
		$db = $this->getDatabase();
		
		$db->whereAdd('username', strtolower($array['username']), '=', 'OR');
		$db->whereAdd('email', strtolower($array['email']), '=', 'OR');
		
		$list = $db->find('jx_users');
		
		if(count($list) > 0){
			
			$user = reset($list);
			
			if(strtolower($user->username) == strtolower($array['username']) ){
				$felder[] = 'username';
			}
			if(strtolower($user->email) == strtolower($array['email']) ){
				$felder[] = 'email';
			}
			
		}
		
		if(count($felder) > 0){
			return $felder;
		}
		return false;
	}
	public function register($array){
		
		if($this->checkIfIsRegistered($array) === false){
			
			$db = $this->getDatabase();
			$db->insertValue('created', 'NOW()');
			$db->insertValue('username', strtolower($array['username']));
			$db->insertValue('email', strtolower($array['email']));

			$db->insertValue('password', md5($array['password']));
			$db->insertValue('gender', $array['gender']);
			$db->insertValue('birthday', $array['birthday_year'].'-'.$array['birthday_month'].'-'.$array['birthday_day']);
			$result = $db->insert('jx_users');
			
			if($result == 1){
				return true; 
			}
		}
		
		return false;
		
	}
	
}