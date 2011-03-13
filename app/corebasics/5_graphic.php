<?PHP

require_once('app/corebasics/4_filesystem.php');

class core_graphic extends core_filesystem{
	
	public function __construct(){
		parent::__construct();
		$this->log('Load Extension: Graphic');
	}
	
	public function getWidth($file){
		$info = getimagesize($file);
		return $info[0];
	}
	public function getHeight($file){
		$info = getimagesize($file);
		return $info[1];
	}
	public function cropImageToNewImage($image, $x, $y, $width, $height){
		
		$newImage = $this->createImage($width, $height);
		
		ImageCopyResized(
			$newImage, $image,
			$x,$y,$width,$height,
			$width, $height,
			$width, $height);
		
		return $newImage;
	}
	public function getAvailableImageMimeTypes(){
		return array(
			'image/jpeg',
			'image/png',
			'image/gif',
			'image/wbmp'
		);
	}
	private function createImageFromFile($file, $fileformat='jpg'){
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
		return false;
	}
	private function createImage($width=100, $height=100){
		
		$dest = imageCreateTrueColor($width, $height);
		
		// antialising funktion zum glätten verkleinerter grafiken
		// funktioniert aus unerfindlichen gründen nicht
		//imageantialias($dest, TRUE);
		
		return $dest;
	}
	private function saveImageToFile($image, $filepath, $fileformat='jpg'){
		
		switch ($fileformat)
		{
			case "jpg":
			case "jpeg":
				ImageJPEG($image, $filepath); 
			break;
			case "png":
				ImagePNG($image, $filepath); 
			break;
		}
	}
}
