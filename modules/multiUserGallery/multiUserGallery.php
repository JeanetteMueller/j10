<?php

class Module_MultiUserGallery extends Module{
	
	public function ajax_showGallery(){
		
		$parameter  = $this->core->get('params');
		
		$gallery_id = $parameter['gallery_id'];
		
		$Template = $this->getMyTemplate();
		
		$Template->Assign('taxonomie', $this->getGalleryTaxonomie($gallery_id));
		$Template->Assign('images', $this->getGallerieImages($gallery_id));
		$Template->Assign('gallery', $this->getGallerie($gallery_id));
		
		
		return array(
			'header'	=> $Template->fetch('showGallerie.head.tpl'),
			'content'	=> $Template->fetch('content.tpl'),
			'footer'	=> $Template->fetch('showGallerie.footer.tpl')
			
		);
	}
	public function overlay_showAddGallery(){

		$Template = $this->getMyTemplate();
		
		return array(
			'head'		=> $Template->fetch('addGallery.head.tpl'),
			'content'	=> $Template->fetch('addGallery.content.tpl'),
			'footer'	=> $Template->fetch('addGallery.footer.tpl')
		);
	}
	public function overlay_showAddImage(){
		$Template = $this->getMyTemplate();
		
		return array(
			'head'		=> $Template->fetch('addImage.head.tpl'),
			'content'	=> $Template->fetch('addImage.content.tpl'),
			'footer'	=> $Template->fetch('addImage.footer.tpl')
		);
	}
	public function overlay_showImage(){

		$Template = $this->getMyTemplate();
		
		$params = $this->core->Get('params');
		
		$gallery_id = $params['gallery_id'];
		$image_id = $params['image_id'];
		
		$images = $this->getGallerieImages($gallery_id, $image_id);
		if(count($images) > 0){
			$image = reset($images);
			$Template->Assign('image', $image);
		}
		
		
		$db = $this->core->getDatabase();

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
		$db->orderBy('edited DESC');
		$db->limit('0,1');
		
		$lastImages = $db->find('jx_module_multiUserGallery_images');

		if(count($lastImages) > 0){
			$lastImage = reset($lastImages);
			$Template->Assign('last_id', $lastImage->id);
		}
		
		return array(
			'head'		=> $Template->fetch('showImage.head.tpl'),
			'content'	=> $Template->fetch('showImage.content.tpl'),
			'footer'	=> $Template->fetch('showImage.footer.tpl')
		);
	}	
	public function getContent(){
		
		$this->Assign('galleries', $this->getLatestGalleries());
		
		$this->Assign('taxonomie', $this->getGalleryTaxonomie());
	}
	private function getGalleryTaxonomie($gallery_id = 0){
		$db = $this->core->getDatabase();
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
		$db = $this->core->getDatabase();
		$db->whereAdd('id', $gallery_id);
		$galleries = $db->find('jx_module_multiUserGallery_galleries');
		
		if(count($galleries) > 0){
			return reset($galleries);
		}
		return false;
	}
	private function getGallerieImages($gallery_id, $image_id = false){
		$db = $this->core->getDatabase();
		$db->whereAdd('gallery_id', $gallery_id);
		
		if($image_id !== false && is_numeric($image_id)){
			$db->whereAdd('id', $image_id);
		}
		
		$db->orderBy('edited DESC');
		return $db->find('jx_module_multiUserGallery_images');
	}
	
	private function getLatestGalleries($taxonomie = 0){
		
		$db = $this->core->getDatabase();
		$db->whereAdd('titleimage > 0');
		$db->orderBy('edited DESC');
		$result = $db->find('jx_module_multiUserGallery_galleries');
		//echo $db->last_query;
		return $result;
	}
}