<?php

function smarty_function_slot($params, &$smarty){

	if(isset($params['id']) && !empty($params['id']) || isset($params['title']) && !empty($params['title'])){
		$Sites = $smarty->core->getSites();
		
		
		if(isset($params['title']) && !empty($params['title']) ){
			$slotobject = $Sites->getSlotByTitle($params['title']);
		}else{
			$slotobject = $Sites->getSlotByID($params['id']);
		}

		
		
		if($slotobject !== false){

			$modules = $smarty->core->getModules()->getModulesForSlot($slotobject);

			$Template = $smarty->core->getTemplate();
			//$Template->smarty->clear_all_assign();

			$Template->assign('slot', $slotobject);
			$Template->assign('modules', $modules);
			

			$result = $Template->fetch('slot.tpl');
			
			
			return $result;
		}
	}
	return '';
}