<?PHP


class Date {
	
	private $_prefix = null;
	
	public function setPrefix($value){
		$this->_prefix = array(0=>$value);
		
		return $this;
	}
	public function resetPrefix(){
		$this->_prefix = null;
		return $this;
	}
	public function getDays($length = 0){
		
		$ausgabe = array();
		
		for($x = 1; $x <= 31; $x++)
		{
			$fill = '';
			if($length > 0){
				for($f= 0; $f < ($length-strlen($x)); $f++){
					$fill .= "0";
				}
			}
			$ausgabe[$x] = $fill.$x;
		}
		
		if($this->_prefix !== null){

			$ausgabe = array_merge($this->_prefix, $ausgabe);
		}
		
		return $ausgabe;
	}
	public function getMonth(){

		
		$ausgabe = array(
			1 =>'Januar', 
			2 =>'Februar',
			3 =>'März',
			4 =>'April',
			5 =>'Mai',
			6 =>'Juni',
			7 =>'Juli',
			8 =>'August',
			9 =>'September',
			10=>'Oktober',
			11=>'November',
			12=>'Dezember'
		);
		if($this->_prefix !== null){

			$ausgabe = array_merge($this->_prefix, $ausgabe);
		}
			

		return $ausgabe;
	}
	public function getYears($length = 0){
		$ausgabe = array();
		
		$start = date('Y')-120;
		$end = date('Y');
		
		for($x = $start; $x <= $end; $x++)
		{
			$fill = '';
			if($length > 0){
				for($f= 0; $f < ($length-strlen($x)); $f++){
					$fill .= "0";
				}
			}
			$ausgabe[$x] = $fill.$x;
		}
		
		if($this->_prefix !== null){

			$ausgabe = array_merge($this->_prefix, $ausgabe);
		}
		
		return $ausgabe;
	}
}