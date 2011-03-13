<?php

function smarty_function_link($params, &$smarty){
	
	switch($params['type']){
		default:
		case 'site':
			$type = 'site';
		break;
		case 'module':
			$type = 'module';
		break;
	}

	$path = $params['path'];
	
	$core = $smarty->core;
	
	
	$prePath = implode('/', array_slice(explode('/', $core->getServer('PHP_SELF')), 0,-1));

	if($core->getTemplate()->rewriteRule){
		return $prePath.'/'.$type.'/'.$path.'.html';
	}
	return $prePath.'/index.php?type='.$type.'&'.$type.'='.$path;
	
	
	
	
}

?>