<?PHP

class Converter extends Includes{
	
	public function __construct($core, $name){
		parent::__construct($core, $name);
	}
	
	/**
	 * Formt ein 2D-Array nach 1D um
	 * Array( array('ID', 'Value') )
	 * wird zu 
	 * Array('ID' => 'Value')
	 *
	 * @param unknown_type $array
	 */
	public function flattenArray_2d_to_1d($array){
		
		if(count($array[0]) == 2){
			$keys = array_keys($array[0]);
		
			foreach ($keys as $id => $value) {
				if(strtolower($value) == 'id'){
					$main = $value;
	
				}else{
					$wert = $value;
				}
			}
			
			$ausgabe = array();
			foreach ($array as $value) {
				$ausgabe[$value[$main]] = $value[$wert];
			}
			return $ausgabe;
		}else{
			return false;
		}
		
		
	}
	public function trim_array(array $array,$int){
		$newArray = array();
		for($i=0; $i<$int; $i++){
			array_push($newArray,$array[$i]);
		}
		return (array)$newArray;
	}
	/**
	 * Diese Funktion prüft ob ein Geldwert mit Kommastellen
	 * übergeben wurde und setzt den Ausgabewert immer auf #,##
	 * also mindestens ein zeichen vor und zwei nach dem Komma 
	 * Wenn $setCurrency true ist wird nach der Prüfung noch das aktuell 
	 * gewählte Währungssymbol angehängt.
	 * @param Int $value
	 * @param Bool $setCurrency
	 * @return Int
	 */
	public function showAsCurrency($value, $setCurrency=true, $currecySymbol="€"){
		
		if($value > 0)
		{
			//$value = round($value,2);

			//Wert an dem Punkt teilen und in maximal 2 Teile aussplitten
			$values = explode(".", $value, 2);
			
			//wenn es mehr als einen Teil gibt, war ein Punk vorhanden
			if(count($values)>1)
			{
				//pruefen ob die nachkommastellen kleiner als 2 stellen 
				//betragen und gegebenenfalls eine 0 anfuegen
				if(strlen($values[1])<2)
				{
					$values[1] = $values[1]."0";
				}
				//wenn nach anfuegen einer 0 immernoch weniger als 2 stellen
				//als nachkommastellen stehen, wird eine weiter 0 angefuegt
				if(strlen($values[1])<2)
				{
					$values[1] = $values[1]."0";
				}
			
				//gesammtkonstrukt zurueck geben
				$ausgabe = $values[0].",".substr($values[1],0,2); 
			}
			else
			{
				//wenn keine nachkommastellen vorhanden waren,
				//werden diese mit zweil 0en aufgefuellt
				$ausgabe = $values[0].",00";
			}
			
			if($setCurrency == true)
			{
				$ausgabe = $ausgabe." ".$currecySymbol;
			}
			
			return $ausgabe;
		}
		else
		{
			//return "-";
		}
	}
	/**
	 * Diese Funktion liefert ein Numerisches Array mit Zahlenwerten von $start bis $end
	 *
	 * @param INT $start
	 * @param INT $end
	 * @return Array
	 * @author Sebastian Müller
	 **/
	public function getNumberArray($start, $end, $length=false){
		$ausgabe = array();
		
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
		
		return $ausgabe;
	}
	/**
	 * Diese Funktion schneidet eine Zeichenreihe nach einer bestimmten Länge $stringcount ab
	 * Dabei wird das letzte Lehrzeichen innerhalb dieses Rahmens gesucht und dort abgeschnitten
	 * Damit werden keine Wörter mittendrin abgeschnitten
	 */
	public function cutStringbyCount($text, $stringcount, $additional=true, $deleteCuttedWord=true, $link=""){
		
		if($additional == "" or $additional == "true")
		{
			$additional = true;
		}
		if($deleteCuttedWord == "" or $deleteCuttedWord == "true")
		{
			$deleteCuttedWord = true;
		}
		
		$lengh = strlen($text);
		
		if(is_numeric($stringcount) && $stringcount > 0 && $lengh>$stringcount)
		{
			$text = substr($text, 0, $stringcount);
			
			if($deleteCuttedWord === true)
			{
				$worter = explode(" ", $text);
				array_pop($worter);
				$text = implode(" ", $worter);
			}
			
			if($additional === true)
			{
								
				if($link != "")
				{
					$text .= "<a href='".$link."' title='".Translation::Translate("read_more")."'>";
				}
				$text .= "<b>".Translation::Translate("read_more")."</b>";
				if($link != "")
				{
					$text .= "</a>";
				}
				
			}
			
		}
		return $text;
	}
	
	/*
	 * Diese Funktion generiert eine Zahlenreihe der Länge $length
	 *
	 */
	public function betterRand($length=5){
		
		for($x = 0; $x < $length; $x++)
		{
			srand((double)microtime() * 1000000);
			$ausgabe .= rand(0,9);
	
		}
		
		return $ausgabe;
	}
	
	/**
	 * Diese Function gibt den durchschnittswert aller werte aus einem array zur�ck
	 * Aufrufvariablen
	 * $array        = array mit Zahlen z.B.: $array("1", "3", "8", "22");
	 * $kommastellen = optional Anzahl der Stellen hinter dem Komma
	 *
	 * @param unknown_type $array
	 * @param unknown_type $kommastellen
	 * @return unknown
	 */
	function durchschnittswert($array, $kommastellen=2)
	{
		// Pr�ft ob die �bergebene Variable ein Array ist
		if(is_array($array))
		{
			$durchschnitsswert = array_sum($array);
			$durchschnitsswert = bcdiv($durchschnitsswert, count($array), $kommastellen);
			
			return $durchschnitsswert;
		}
		else
		{
			return false;
		}
	}
}