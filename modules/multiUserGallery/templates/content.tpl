<@*<h2>Rubriken dieser Bilder</h2>
<div>
<@ foreach from=$taxonomie item=tax key=key @>
	<a href="#<@ if $images @>gallery_id=<@ $images[0]->gallery_id @>&<@ /if @>taxonomie_id=<@ $tax->id @>"><@ $tax->title @></a>, 
<@ /foreach @>	
</div>
*@>

<@ if $galleries @>

<div class="grid">
	<@ include file="content.galleries.tpl" @>
</div>
<@ else @>

<@* ---------------- *@>



<@ if $images @>
<div class="intro">
	<h2><@ $gallery->title|@utf8_encode @></h2>
	<p><@ $gallery->description|@utf8_encode @></p>
	<p class="autor">Autor: <a href="#user_id=<@ $gallery->user_id @>" class="is_gallery_showUser" id="is_gallery_showUser__<@ $gallery->user_id @>"><@ $gallery->username @></a></p>
</div>
<div class="grid">
<@ foreach from=$images item=image key=key @>
	<div class="griditem">
		<a href="#gallery_id=<@ $image->gallery_id @>&image_id=<@ $image->id @>" class="is_gallery_showImage" id="is_gallery_showImage__<@ $image->id @>">
		<@ $image->title @></a>
		<br />
		<a href="#gallery_id=<@ $image->gallery_id @>&image_id=<@ $image->id @>" class="is_gallery_showImage without_u" id="is_gallery_showImage__<@ $image->id @>">
		<@ image file=$image->id base="multiUserGallery" link=false width=140 height=140 alt=$image->title @>
		</a>
	</div>
<@ /foreach @>
</div>
<@ else @>
	Keine Bilder vorhanden
<@ /if @>


<@ /if @>

