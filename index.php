<?php

session_start();
session_name("j10_".$_SERVER['HTTP_HOST']);

require_once('app/core.php');


$core = new Core();



//$core->printLog(); 