<div class="imagecontainer">
<@ image file=$image->id base="multiUserGallery" link=false width=580 height=600 fill=false alt=$image->title title=$image->title @>

<@*
<img src="<@ $FILES_DIR @>originals/multiUserGallery/<@ $image->id @>.jpg" 
	width="100%" 
	style="width:100%;" 
	alt="<@ $image->title @>"
/>
*@>
	
<@ if $last_id @><a href="#gallery_id=<@ $image->gallery_id @>&image_id=<@ $last_id @>" 
					class="is_gallery_showImage is_gallery_showImageLast" 
					id="is_gallery_showLastImage__<@ $last_id @>">vorheriges</a><@ /if @>
<@ if $next_id @><a href="#gallery_id=<@ $image->gallery_id @>&image_id=<@ $next_id @>" 
					class="is_gallery_showImage is_gallery_showImageNext" 
					id="is_gallery_showNextImage__<@ $next_id @>">next</a><@ /if @>
					
</div>