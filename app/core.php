<?php

require_once('app/corebasics/last.php');

class Core extends core_last{
	
	public function __construct(){
		parent::__construct();
		
		
		
		$this->buildMainCore();
		
		
		switch ($this->GetGet('type')) {
			default:
			case 'site':
				$this->buildSiteContent();
			break;
			case 'modules':
				if(isset($this->includes['Modules'])){
					$request = $this->GetPost('request');
					
					$results = array();
					foreach($request as $module){
						
						$moduleDataObject = $this->getModules()->loadModule($module['name']);

						$moduleObject = $moduleDataObject->object;
						$moduleObject->setup($module['params']);
						
						$results[] = array(			'module'	=>$module, 
													'params'	=>$module['params'],
													'content'	=>$moduleObject->loadContent(),
													'header'	=>$moduleObject->loadHeader(),
													'footer'	=>$moduleObject->loadFooter()
													);
					}
					
					echo json_encode($results);
					die();
				}
			break;
			case 'module':
				if(isset($this->includes['Modules'])){	
					
					$module = $this->GetGet('module');
					$params = $this->GetGet('params');
					
					$moduleDataObject = $this->getModules()->loadModule($module);
					$moduleObject = $moduleDataObject->object;
					$moduleObject->setup($params);
					
					echo json_encode(array(		'module'	=>$module, 
												'params'	=>$params,
												'content'	=>$moduleObject->loadContent(),
												'header'	=>$moduleObject->loadHeader(),
												'footer'	=>$moduleObject->loadFooter()
												));
					die();
				}
			break;
			case 'overlay':
				if(isset($this->includes['Modules'])){
					
					$module = $this->Get('module');
					$params = $this->Get('params');
					
					$moduleObject = $this->getModules()->loadModule($module);
					$moduleObject->object->setup($params);
					
					$Template = $this->getTemplate(true);
					
					
					$functionName = 'overlay_'.$this->Get('action');

					$Template->assign('modul', $moduleObject);
					
					$overlay = $moduleObject->object->$functionName();
					
					if(!is_array($overlay)){
						$overlay = array();
					}
					if(!isset($overlay['head'])){
						$overlay['head'] = false;
					}
					if(!isset($overlay['content'])){
						$overlay['content'] = false;
					}
					if(!isset($overlay['footer'])){
						$overlay['footer'] = false;
					}
					
					
					$Template->assign('overlay', $overlay );
					
					$Template->display('overlay.tpl');
					die();
				}
			break;
			case 'ajax':
				if(isset($this->includes['Modules'])){
					
					$module = $this->Get('module');
					$params = $this->Get('params');
					$action = $this->Get('action');
					
					$moduleObject = $this->getModules()->loadModule($module);
					
					$funktionsname = 'ajax_'.$action;
					

					$result = false;
					if(method_exists($moduleObject->object, $funktionsname)){
						$result = $moduleObject->object->{$funktionsname}();
					}
					
					echo json_encode($result);
					die();
				}
			break;
		}
			

		

	}
	private function buildMainCore(){
		
	}
	private function buildSiteContent(){
		
		$Template = $this->getTemplate();
		
		$Template->assign('site', $this->getSites()->loadSite());
		
		$Template->assign('moduleIncludes', $this->getModules()->getAllModuleIncludeFiles());
		
		$Template->display('index.tpl');
	}


	

}