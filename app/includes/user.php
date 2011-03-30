<?php 

class User extends Includes{
	
	public function __construct($core, $name){
		parent::__construct($core, $name);
		
	}
	
	public function login($username='', $password=''){
		
		$db = $this->getDatabase();
		
		$db->whereAdd('username', strtolower($username));
		$db->whereAdd('password', md5($password));
		
		$list = $db->find('jx_users');
		if(count($list) == 1){
			
			$user = reset($list);
			
			$this->core->setSession('user_id', $user->id);
			
			$this->addUserToListedLoggedInUsers($user->id, $user->username);
			
			return true;
			
		}else{
			return false;
		}
	}
	public function getUserCountListedAsLoggedIn(){
		$db = $this->getDatabase();
		
		$db->selectAdd('count(id) as count');
		$db->whereAdd('edited > "'.date('Y-n-d H:i:m', time()-900).'"');
		$counter = $db->find('jx_users_loginlog');
		$count = reset($counter);
		return $count->count;
	}
	public function getUsersListedAsLoggedIn($limit=5){
		
		$count = $this->getUserCountListedAsLoggedIn();
		$db = $this->getDatabase();
		$db->orderBy('edited DESC');
		
		//zeigt alle user an die in den letzten 15 min aktiv waren
		$db->whereAdd('edited > "'.date('Y-n-d H:i:m', time()-900).'"');
		$db->limit($limit);
		$allList = $db->find('jx_users_loginlog');
			
		return array('count'=>$count, 'list'=>$allList);
	}
	public function addUserToListedLoggedInUsers($user_id, $username){
		
		$this->removeUserFromListedLoggedInUsers($user_id);
		$db = $this->getDatabase();
		$db->insertValue('user_id', $user_id);
		$db->insertValue('username', $username);
		
		$result = $db->insert('jx_users_loginlog');
		
		if($result == 1){
			return true; 
		}
		return false;
	}
	public function removeUserFromListedLoggedInUsers($user_id){
		
		$db = $this->getDatabase();
		$db->whereAdd('user_id', $user_id);
		$result = $db->delete('jx_users_loginlog');
		if($result == 1){
			return true; 
		}
		return false;
	}
	public function logout(){
		
		$user_id = $this->core->getSession('user_id', false);
		if($user_id !== false){
			$this->removeUserFromListedLoggedInUsers($user_id);
		}
		$this->core->setSession('user_id', false);
		
	}
	public function getData($user_id){
		$db = $this->getDatabase();
		
		$db->whereAdd('id', strtolower($user_id));
		
		$list = $db->find('jx_users');
		if(count($list) == 1){
			return reset($list);
		}
		return false;
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
			$db->insertValue('password', md5($array['password']));
			$db->insertValue('email', strtolower($array['email']));

			$db->insertValue('rightgroup_id', 1);
			
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