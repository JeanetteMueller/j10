<?PHP

class Tools extends Includes{
	private $pathFor_tools = 'app/tools/';
	
	public function __construct($core, $name){
		parent::__construct($core, $name);
		
		
		$dir = $this->pathFor_tools;
		
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {
		        while (($file = readdir($dh)) !== false) {
					
					if(substr($file, -4) == '.php' && substr($file, 0,2) !== '._'){
						require_once($dir . $file);

						$className = $file;
						$className = str_replace('.php', '', $className);
						$className = ucfirst($className);
						
						$this->$className = new $className();
						//$this->subLog("Load Tools: ".$className);
					}

		        }
		        closedir($dh);
		    }
		}
	}
	

}