<?PHP


class Image {
	
	private $_newFile = null;
	private $_newBase = null;
	private $_newWidth = 'auto';
	private $_newHeight = 'auto';
	private $_oldWidth = false;
	private $_oldHeight = false;
	private $_newAlt = false;
	private $_newTitle = false;
	
	private $_newLink = false;
	private $_newTarget = '_self';
	
	private $_newFill = true;
	private $_newFillColor = '#fff';
	
	private $_resultFile = null;
	
	public function setFile($file){
		$this->_newFile = $file;
	}
	public function setBase($base){
		$this->_newBase = $base;
		
		if(!is_dir('files/originals/'.$this->_newBase)){
			mkdir('files/originals/'.$this->_newBase, 0755, true);
		}
	}
	public function setWidth($width){
		$this->_newWidth = $width;
	}
	public function setHeight($height){
		$this->_newHeight = $height;
	}
	public function setAlt($alt){
		$this->_newAlt = $alt;
	}
	public function setTitle($title){
		$this->_newTitle = $title;
	}
	public function setLink($link){
		$this->_newLink = $link;
	}
	public function setTarget($target){
		$this->_newTarget = $target;
	}
	public function setFill($fill){
		$this->_newFill = $fill;
	}
	public function setFillColor($color){
		$this->_newFillColor = $color;
	}
	
	public function getImageTag(){
		
		$this->convert();
		
		$prefix = '';
		$sufix = '';
		
		if($this->_newLink !== false){
			$prefix = '<a href="'.$this->_newLink.'" target="'.$this->_newTarget.'" title="'.$this->_newTitle.'">';
			$sufix = '</a>';
		}
		
		return $prefix.'<img src="'.$this->_resultFile.'?rand='.rand(100,999).'" alt="'.$this->_newAlt.'" title="'.$this->_newTitle.'" border="0" />'.$sufix;
	}
	
	private function convert(){
		$pfad = explode('/', $_SERVER['PHP_SELF']);
		array_pop($pfad);
		$pfad = implode('/', $pfad);
		
		$originalFilePath = 'files/originals/'.$this->_newBase.'/'.$this->_newFile.'.jpg';
		
		if(file_exists($originalFilePath)){
			
			$this->getSizeFromFile($originalFilePath);
			
			$fill = 'nofill';
			if($this->_newFill){
				$fill = 'fill';
			}
			
			$newImagePath = 'files/cache/images_resized/'.$this->_newBase.'/'.$this->_newFile.'_'.$this->_newWidth.'x'.$this->_newHeight.'_'.$fill.'.jpg';
			
			if(file_exists($newImagePath)){
				unlink($newImagePath);
			}
			
			if(!file_exists($newImagePath)){
				
				if($this->_newWidth == 'auto' && $this->_newHeight == 'auto'){
					
					$newImagePath = $originalFilePath;

				}else{
					$image = $this->createImageFromFile($originalFilePath);
					//var_dump(array($this->_newWidth, $this->_newHeight));
					$new_image = $this->createImage($this->_newWidth, $this->_newHeight);

					$this->copyOriginalToNew($image, $new_image);

					if(!is_dir('files/cache/images_resized/'.$this->_newBase)){
						if(!mkdir('files/cache/images_resized/'.$this->_newBase, 0755, true)){
							echo "Ordner nicht anlegbar";
							return false;
						}
					}

					$this->saveNewToFile($new_image, $newImagePath);
					//$this->pictureReset();

					ImageDestroy($image);
					ImageDestroy($new_image);
				}
				

				
				
			}
			$this->_resultFile = $pfad.'/'.$newImagePath;
			
			
			
		}else{
			echo 'Bild nicht gefunden';
			return false;
		}
		
	}
	private function saveNewToFile($image, $filepath, $fileformat='jpg'){
		
		switch ($fileformat)
		{
			
			case "png":
				ImagePNG($image, $filepath); 
			break;
			
			case "jpeg":
			case "jpg":
			default:
				ImageJPEG($image, $filepath); 
			break;
		}
	}
	private function getSizeFromFile($file){
		
		$info = getimagesize($file);
		$this->_oldWidth = $info[0];
		$this->_oldHeight = $info[1];
		
		if($this->_newHeight == 'auto' && $this->_newWidth !== 'auto'){
			$this->_newHeight = bcmul(bcdiv($this->_oldHeight,$this->_oldWidth,2),$this->_newWidth,0);
		}
		if($this->_newWidth == 'auto' && $this->_newHeight !== 'auto'){
			$this->_newWidth = bcmul(bcdiv($this->_oldWidth,$this->_oldHeight,2),$this->_newHeight,0);
		}
		
		if($this->_newHeight == 'auto' && $this->_newWidth == 'auto'){
			//original ausliefern
		}
		
		if($this->_newFill === false){
			//echo "fill = false";
			$dimensions = $this->getConvertedDimensions();
			
			$this->_newWidth = $dimensions['width'];
			$this->_newHeight = $dimensions['height'];
		}
		
		//var_dump(array($this->_newWidth, $this->_newHeight));
	}
	private function getConvertedDimensions(){
		$imgratio = ($this->_oldWidth / $this->_oldHeight);
		
		$distanceTop = 0;
		$distanceLeft = 0;
		if ($imgratio>1) {
			$new_width = $this->_newWidth;
			$new_height = ($this->_newWidth / $imgratio);
			$distanceTop = ($this->_newHeight - $new_height) / 2;
			//echo "quer";
			
		} elseif ($imgratio<1)  {
			$new_height = $this->_newHeight;
			$new_width = ($this->_newHeight * $imgratio);
			$distanceLeft = ($this->_newWidth - $new_width) / 2;
			//echo "hoch";
		}else{
			$new_width = $this->_newWidth;
			$new_height = $this->_newHeight;
			
			//echo "quad";
		}
		
		return array('width'=>$new_width, 'height'=>$new_height, 'top'=>$distanceTop, 'left'=>$distanceLeft);
	}
	private function copyOriginalToNew($original, $new){
		
		$dimensions = $this->getConvertedDimensions();
		
		ImageCopyResized(
			$new, $original,
			$dimensions['left'],$dimensions['top'],0,0,
			$dimensions['width'], $dimensions['height'],
			$this->_oldWidth, $this->_oldHeight);
	}	
	private function createImage($width="", $height=""){
				
		$dest = imageCreateTrueColor($width, $height);
		
		$color = $this->html2rgb($this->_newFillColor);
		
		$newcolor = imagecolorallocate(
		        $dest,
		        $color[0],
		        $color[1],
		        $color[2]
		    );
		
		imagefill( $dest, 0, 0, $newcolor );
		// antialising funktion zum glätten verkleinerter grafiken
		// funktioniert aus unerfindlichen gründen nicht
		//imageantialias($dest, TRUE);
		
		return $dest;
	}
	function html2rgb($color)
	{
	    if ($color[0] == '#'){
	        $color = substr($color, 1);
		}
		
	    if (strlen($color) == 6){
	        list($r, $g, $b) = array($color[0].$color[1],
	                                 $color[2].$color[3],
	                                 $color[4].$color[5]);
	    }elseif (strlen($color) == 3){
	        list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
	    }else{
	        return false;
		}
		
	    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

	    return array($r, $g, $b);
	}
	private function createImageFromFile($file, $fileformat='jpg'){
		//TODO: png, gif etc support einbauen
		switch (strtolower($fileformat))
		{
			case "jpg":
			case "jpeg":
				return ImageCreateFromJPEG($file); 
			break;
			case "png":
				return ImageCreateFromPNG($file); 
			break;
			case "wbmp":
			case "bmp":
				return imagecreatefromwbmp($file); 
			break;
			case "gif":
				return ImageCreateFromgif($file); 
			break;
		}

	}
}