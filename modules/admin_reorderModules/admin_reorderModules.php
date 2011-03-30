<?php

class Module_Admin_reorderModules extends Module{	
	
	public function setup($params){
		parent::setup($params);
	}
	public function autoRefresh(){
		return false;
	}


	
	public function ajax_saveModulePlace(){
		$params  = $this->getPost('params');
		
		//var_dump($params);
		
		$db = $this->getDatabase();
		
		foreach($params as $slot_id => $modules){
			
			$sort = 50;
			
			foreach($modules as $modultoslot_id){
				
				$db->whereAdd('id', $modultoslot_id);
				$results = $db->find('jx_modul_to_slots_in_site');
				
				$eintrag = reset($results);
				
				$eintrag->setValue('slot_id', $slot_id);
				$eintrag->setValue('sort', $sort);
				
				$eintrag->syncronize();
				
				$sort = $sort + 10;
			}
			
		}
		
		return true;
	}
}