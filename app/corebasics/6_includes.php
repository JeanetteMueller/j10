<?PHP

require_once('app/corebasics/5_graphic.php');
require_once('app/includes.php');

class core_includes extends core_graphic {
	
	private $pathFor_includes = 'app/includes/';
	public $includes = array();
	
	public function __construct(){
		parent::__construct();
		$this->log("Load Extension: Includes");
		
		$this->loadIncludeClasses();
	}
	public function loadIncludeClasses(){
		
		$dir = $this->pathFor_includes;
		
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {
		        while (($file = readdir($dh)) !== false) {
					
					if(substr($file, -4) == '.php' && substr($file, 0,2) !== '._'){
						
						$className = str_replace('.php', '', $file);
						
						$this->includes[ucfirst(strtolower($className))] = $this->loadIncludeClass($className);
						
					}
		        }
		        closedir($dh);
		    }
		}	
	}
	public function loadIncludeClass($className){
		$className = strtolower($className);
		
		if(file_exists($this->pathFor_includes . $className.'.php')){
			require_once($this->pathFor_includes . $className.'.php');

			$className = ucfirst($className);
			
			$class = new $className($this, $className);
			$this->subLog("Load Includes: ".$className);

			return $class;
		}
		echo $this->pathFor_includes . $className.'.php - not found<br />';
		return false;
	}
}