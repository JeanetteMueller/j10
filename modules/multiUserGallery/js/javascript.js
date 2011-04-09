
jx.modules.multiUserGallery = {
	
	load : false,
	config : {
		gallery_id: 0,
		image_id: 0,
		user_id:0
	},
	
	init : function(ref){
		var self = this;
		jx.parseParameter(this);
		
		ref.each(function(){
			$('.is_gallery_showGallery', this).unbind('click.showGallery').bind('click.showGallery', self.showGallery);
			$('.is_gallery_showImage', this).unbind('click.is_gallerie_showImage').bind('click.is_gallerie_showImage', self.showImage);
			$('.is_gallery_showUser', this).unbind('click.showUser').bind('click.showUser', self.showUser);
			
			$('.is_gallery_addGalleryButton', this).unbind('click.is_gallery_addGalleryButton').bind('click.is_gallery_addGalleryButton', self.showAddGalleryForm);
			$('.is_gallery_addImageButton', this).unbind('click.is_gallery_addImageButton').bind('click.is_gallery_addImageButton', self.showAddImageForm);
			
			$('.is_homeButton', this).unbind('click.is_homeButton').bind('click.is_homeButton', self.showGalleryHome);
			
			// $('.is_gallery_imageLast', this).unbind('click.is_gallery_imageLast').bind('click.is_gallery_imageLast', self.showImageLast);
			// $('.is_gallery_imageNext', this).unbind('click.is_gallery_imageNext').bind('click.is_gallery_imageNext', self.showImageNext);
			
			$('#overlay_closeButton').unbind('click.overlay_closeButton_multiUserGallery').bind('click.overlay_closeButton_multiUserGallery', self.overlay_closeButton);
		});
		
		
		if( ! self.load ){

			if(self.config.gallery_id > 0){
				self.loadGallery({gallery_id: self.config.gallery_id}, ref);
			}
			
			if(self.config.image_id > 0){
				self.showImage();
			}
			
			if(self.config.user_id > 0){
				self.loadGalleryByUser({user_id: self.config.user_id}, ref);
			}
			
			self.load = true;
		}
		
	},
	overlay_closeButton : function(){
		jx.parseParameter(jx.modules.multiUserGallery);
		
		var self = jx.modules.multiUserGallery;
		if(self.config.addGallery == "1"){
			if(parseInt(self.config.user_id, 10) > 0){
				self.loadGalleryByUser({user_id: self.config.user_id}, $('.is_multiUserGallery:last'));
			}
		}
		
		
		var url = '#';
		forEach(jx.modules.multiUserGallery.config, function(object, key){
			if(key !== 'image_id' && key !== 'addGallery'){
				url += key+"="+object+"&";
			}
		});
		//remove the last "&"
		url = url.substr(0, url.length-1);
		document.location.href = url;
	},
	showUser : function (){
		var user_id = $(this).attr('id').split('__').pop();
		
		var self = $(this);
		
		var target = self.parentsUntil('.modul');
		
		jx.modules.multiUserGallery.loadGalleryByUser({user_id: user_id}, target);
	},
	showImage : function(){
		var image_id = false;
		var gallery_id = jx.modules.multiUserGallery.config.gallery_id;
		
		if(!jx.modules.multiUserGallery.load){
			image_id = jx.modules.multiUserGallery.config.image_id;
		}else{
			image_id = $(this).attr('id').split('__').pop();
		}
		
		jx.overlay.init('multiUserGallery/showImage', {gallery_id: gallery_id, image_id: image_id});
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
		
		jx.modules.multiUserGallery.loadGallery({gallery_id: gallery_id}, target);
	}, 
	loadGalleryViaAjax : function (type, params, target){
		target.children('div.content').html(''+jx.loading);
		
		jQuery.ajax({ 	
			url: 		jx.root+"ajax/multiUserGallery/"+type,
			data: 		{params: params}, 
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
	loadGalleryByUser : function (params, target){
		
		jx.modules.multiUserGallery.loadGalleryViaAjax('showGalleryByUser', params, target);
	},
	loadGallery : function(params, target){
		
		jx.modules.multiUserGallery.loadGalleryViaAjax('showGallery', params, target);
				
	},
	showAddGalleryForm : function(){
		
		jx.overlay.init('multiUserGallery/showAddGallery');
	},
	showAddImageForm : function(){
		var gallery_id = $(this).attr('id').split('__').pop();
		
		console.debug(gallery_id);
		jx.overlay.init('multiUserGallery/showAddImage', {gallery_id:gallery_id});
	}
}

jx.Listeners.addListener('is_multiUserGallery', function(ref){jx.modules.multiUserGallery.init(ref); }, 1);