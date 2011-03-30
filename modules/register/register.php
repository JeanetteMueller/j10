<?php

class Module_Register extends Module{
	
	public function ajax_isRegistered(){
		
		$parameter  = $this->getPost('params');
		
		$anfrage = $this->cleanParams($parameter);
		
		return $this->getUser()->checkIfIsRegistered($anfrage);

	}
	public function overlay_form(){
		
		$Template = $this->getMyTemplate();
		
		$date = $this->getTools()->Date;
		$date->setPrefix(' – ');
		
		$Template->assign('days',  $date->getDays());
		$Template->assign('month', $date->getMonth());
		$Template->assign('years', $date->getYears());
		$Template->assign('genders', $this->getUser()->getGenders());
		
		$params = $this->getPost('params');

		if($params['module_register_action'] == 'register'){
			$Template->assign('username', $params['module_register_username']);
			$Template->assign('email', $params['module_register_email']);

			$Template->assign('birthday_day', $params['module_register_birthday_day']);
			$Template->assign('birthday_month', $params['module_register_birthday_month']);
			$Template->assign('birthday_year', $params['module_register_birthday_year']);
			$Template->assign('gender', $params['module_register_gender']);
		}
			
		return array(
			'head'		=> $Template->fetch('head.tpl'),
			'content'	=> $Template->fetch('content.tpl')
		);
	}
	private function cleanParams($array){
		$anfrage = array();
		
		foreach($array as $key=>$value){
			$anfrage[str_replace('module_register_', '', $key)] = $value;
		}
		return $anfrage;
	}
	
	public function overlay_register(){
		
		$params = $this->getPost('params');
		$registerFailed = false;
		if($params['module_register_action'] == 'register'){
			
			//user anlegen
			$anfrage = $this->cleanParams($params);
			
			if($this->getUser()->register($anfrage)){
				$this->assign('register', true); 
			}else{
				$registerFailed = true;
			}
		}
		
		
		
		if($registerFailed){
			return $this->overlay_form();
		}
		
		$Template = $this->getMyTemplate();
		return array(
			'head'		=> $Template->fetch('head.tpl'),
			'content'	=> $Template->fetch('content.success.tpl')
		);
		
	}
	public function autoRefresh(){
		return false;
	}

	
}