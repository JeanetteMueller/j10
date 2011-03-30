<?php

class Module_Onlineuser extends Module{
		
	public function autoRefresh(){
		return true;
	}
	
	public function getHeader(){
		$result = $this->getUser()->getUserCountListedAsLoggedIn();

		$count = $result['count'];
		
		$this->assign('count', $count);
	}
	public function getContent(){
		parent::getContent();
		
		if($this->core->getget('type') == 'site'){
			$user_id = $this->getSession('user_id');
			if($user_id !== false){
				$user = $this->getUser()->getData($user_id);
				$this->getUser()->addUserToListedLoggedInUsers($user->id, $user->username);
			}
		}
		
		$result = $this->getUser()->getUsersListedAsLoggedIn($this->params['itemcount']);
		
		$users = $result['list'];
		$count = $result['count'];
		
		$list = array();
		
		if(count($users) > 0){
			
			foreach($users as $user){
				
				$list[] = array('id'=>$user->id, 'username'=>$user->username);
				
			}

			
		}
		
		if(count($list) == 0){
			$list = array(array('username'=>'keine User online'));
		}
		
		$this->assign('list', $list);
	}

}