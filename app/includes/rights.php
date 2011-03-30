<?php 

class Rights extends Includes{
	
	public function __construct($core, $name){
		parent::__construct($core, $name);
		
	}
	
	public function hasRightFor($user_id, $modul_id, $action){
		
		if($user_id !== false){
			$user = $this->getUser()->getData($user_id);
			$user_group_id = $user->group_id;
		}else{
			$user_group_id = 0;
		}
		
		
		$db = $this->core->getDatabase();
		
		$db->whereAdd('group_id <= '.$user_group_id);
		if($modul_id !== false){
			$db->whereAdd('modul_id', $modul_id);
		}
		$db->whereAdd('action', $action);
		
		$results = $db->find('jx_user_rights');
		//echo $db->last_query;
		
		if(count($results) > 0){
			
			$result = reset($results);
			
			if($result->group_id < $user_group_id){
				if($result->group_above == 1){
					return true;
				}
				return false;
			}
			return true;
		}
		return false;
	}
}