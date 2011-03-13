<?PHP

require_once('app/corebasics/2_log.php');

class core_parameter extends core_log {
	
	public function __construct(){
		parent::__construct();
		$this->log("Load Extension: Parameter");
	}
	
	public function get($key, $default=false){
		if($this->getGet($key, $default) !== false){
			return $this->getGet($key, $default);
		}
		
		if($this->getPost($key, $default) !== false){
			return $this->getPost($key, $default);
		}
		
		if($this->getSession($key, $default) !== false){
			return $this->getSession($key, $default);
		}
		
		if($this->getServer($key, $default) !== false){
			return $this->getSession($key, $default);
		}
		
		if($this->getFiles($key, $default) !== false){
			return $this->getSession($key, $default);
		}
		
		return false;
	}
	public function getFiles($key, $default=false){
		if(isset($_FILES[$key]) && !empty($_FILES[$key])){
			return $_FILES[$key];
		}
		return $default;
	}
	public function getServer($key, $default=false){
		if(isset($_SERVER[$key]) && !empty($_SERVER[$key])){
			return $_SERVER[$key];
		}
		return $default;
	}
	public function getSession($key, $default=false){
		if(isset($_SESSION[$key]) && !empty($_SESSION[$key])){
			return $_SESSION[$key];
		}
		return $default;
	}
	public function getGet($key, $default=false){
		if(isset($_GET[$key]) && !empty($_GET[$key])){
			return $_GET[$key];
		}
		return $default;
	}
	public function getPost($key, $default=false){
		if(isset($_POST[$key]) && !empty($_POST[$key])){
			return $_POST[$key];
		}
		return $default;
	}
	
}