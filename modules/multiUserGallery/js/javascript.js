
jx.modules.multiUserGallery = {
	
	load : false,
	
	init : function(ref){
		var self = this;
		jx.parseParameter(this);
		
		ref.each(function(){
			$('.is_gallery_showGallery', this).unbind('click.showGallery').bind('click.showGallery', self.showGallery);
			$('.is_gallery_showImage', this).unbind('click.is_gallerie_showImage').bind('click.is_gallerie_showImage', self.showImage);
			
			$('.is_gallery_addGalleryButton', this).unbind('click.is_gallery_addGalleryButton').bind('click.is_gallery_addGalleryButton', self.showAddGalleryForm);
			$('.is_gallery_addImageButton', this).unbind('click.is_gallery_addImageButton').bind('click.is_gallery_addImageButton', self.showAddImageForm);
			
			$('.is_homeButton', this).unbind('click.is_homeButton').bind('click.is_homeButton', self.showGalleryHome);
			
			$('.is_gallery_imageLast', this).unbind('click.is_gallery_imageLast').bind('click.is_gallery_imageLast', self.showImageLast);
			$('.is_gallery_imageNext', this).unbind('click.is_gallery_imageNext').bind('click.is_gallery_imageNext', self.showImageNext);
		});
		
		
		if( ! this.load ){

			if(this.config.gallery_id > 0){
				this.loadGallery(this.config.gallery_id, ref);
			}
			
			if(this.config.image_id > 0){
				this.showImage();
			}
			
			this.load = true;
		}
		
	},
	showImage : function(){
		var image_id = false;
		var gallery_id = jx.modules.multiUserGallery.config.gallery_id;
		
		if(!jx.modules.multiUserGallery.load){
			image_id = jx.modules.multiUserGallery.config.image_id;
		}else{
			image_id = $(this).attr('id').split('__').pop();
		}
		
		jx.overlay.init('multiUserGallery/showImage?params[gallery_id]='+gallery_id+'&params[image_id]='+image_id);
	},

	showGalleryHome : function(){
		var self = $(this);
		var root = self.parentsUntil('.modul');
		
		root.children('div.content').html(''+jx.loading);
		
		jQuery.ajax({ 	
			url: 		jx.root+"module/multiUserGallery",
		 	dataType: 	'json',
			type: 		"POST",
			context: 	document.body, 
			success: 	function(json){
				
				if(json != false ){
				
					$('div.content', root).html(json.content);
					$('div.header', root).html(json.header);
					$('div.footer', root).html(json.footer);
					
					jx.modules.multiUserGallery.init(root);
				}
			}
		});
	},
	showGallery : function(){
		var gallery_id = $(this).attr('id').split('__').pop();
		
		var self = $(this);
		
		var target = self.parentsUntil('.modul');
		
		jx.modules.multiUserGallery.loadGallery(gallery_id, target);
	}, 
	loadGallery : function(gallery_id, target){
		
		
		target.children('div.content').html(''+jx.loading);
			
		jQuery.ajax({ 	
			url: 		jx.root+"ajax/multiUserGallery/showGallery",
			data: 		{params: {gallery_id: gallery_id }}, 
		 	dataType: 	'json',
			type: 		"POST",
			context: 	document.body, 
			success: 	function(json){
				
				if(json != false ){

					$('div.content', target).html(json.content);
					$('div.header', target).html(json.header);
					$('div.footer', target).html(json.footer);
					
					jx.modules.multiUserGallery.init(target);
				}
			}
		});
		
	},
	showAddGalleryForm : function(){
		
		jx.overlay.init('multiUserGallery/showAddGallery');
	},
	showAddImageForm : function(){
		jx.overlay.init('multiUserGallery/showAddImage');
	}
}

jx.Listeners.addListener('is_multiUserGallery', function(ref){jx.modules.multiUserGallery.init(ref); }, 1);