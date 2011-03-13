<?php

require_once('externals/Smarty-2.6.26/Smarty.class.php');

class Template extends Includes{
	
	public $rootPath = '/';
	public $theme = 'base';
	public $smarty = null;
	public $themePath = null;
	public $defaultTheme = 'themes/';
	public $pluginsPath = null;
	public $externalsPath = 'externals/';
	
	public $files = "files/";
	
	public $rewriteRule = false;
	
	public $smarty_left_delimiter = '<@';
	public $smarty_right_delimiter = '@>';
	
	public $smarty_compile_dir = "files/cache/template_compiled/";
	
	public function __construct($core, $name){
		parent::__construct($core, $name);
		
		$this->smarty = $this->getPreparedSmarty($this->theme);
		
	}
	private function getPreparedSmarty($theme='base'){

		$smarty = new Smarty;
		$smarty->core = $this->core;
		
		$smarty->left_delimiter = $this->smarty_left_delimiter;
		$smarty->right_delimiter = $this->smarty_right_delimiter;
				
		if(file_exists($this->themePath.$theme)){
			$themepath = $this->themePath.$theme."/";
		}else{
			$themepath = $this->themePath.$this->defaultTheme.'/';
			$theme = $this->defaultTheme;
		}
		
		$smarty->compile_dir	= $this->smarty_compile_dir.$theme;
		if(!file_exists($smarty->compile_dir)){ $this->core->makedir($smarty->compile_dir);} //Verzeichniss erzeugt
		
		$smarty->template_dir 	= $themepath;
		$smarty->plugins_dir[]  = $this->pluginsPath;
		// $smarty->themePath = $this->themePath;
		// $smarty->defaultTheme = $this->defaultTheme;
		
		$smarty->assign('PHP_SELF', $this->core->GetServer('PHP_SELF'));
		$smarty->assign('REQUEST_URI', $this->core->GetServer('REQUEST_URI'));
		$smarty->assign('ROOT', $this->rootPath);
		$smarty->assign('THEME', $this->theme);
		$smarty->assign('TEMPLATE_DIR', $this->rootPath.'/'.$themepath);
		$smarty->assign('TEMPLATE_DIR_BASE', $this->rootPath.'/'.$this->themePath.$this->defaultTheme.'/');
		$smarty->assign('EXTERNALS_DIR', $this->rootPath.'/'.$this->externalsPath);
		$smarty->assign('FILES_DIR', $this->rootPath.'/'.$this->files);
		
		return $smarty;
	}
	
	/* Von SMARTY übernommene Funktionen zur einfacheren Benutzung */
	public function assign($key, $value){
		$this->smarty->assign($key, $value);
	}
	public function fetch($template){
		$this->prepareThemeDirectories($template);
		return $this->smarty->fetch($template);
	}
	public function display($template){

		$this->prepareThemeDirectories($template);	
		$this->smarty->display($template);
	}
	public function prepareThemeDirectories($template){
		if(!file_exists($this->smarty->template_dir.$template)){
			$this->smarty->template_dir = $this->themePath.$this->defaultTheme.'/';
			$this->smarty->compile_dir	= $this->smarty_compile_dir.$this->defaultTheme;
			if(!file_exists($this->smarty->compile_dir)){ $this->core->makedir($this->smarty->compile_dir);} //Verzeichniss erzeugt
		}
	}
	public function setTemplateToModule($modulname){
		$modulname = strtolower($modulname);
		$this->smarty->compile_dir	= $this->smarty_compile_dir."modules/".$modulname;
		if(!file_exists($this->smarty->compile_dir)){ $this->core->makedir($this->smarty->compile_dir);} //Verzeichniss erzeugt
		$this->smarty->template_dir = 'modules/'.$modulname.'/templates/';
	}
}
