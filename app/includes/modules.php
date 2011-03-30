<?php
require_once('app/includes/modules/module.php');

class Modules extends Includes{
	
	//wird durch die config überschrieben
	public $pathForModules 	= 'modules/';
	
	public function __construct($core, $name){
		parent::__construct($core, $name);
	}
	public function getAllModules(){
		
		$db = $this->getDatabase();
		$db->whereAdd('deleted IS NULL');
		return $db->find('jx_modul');
	}
	public function getAllModuleIncludeFiles(){
		$modules = $this->getAllModules();
		
		$results = array();
		foreach($modules as $modul){
			if(file_exists($this->pathForModules.$modul->path.'/js/javascript.js')){
				$results['javascript'][] = $this->pathForModules.$modul->path.'/js/javascript.js';
			}
			if(file_exists($this->pathForModules.$modul->path.'/css/styles.css')){
				$results['css'][] = $this->pathForModules.$modul->path.'/css/styles.css';
			}
		}
		
		return $results;
	}
	public function getModulesForSlot($slotobject){
		
		$db = $this->getDatabase();
		

		$siteobject = $this->getSites()->getSite();
		
		if ($siteobject->id == $slotobject->site_id) {
			
			
			$db->whereAdd('jx_modul_to_slots_in_site.slot_id', $slotobject->id);
			$db->whereAdd('jx_modul_to_slots_in_site.site_id = '.$siteobject->id.' OR jx_modul_to_slots_in_site.site_id IS NULL');
			$db->whereAdd('jx_modul_to_slots_in_site.deleted IS NULL');
			$db->joinAdd('jx_modul_to_slots_in_site', 'jx_modul.id = jx_modul_to_slots_in_site.modul_id');
			$db->orderBy('sort');
			$db->whereAdd('jx_modul_to_slots_in_site.deleted IS NULL');
			$db->whereAdd('jx_modul.deleted IS NULL');
			$moduls = $db->find('jx_modul');
			
			return $this->prepareModuleList($moduls);
		}
		return false;
	}
	public function getModuleObjectbyPath($path){
		if(file_exists('modules/'.$path.'/'.$path.'.php')){
			require_once('modules/'.$path.'/'.$path.'.php');
			
			$db = $this->getDatabase();

			$db->whereAdd('path', $path);
			$db->whereAdd('deleted IS NULL');
			$moduls = $db->find('jx_modul');
			
			$results = $this->prepareModuleList($moduls);
			if(count($results) > 0){
				return reset($results);
			}
		}
		return false;
	}
	public function getModulesBySlot($slotobject){
		$db = $this->getDatabase();
		
		$db->whereAdd('jx_modul_to_slots_in_site.slot_id', $slotobject->id);
		$db->joinAdd('jx_modul_to_slots_in_site', 'jx_modul.id = jx_modul_to_slots_in_site.modul_id');
		$db->whereAdd('jx_modul_to_slots_in_site.deleted IS NULL');
		$db->whereAdd('jx_modul.deleted IS NULL');
		$moduls = $db->find('jx_modul');
		
		return $this->prepareModuleList($moduls);
	}
	private function prepareModuleList($moduls){
		$results = array();
		
		if($this->core->getget('type') == 'site' && $this->getRights()->hasRightFor($this->core->getSession('user_id'), false, 'reorderModules')){
			
			$reorder = new stdClass();
			$reorder->path = 'admin_reorderModules';
			$reorder->id = rand(1000, 9999);
			$reorder->admin = true;
			require_once('modules/admin_reorderModules/admin_reorderModules.php');
			$reorder->object = new Module_Admin_reorderModules($this->core, 0, 'admin_reorderModules');
			$reorder->object->setup(null);
			$results[] = $reorder;
		}
		
		foreach($moduls as $module){
			if(file_exists('modules/'.$module->path.'/'.$module->path.'.php')){
				
				require_once('modules/'.$module->path.'/'.$module->path.'.php');
				
				$modulName = 'Module_'.ucfirst($module->path);
				
				$module->object = new $modulName($this->core, $module->id, $module->path);
				if(!empty($module->params)){
					$module->object->setup($module->params);
				}else{
					$module->object->setup($this->core->getget('params', null));
				}
				$results[] = $module;

				
				
			}
		}


		return $results;
	}
	private function parseExtensionInfo($file){
		
		if(file_exists($this->pathForModules. $file.'/'.$file.'.info.php')){
			
			$name = '';
			$autor = '';
			$version = '';
			$pluginUrl = '';
			$autorUrl = '';

			require_once($this->pathForModules . $file.'/'.$file.'.info.php');

			return array(
				'name'		=> $name,
				'autor'		=> $autor,
				'version'	=> $version,
				'pluginUrl'	=> $pluginUrl,
				'autorUrl'	=> $autorUrl
				);
		}
		return false;
	}
	public function loadModule($name){
		
		$Module = $this->getModuleObjectbyPath($name);
		
		if($Module != false){
			
			return $Module;
		}
		return false;

	}
}