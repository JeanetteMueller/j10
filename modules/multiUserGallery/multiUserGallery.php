<?php

class Module_MultiUserGallery extends Module{
	
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
			}
			
			

			
		
			return array(
				'header'	=> $Template->fetch('showGallerie.head.tpl'),
				'content'	=> $Template->fetch('content.tpl'),
				'footer'	=> $Template->fetch('showGallerie.footer.tpl')
			
			);
		}
		return false;
	}
	public function ajax_showGalleryByUser(){
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'showGallery')){
			
			$parameter  = $this->getPost('params');
			
			$Template = $this->getMyTemplate();
			if(isset($parameter['user_id'])){
				
				$user_id = $parameter['user_id'];
				
				
				$galleries = $this->getLatestGalleries(false, $user_id);
				$Template->Assign('galleries', $galleries);
				$Template->Assign('username', $galleries[0]->username);
			}
			return array(
				'header'	=> $Template->fetch('showUser.head.tpl'),
				'content'	=> $Template->fetch('content.tpl'),
				'footer'	=> $Template->fetch('footer.tpl')
			
			);
		}
		return false;
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
	public function overlay_showAddImage(){
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'addImage')){
			$Template = $this->getMyTemplate();
		
			return array(
				'head'		=> $Template->fetch('addImage.head.tpl'),
				'content'	=> $Template->fetch('addImage.content.tpl'),
				'footer'	=> $Template->fetch('addImage.footer.tpl')
			);
		}
		return false;
	}
	public function overlay_showImage(){
		
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'showImage')){
			
			$Template = $this->getMyTemplate();
		
			$params = $this->getget('params');
		
			$gallery_id = $params['gallery_id'];
			$image_id = $params['image_id'];
		
			$images = $this->getGallerieImages($gallery_id, $image_id);
			if(count($images) > 0){
				$image = reset($images);
				$Template->Assign('image', $image);
			
				$db = $this->getDatabase();

				$db->whereAdd('gallery_id', $gallery_id);
				$db->whereAdd('edited < "'.$image->edited.'"');
				$db->orderBy('edited DESC');
				$db->limit('0,1');

				$nextImages = $db->find('jx_module_multiUserGallery_images');

				if(count($nextImages) > 0){
					$nextImage = reset($nextImages);
					$Template->Assign('next_id', $nextImage->id);
				}
				/*********/

				$db->whereAdd('gallery_id', $gallery_id);
				$db->whereAdd('edited > "'.$image->edited.'"');
				$db->orderBy('edited ASC');
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
		
		// echo $this->id.' - ';
		// echo $this->name;
		
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'showGallery')){
			
			if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'addGallery')){
				$this->Assign('right_addGallery', true);
			}
			
			$this->Assign('galleries', $this->getLatestGalleries(9));
		
			$this->Assign('taxonomie', $this->getGalleryTaxonomie());
		}
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
		$db->orderBy('edited DESC');
		return $db->find('jx_module_multiUserGallery_images');
	}
	
	private function getLatestGalleries($limit, $user_id=false, $taxonomie = 0){
		$db = $this->getDatabase();
		$db->selectAdd('jx_module_multiUserGallery_galleries.*');
		$db->selectAdd('jx_users.username');
		
		if($this->getRights()->hasRightFor($this->getSession('user_id'), $this->id, 'addGallery')){
			
		}else{
			$db->whereAdd('titleimage > 0');
			if($limit !== false){
				$db->limit('0,'.$limit);
			}
		}
		
		if($user_id !== false){
			$db->whereAdd('jx_users.id', $user_id);
		}
		
		$db->orderBy('jx_module_multiUserGallery_galleries.edited DESC');
		$db->joinAdd('jx_users', 'jx_users.id = jx_module_multiUserGallery_galleries.user_id');
		
		$result = $db->find('jx_module_multiUserGallery_galleries');
		//echo $db->last_query;
		return $result;
	}
}