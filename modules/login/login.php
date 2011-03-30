<?php

class Module_Login extends Module{
	
	public function setup($params){
		
		//var_dump($params);
		
		if($this->getPost('module_login_action', false) == 'login'){
			
			$module_login_username = $this->getPost('module_login_username', false);
			$module_login_password = $this->getPost('module_login_password', false);
			
			if($module_login_username !== false && $module_login_password !== false){
				
				
				$login = $this->getUser()->login($module_login_username, $module_login_password);
				
				if($login){
					header('location: '.$this->core->getServer('HTTP_REFERER'));
					return;
				}
			}
			//var_dump($this->getServer());
			header('location: '.$this->getServer('HTTP_REFERER'));
			return;
		}
		
		
		
		if($params == 'logout'){
			
			$this->getUser()->logout();
			
			header('location: '.$this->getServer('HTTP_REFERER'));
			return;
		}
		
		
		
		if($this->getSession('user_id', false) !== false){
			
			$this->assign('loggedIn', true);
			
			$user_id = $this->getSession('user_id');
			
			$user = $this->getUser()->getData($user_id);
			
			$this->assign('user', $user);
		}
	}
	public function autoRefresh(){
		return false;
	}
	public function getHeader(){
		$this->assign('loggedIn', false);
		
		if($this->getSession('user_id', false) !== false){
			
			$this->assign('loggedIn', true);
		}
	} 
	public function getFooter(){
		$this->assign('loggedIn', false);
		
		if($this->getSession('user_id', false) !== false){
			
			$this->assign('loggedIn', true);
		}
	}
	public function getContent(){
		
		$this->assign('loggedIn', false);
		
		if($this->getSession('user_id', false) !== false){
			
			$this->assign('loggedIn', true);
		}
	}
	
}