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
	public function getServer($key=false, $default=false){
		if(isset($_SERVER[$key]) && !empty($_SERVER[$key])){
			return $_SERVER[$key];
		}
		if($key == false && $default == false){
			return $_SERVER;
		}
		return $default;
	}
	
	
	public function getSession($key=false, $default=false){
		if(isset($_SESSION[$key]) && !empty($_SESSION[$key])){
			return $_SESSION[$key];
		}
		if($key == false && $default == false){
			return $_SESSION;
		}
		return $default;
	}

	public function SetSession($name, $value){
		if($_SESSION[$name] = $value){
			return true;
		}
		return false;
	}
	
	
	
	
	public function getGet($key=false, $default=false){
		if(isset($_GET[$key]) && !empty($_GET[$key])){
			return $_GET[$key];
		}
		if($key == false && $default == false){
			return $_GET;
		}
		return $default;
	}
	public function getPost($key=false, $default=false){
		if(isset($_POST[$key]) && !empty($_POST[$key])){
			return $_POST[$key];
		}
		if($key == false && $default == false){
			return $_POST;
		}
		return $default;
	}
	
}