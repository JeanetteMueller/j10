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
				
				if(count($results) > 0){
					$eintrag = reset($results);
					
					$eintrag->setValue('slot_id', $slot_id);
					$eintrag->setValue('sort', $sort);

					$eintrag->syncronize();
				}
				
				
				
				
				$sort = $sort + 10;
			}
			
		}
		
		return true;
	}
	public function ajax_insertNewModuleInPlace(){
		
		$params  = $this->getPost('params');
		
		$db = $this->getDatabase();
		$db->insertValue('created', 'NOW()');
		$db->insertValue('modul_id', $params['modul_id']);
		$db->insertValue('slot_id', $params['slot_id']);
		$db->insertValue('site_id', $params['site_id']);
		$db->insertValue('sort', $params['sort']);
		$db->insertValue('params', $params['params']);
		
		$result = $db->insert('jx_modul_to_slots_in_site');
		
		
		$db->whereAdd('modul_id', $params['modul_id']);
		$db->whereAdd('slot_id', $params['slot_id']);
		$db->whereAdd('site_id', $params['site_id']);
		$db->orderBy('id DESC');
		
		$results = $db->find('jx_modul_to_slots_in_site');
		
		//echo $db->last_query;
		
		if(count($results) > 0){
			$result = reset($results);

			//var_dump($result);

			$moduleDataObject = $this->getModules()->loadModule($params['modul']);
			$moduleDataObject->id = $result->id;
			$moduleObject = $moduleDataObject->object;

			//var_dump($result->params);
			
			$moduleDataObject->object->setup($result->params);
			$template = $moduleObject->getTemplate();
			$template->assign('modul', $moduleDataObject);
			die( $template->fetch('modul.tpl') );

		}
		
		//{"contentid":2}
		
		return true;
	}
	public function ajax_removeModuleFromPlace(){
		$params  = $this->getPost('params');
		
		$db = $this->getDatabase();
		
		$db->whereAdd('id', $params['modulslot_id']);
		$results = $db->find('jx_modul_to_slots_in_site');
		
		if(count($results) > 0){
			$eintrag = reset($results);
			
			$eintrag->setValue('deleted', 'NOW()');

			$eintrag->syncronize();
		}
		return true;
	}
	public function getContent(){
		
		$modules = $this->getModules()->getAllModules();
		
		$this->assign('modules', $modules);
		
		return true;
	}
}