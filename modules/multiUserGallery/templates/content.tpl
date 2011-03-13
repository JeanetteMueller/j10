<h2>Rubriken dieser Bilder</h2>
<div>
<@ foreach from=$taxonomie item=tax key=key @>
	<a href="#<@ if $images @>gallery_id=<@ $images[0]->gallery_id @>&<@ /if @>taxonomie_id=<@ $tax->id @>"><@ $tax->title @></a>, 
<@ /foreach @>	
</div>


<@ if $galleries @>
<h2>Neueste Galerien</h2>
<div class="grid">
<@ foreach from=$galleries item=gallerie key=key @>
	<div class="griditem">
		<a href="#gallery_id=<@ $gallerie->id @>" class="is_gallery_showGallery" id="is_gallery_showGallery__<@ $gallerie->id @>">
		<@ image file=$gallerie->titleimage base="multiUserGallery" link=false width=140 height=auto alt=$gallerie->title title=false @>
		
		<@ $gallerie->title @></a>
	</div>
<@ /foreach @>

<@ /if @>

<@* ---------------- *@>



<@ if $images @>
<h2>Bilder dieser Galerie</h2>
<div class="grid">
<@ foreach from=$images item=image key=key @>
	<div class="griditem">
		<a href="#gallery_id=<@ $image->gallery_id @>&image_id=<@ $image->id @>" class="is_gallery_showImage" id="is_gallery_showImage__<@ $image->id @>">
		<@ image file=$image->id base="multiUserGallery" link=false width=140 height=auto alt=$image->title @>
		
		<@ $image->title @></a>
	</div>
<@ /foreach @>

<@ /if @>

</div>
