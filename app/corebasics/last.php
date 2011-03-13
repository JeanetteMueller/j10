<?PHP

require_once('app/corebasics/6_includes.php');

class core_last extends core_includes {
	
	public function __construct(){
		parent::__construct();
		$this->log("Extension loading finished");
	}
	
}