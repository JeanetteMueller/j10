<?php

$serverPath = $_SERVER['SCRIPT_FILENAME'];
$serverPathParts = explode('/', $serverPath);
$file = array_pop($serverPathParts);
$serverPath = implode('/', $serverPathParts);

if($_SERVER['HTTP_HOST'] !== 'home.themaverick.de' && $_SERVER['HTTP_HOST'] !== 'localhost'){

	ini_set('error_reporting', E_ALL|E_STRICT);
	error_reporting(E_ALL|E_STRICT);
	ini_set('log_errors',TRUE);
	ini_set('html_errors',TRUE);
	ini_set('error_log',$serverPath.'/files/logs/error_log.txt');
	ini_set('display_errors',TRUE);
}

$sessionDir = $serverPath.'/files/cache/session';
if(!is_dir($sessionDir)){
	mkdir($sessionDir, 0777, true);
}
ini_set('session.save_path',$sessionDir);

session_start();
session_name("j10_".$_SERVER['HTTP_HOST']);

require_once('app/core.php');


$core = new Core();



//$core->printLog(); 