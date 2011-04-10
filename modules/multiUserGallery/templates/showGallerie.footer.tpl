<ul>
	<@ if $right_editGallery @>
		<li><a href="#gallery_id=<@ $gallery->id @>&editGallery=1" id="editGallery__<@ $gallery->id @>" class="is_gallery_editGalleryButton">Galerie bearbeiten</a></li>
	<@ /if @>
	<@ if $right_addImage @>
		<li><a href="#gallery_id=<@ $gallery->id @>&addImage=1" id="addImage__<@ $gallery->id @>" class="is_gallery_addImageButton">Neue Bilder hinzufügen</a></li>
	<@ /if @>
</ul>

