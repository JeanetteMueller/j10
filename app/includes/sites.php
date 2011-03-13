<?php

class Sites extends Includes{
	
	private $site = 'index';

	public function __construct($core, $name){
		parent::__construct($core, $name);
	}
	public function getSite(){
		return $this->loadSiteFromDB($this->site);
	}
	public function loadSite(){
		
		if($this->core->GetGet('site') !== false){
			$this->site = $this->core->GetGet('site');
		}
		
		return $this->getSite();
		
		
	}

	public function loadSiteFromDB($site){
		$db = $this->getDatabase();
		
		$db->whereAdd('path', $site);
		$siteObjects = $db->find('jx_sites');
		if(count($siteObjects) > 0){
			return reset($siteObjects);
		}
		return false;
	}
	public function getSlotByTitle($slottitle){
		$siteobject = $this->getSite();
		$db = $this->getDatabase();
		
		$db->whereAdd('title', 		$slottitle);
		$db->whereAdd('site_id', 	$siteobject->id);
		
		$db->whereAdd('jx_slots.deleted IS NULL');
		$db->whereAdd('jx_slottypes.deleted IS NULL');
		
		$db->joinAdd('jx_slottypes', 'jx_slottypes.id = jx_slots.slottype_id');
		$result = $db->find('jx_slots');
		if (count($result) > 0) {
			return reset($result);
		}
		return false;
	}
	public function getSlotByID($slotid){
		$siteobject = $this->getSite();
		$db = $this->getDatabase();
		
		$db->whereAdd('id', 		$slotid);
		$db->whereAdd('site_id', 	$siteobject->id);
		
		$result = $db->find('jx_slots');
		if (count($result) > 0) {
			return reset($result);
		}
		return false;
	}
	private function getSlotsForSite($siteobject){
		
		$db = $this->getDatabase();
		
		$db->whereAdd('site_id', $siteobject->ID);
		return $db->find('jx_slots');
		
	}
	public function getNavigationTree($root=0){
		$db = $this->getDatabase();
		$db->whereAdd('root_id', $root);
		$db->orderBy('sort');
		$sites = $db->find('jx_sites');
		
		$tree = array();
		foreach($sites as $site){
			//echo $site->id.' '.$site->title.' - '.$site->site_id."<br />";
			
			$site->subnavi = $this->getNavigationTree($site->id);
			
			$tree[] = $site;
		}
		return $tree;
	}
	
	
}