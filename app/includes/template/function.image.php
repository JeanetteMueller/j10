<?php

function smarty_function_image($params, &$smarty){
	
	//var_dump($params);

	$core = $smarty->core;
	
	if($params['alt'] !== false){
		$alt = $params['alt'];
	}else{
		$alt = '';
	}
	if($params['title'] !== false){
		$title = $params['title'];
	}else{
		$title = $alt;
	}
	

	if(isset($params['width']) && $params['width'] !== 'auto'){
		$width = $params['width'];
	}else{
		$width = 'auto';
	}
	
	if(isset($params['height']) && $params['height'] !== 'auto'){
		$height = $params['height'];
	}else{
		$height = 'auto';
	}
		

	
	
	if(!isset($params['link']) || $params['link'] === false){
		$link = false;
	}else{
		$link = $params['link'];
	}
	
	$imageClassOriginal = $core->getTools()->Image;
	$imageClass = clone($imageClassOriginal);
	
	$imageClass->setBase($params['base']);
	$imageClass->setFile($params['file']);
	
	$imageClass->setWidth($width);
	$imageClass->setHeight($height);

	$imageClass->setAlt($alt);
	$imageClass->setTitle($title);
	
	$imageClass->setLink($link);
	
	if(isset($params['fill'])){
		$imageClass->setFill($params['fill']);
	}

	return $imageClass->getImageTag();
	
}

?>