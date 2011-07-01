<?php

class Module_MultiUserGallery extends Module{
	
	private $_latestGalleriesCount = 9;
	private $_latestGalleriesStart = null;
	private $_appendLoadCount = 3;
	
	public function setup($params){
		parent::setup($params);
		
		
		if(!isset($this->params['latestGalleriesCount'])){
			$this->params['latestGalleriesCount'] = $this->_latestGalleriesCount;
		}
		//if(!isset($this->params['latestGalleriesStart'])){
			$this->params['latestGalleriesStart'] = $this->params['latestGalleriesCount'];
		//}
		if(!isset($this->params['appendLoadCount'])){
			$this->params['appendLoadCount'] = $this->_appendLoadCount;
		}
		$this->params['latestGalleriesStart'] = $this->params['latestGalleriesCount'];
		//var_dump($this->params);
		
		
		$this->Assign('user_id', $this->getSession('user_id'));
		
		//$this->form_AddImage();
	}
	public function ajax_showGallery(){
		
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'showGallery')){
			
			$parameter  = $this->getPost('params');
			
			
			$Template = $this->getMyTemplate();
			
			if(isset($parameter['gallery_id'])){
				$gallery_id = $parameter['gallery_id'];

				$Template->Assign('taxonomie', $this->getGalleryTaxonomie($gallery_id));
				$Template->Assign('images', $this->getGallerieImages($gallery_id));
				
				$gallery = $this->getGallerie($gallery_id);
				$Template->Assign('gallery', $gallery);
				
				if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'addImage')){
					if($gallery->user_id == $this->getSession('user_id')){
						$Template->Assign('right_addImage', true);
					}
				}
				if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'editGallery')){
					if($gallery->user_id == $this->getSession('user_id')){
						$Template->Assign('right_editGallery', true);
					}
				}
			}
			
			
			$Template->Assign('user_id', $this->getSession('user_id'));
			
		
			return array(
				'header'	=> $Template->fetch('showGallerie.head.tpl'),
				'content'	=> $Template->fetch('content.tpl'),
				'footer'	=> $Template->fetch('showGallerie.footer.tpl')
			
			);
		}
		return false;
	}
	public function ajax_loadAdditionalGallerys(){
		
		$parameter  = $this->getPost('params');
		
		if(!isset($parameter['user_id'])){
			$parameter['user_id'] = false;
		}
		
		$Template = $this->getMyTemplate();
		$galleries = $this->getLatestGalleries($parameter['appendLoadCount'], $parameter['latestGalleriesStart'], $parameter['user_id']);
		
		if(count($galleries) > 0){
			$Template->Assign('galleries', $galleries);
			$templ = $Template->fetch('content.galleries.tpl');
		}else{
			$templ = false;
		}
		return array(
			'content'	=> $templ
		);
	}
	public function ajax_showGalleryByUser(){
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'showGallery')){
			
			$parameter  = $this->getPost('params');
			
			$Template = $this->getMyTemplate();
			if(isset($parameter['user_id'])){
				
				$user_id = $parameter['user_id'];
				
				//var_dump($this->params);
				
				$galleries = $this->getLatestGalleries($this->params['latestGalleriesCount'], 0, $user_id);
				$Template->Assign('galleries', $galleries);
				$Template->Assign('username', $galleries[0]->username);
				
				
				if($this->getSession('user_id') == $user_id && $this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'addGallery')){
					$Template->Assign('right_addGallery', true);
				}
			}
			
			$Template->Assign('user_id', $this->getSession('user_id'));
			
			return array(
				'header'	=> $Template->fetch('showUser.head.tpl'),
				'content'	=> $Template->fetch('content.tpl'),
				'footer'	=> $Template->fetch('footer.tpl')
			
			);
		}
		return false;
	}
	public function overlay_showEditGallery(){
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'editGallery')){
			
			$Template = $this->getMyTemplate();
			$parameter  = $this->getPost('params');
			
			$gallery = $this->getGallerie($parameter['gallery_id']);
			$Template->Assign('gallery', $gallery);
		
			return array(
				'head'		=> $Template->fetch('editGallery.head.tpl'),
				'content'	=> $Template->fetch('editGallery.content.tpl'),
				'footer'	=> $Template->fetch('addGallery.footer.tpl')
			);
			
		}
	}
	public function overlay_showAddGallery(){
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'addGallery')){
			$Template = $this->getMyTemplate();
		
			return array(
				'head'		=> $Template->fetch('addGallery.head.tpl'),
				'content'	=> $Template->fetch('addGallery.content.tpl'),
				'footer'	=> $Template->fetch('addGallery.footer.tpl')
			);
		}
		return false;
	}
	public function overlay_editGallery(){
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'editGallery')){
			$Template = $this->getMyTemplate();
			$Template->Assign('editGallery', false);
			$params = $this->getPost('params');
		
			if($params['module_multiusergallery_action'] == 'editGallery'){
				
				$gallery = $this->getGallerie($params['module_multiusergallery_id']);
				
				$gallery->setValue('title', $params['module_multiusergallery_title']);
				$gallery->setValue('description', $params['module_multiusergallery_description']);
				
				if($gallery->syncronize()){

					$Template->Assign('editGallery', true);
				}
			}

			
			
			return array(
				'head'		=> $Template->fetch('editGallery.head.tpl'),
				'content'	=> $Template->fetch('editGallery.content.tpl'),
				'footer'	=> $Template->fetch('editGallery.footer.tpl')
			);
		}
		return false;
	}
	public function overlay_addGallery(){
		
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'addGallery')){
			$Template = $this->getMyTemplate();
			$Template->Assign('addGallery', false);
			$params = $this->getPost('params');
		
			if($params['module_multiusergallery_action'] == 'addGallery'){
			
				$db = $this->getDatabase();
				
				$db->insertValue('created', 'NOW()');
				$db->insertValue('user_id', $this->getSession('user_id'));
				$db->insertValue('title', $params['module_multiusergallery_title']);
				$db->insertValue('description', $params['module_multiusergallery_description']);
			
				if($db->insert('jx_module_multiUserGallery_galleries')){

					$Template->Assign('addGallery', true);
				}
			}

			
			
			return array(
				'head'		=> $Template->fetch('addGallery.head.tpl'),
				'content'	=> $Template->fetch('addGallery.content.tpl'),
				'footer'	=> $Template->fetch('addGallery.footer.tpl')
			);
		}
		return false;
	}
	public function overlay_showAddImage(){
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'addImage')){
			$Template = $this->getMyTemplate();
			
			$params = $this->getPost('params');
			$Template->Assign('gallery_id', $params['gallery_id']);
		
			return array(
				'head'		=> $Template->fetch('addImage.head.tpl'),
				'content'	=> $Template->fetch('addImage.content.tpl'),
				'footer'	=> $Template->fetch('addImage.footer.tpl')
			);
		}
		return false;
	}
	public function overlay_addImage(){
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'addImage')){
			$Template = $this->getMyTemplate();
			$error = array(); 
			
			$params = $this->getPost('params');
			$Template->Assign('gallery_id', $params['module_multiusergallery_gallery_id']);
			
			if($_FILES['module_multiusergallery_file']['type'] == 'image/jpeg'){
				
			}else{
				$error[] = 'Bitte nur JPG Files hochladen';
			}
			
			$Template->Assign('error', $error); 
			return array(
				'head'		=> $Template->fetch('addImage.head.tpl'),
				'content'	=> $Template->fetch('addImage.content.tpl'),
				'footer'	=> $Template->fetch('addImage.footer.tpl')
			);
		}
		return false;
	}
	public function ajax_AddImage(){
		$result = array('success'=>false);
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'addImage')){
			require_once('modules/multiUserGallery/fileuploader.php');
		
			// list of valid extensions, ex. array("jpeg", "xml", "bmp")
			$allowedExtensions = array('jpg', 'jpeg');
			// max file size in bytes
			$sizeLimit = 10 * 1024 * 1024;

			$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
			if(!is_dir('files/tmp/')){
				mkdir('files/tmp/', 0755, true);
			}
			if(!is_dir('files/originals/multiUserGallery/')){
				mkdir('files/originals/multiUserGallery/', 0755, true);
			}
			$result = $uploader->handleUpload('files/tmp/', true);
			// to pass data through iframe you will need to encode all html tags
		
			$gallery_id = $this->getGet('gallery_id'); 
			$filename = $this->getGet('qqfile'); 
		
			$title = explode('.', $filename);
			$extension = array_pop($title);
			$title = str_replace('_', ' ', implode('.', $title));
		
			$db = $this->getDatabase();
	
			$db->insertValue('created', 'NOW()');
			$db->insertValue('user_id', $this->getSession('user_id'));
			$db->insertValue('gallery_id', $gallery_id);
			$db->insertValue('title', $title);
	
			if($db->insert('jx_module_multiUserGallery_images')){
			
			
				$db->whereAdd('user_id', $this->getSession('user_id'));
				$db->whereAdd('title', $title);
				$db->orderBy('id DESC');
				$db->limit('0,1');
				$results = $db->find('jx_module_multiUserGallery_images');
		
				$lastEntry = reset($results);
				$newID = $lastEntry->id;
			
			
				if(copy('files/tmp/'.$filename, 'files/originals/multiUserGallery/'.$newID.'.jpg')) {
					unlink('files/tmp/'.$filename);
				
					$gallery = $this->getGallerie($gallery_id);
			
					//if($gallery->titleimage == 0){
						$gallery->setValue('titleimage', $newID);
						$gallery->syncronize();
					//}
				
				}
				
				
			}
		}
		
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		die();
		
	}
	public function overlay_showImage(){
		
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'showImage')){
			
			$Template = $this->getMyTemplate();
		
			$params = $this->getPost('params');
		
			$gallery_id = $params['gallery_id'];
			$image_id = $params['image_id'];
		
			$images = $this->getGallerieImages($gallery_id, $image_id);
			if(count($images) > 0){
				$image = reset($images);
				$Template->Assign('image', $image);
			
				$db = $this->getDatabase();

				$db->whereAdd('gallery_id', $gallery_id);
				$db->whereAdd('id < "'.$image->id.'"');
				//$db->orderBy('edited DESC');
				$db->orderBy('id DESC');
				$db->limit('0,1');

				$nextImages = $db->find('jx_module_multiUserGallery_images');

				if(count($nextImages) > 0){
					$nextImage = reset($nextImages);
					$Template->Assign('next_id', $nextImage->id);
				}
				/*********/

				$db->whereAdd('gallery_id', $gallery_id);
				$db->whereAdd('id > "'.$image->id.'"');
				//$db->orderBy('edited ASC');
				$db->orderBy('id ASC');
				$db->limit('0,1');

				$lastImages = $db->find('jx_module_multiUserGallery_images');
				
				if(count($lastImages) > 0){
					$lastImage = reset($lastImages);
					$Template->Assign('last_id', $lastImage->id);
				}
			}
		
			return array(
				'head'		=> $Template->fetch('showImage.head.tpl'),
				'content'	=> $Template->fetch('showImage.content.tpl'),
				'footer'	=> $Template->fetch('showImage.footer.tpl')
			);
		}
		return false;
		
	}	
	public function getHeader(){
		return true;
	}
	public function getContent(){
		parent::getContent();
		// echo $this->id.' - ';
		// echo $this->name.' - ';
		// echo $this->modul_id.' - ';

		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'showGallery')){

			if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'addGallery')){
				$this->Assign('right_addGallery', true);
			}
			
			$this->Assign('galleries', $this->getLatestGalleries($this->params['latestGalleriesCount'], 0));
		
			$this->Assign('taxonomie', $this->getGalleryTaxonomie());
			
		}
		return true;
	}
	public function getFooter(){
		return true;
	}
	private function getGalleryTaxonomie($gallery_id = 0){
		$db = $this->getDatabase();
		if($gallery_id > 0){
			$db->whereAdd('gallery_id', $gallery_id);
		}
		//$db->selectAdd('jx_taxonomie.ID');
		$db->selectAdd('jx_taxonomie.*');
		$db->groupBy('taxonomie_id');
		
		$db->joinAdd('jx_taxonomie', 'jx_module_multiUserGallery_images.taxonomie_id = jx_taxonomie.id');
		
		$db->orderBy('jx_taxonomie.title');
		return $db->find('jx_module_multiUserGallery_images');
	}
	private function getGallerie($gallery_id){
		$db = $this->getDatabase();
		$db->selectAdd('jx_module_multiUserGallery_galleries.*');
		$db->selectAdd('jx_users.username');
		$db->whereAdd('jx_module_multiUserGallery_galleries.id', $gallery_id);
		$db->whereAdd('jx_users.deleted IS NULL');
		$db->joinAdd('jx_users', 'jx_users.id = jx_module_multiUserGallery_galleries.user_id');
		$galleries = $db->find('jx_module_multiUserGallery_galleries');
		
		if(count($galleries) > 0){
			return reset($galleries);
		}
		return false;
	}
	private function getGallerieImages($gallery_id, $image_id = false){
		$db = $this->getDatabase();
		$db->whereAdd('gallery_id', $gallery_id);
		
		if($image_id !== false && is_numeric($image_id)){
			$db->whereAdd('jx_module_multiUserGallery_images.id', $image_id);
		}
		$db->selectAdd('jx_module_multiUserGallery_images.*');
		$db->selectAdd('jx_users.username');
		$db->joinAdd('jx_users', 'jx_users.id = jx_module_multiUserGallery_images.user_id');
		//$db->orderBy('edited DESC');
		$db->orderBy('id DESC');
		return $db->find('jx_module_multiUserGallery_images');
	}
	private function getLatestGalleries($limit, $start, $user_id=false, $taxonomie = 0){
		$db = $this->getDatabase();
		$db->selectAdd('jx_module_multiUserGallery_galleries.*');
		$db->selectAdd('jx_users.username');
		
		if($user_id !== false && $user_id !== $this->getSession('user_id')){
			$db->whereAdd('user_id', $user_id);
			$db->whereAdd('titleimage', '0', '>');
		}elseif($user_id !== false &&  $user_id == $this->getSession('user_id') ){
			$db->whereAdd('user_id', $user_id);
			
		}else{
			$db->whereAdd('user_id', $this->getSession('user_id'));
			$db->whereAdd('titleimage', '0', '>', 'OR');
		}
		
		//$db->whereAdd('titleimage', '0', '>', 'OR');
		
		if($limit !== false){
			$db->limit($start.','.$limit);
		}
		$db->whereAdd('jx_users.deleted IS NULL');
		
		
		$db->orderBy('jx_module_multiUserGallery_galleries.edited DESC');
		$db->orderBy('jx_module_multiUserGallery_galleries.id DESC');
		$db->joinAdd('jx_users', 'jx_users.id = jx_module_multiUserGallery_galleries.user_id');
		
		$result = $db->find('jx_module_multiUserGallery_galleries');
		//echo $db->last_query;
		return $result;
	}
	
	
	public function getOptionKeys(){
		return array('latestGalleriesCount', 'appendLoadCount');
	}
	public function getTitleForOption($key){
		switch($key){
			case 'latestGalleriesCount':
				return 'Anzahl der Galerien';
			break;
		}
		return parent::getTitleForOption($key);
	}
	public function getOptionsFor($key){
		switch($key){
			case 'latestGalleriesCount':
			
				return $this->getConverter()->getNumberArray(1,25);
			break;
		}
		
		return parent::getOptionsFor($key);
	}
}