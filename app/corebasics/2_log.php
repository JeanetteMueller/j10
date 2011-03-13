<?PHP

require_once('app/corebasics/1_base.php');

class core_log extends core_base {
	
	private $logList = array();
	
	public function __construct(){
		parent::__construct();
		$this->log("Load Extension: Log");
	}
	public function log($string){
		$this->logList[] = array('message'=>$string, 'sublog'=>array());
		
	}
	public function subLog($string){
		if(count($this->logList) >0){
			$itemNumber = count($this->logList)-1;

			$this->logList[$itemNumber]['sublog'][] = $string;
		}else{
			$this->log($string);
		}
	}
	public function getLog(){
		return $this->logList;
	}
	public function printLog(){
		
		echo '<hr /><h2>Logs</h2><ul>';
		foreach($this->logList as $item){
			echo '<li>'.$item['message'];
			
			if(count($item['sublog']) > 0){
				echo '<ul>';
				foreach($item['sublog'] as $subitem){
					echo '<li>'.$subitem.'</li>';
				}
				echo '</ul>';
			}
			echo '</li>';
		}
		echo '</ul><hr />';
	}
	
}