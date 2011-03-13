<?PHP


class Image {
	
	private $_newFile = null;
	private $_newBase = null;
	private $_newWidth = 'auto';
	private $_newHeight = 'auto';
	private $_newAlt = false;
	private $_newTitle = false;
	
	private $_newLink = false;
	private $_newTarget = '_self';
	
	private $_resultFile = null;
	
	public function setFile($file){
		$this->_newFile = $file;
	}
	public function setBase($base){
		$this->_newBase = $base;
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
	
	public function getImageTag(){
		
		$this->convert();
		
		$prefix = '';
		$sufix = '';
		
		if($this->_newLink !== false){
			$prefix = '<a href="'.$this->_newLink.'" target="'.$this->_newTarget.'" title="'.$this->_newTitle.'">';
			$sufix = '</a>';
		}
		
		return $prefix.'<img src="'.$this->_resultFile.'" alt="'.$this->_newAlt.'" title="'.$this->_newTitle.'" />'.$sufix;
	}
	
	private function convert(){
		$pfad = explode('/', $_SERVER['PHP_SELF']);
		array_pop($pfad);
		$pfad = implode('/', $pfad);
		
		$originalFilePath = 'files/originals/'.$this->_newBase.'/'.$this->_newFile.'.jpg';
		
		if(file_exists($originalFilePath)){
			
			$this->getSizeFromFile($originalFilePath);
			
			$newImagePath = 'files/cache/images_resized/'.$this->_newBase.'/'.$this->_newFile.'_'.$this->_newWidth.'x'.$this->_newHeight.'.jpg';
			
			
			if(!file_exists($newImagePath)){
				
				if($this->_newWidth == 'auto' && $this->_newHeight == 'auto'){
					
					$newImagePath = $originalFilePath;

				}else{
					$image = $this->createImageFromFile($originalFilePath);
					$new_image = $this->createImage($this->_newWidth, $this->_newHeight);

					$this->copyOriginalToNew($image, $new_image);

					if(!is_dir('files/cache/images_resized/'.$this->_newBase)){
						if(!mkdir('files/cache/images_resized/'.$this->_newBase, '0777')){
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
		
		//var_dump(array($this->_newWidth, $this->_newHeight));
	}
	private function copyOriginalToNew($original, $new){
		
		ImageCopyResized(
			$new, $original,
			0,0,0,0,
			$this->_newWidth, $this->_newHeight,
			$this->_oldWidth, $this->_oldHeight);
	}	
	private function createImage($width="", $height=""){
				
		$dest = imageCreateTrueColor($width, $height);
		
		// antialising funktion zum glätten verkleinerter grafiken
		// funktioniert aus unerfindlichen gründen nicht
		//imageantialias($dest, TRUE);
		
		return $dest;
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