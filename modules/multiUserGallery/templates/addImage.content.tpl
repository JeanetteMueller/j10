<@ if $addImage @>
	Bild wurde erfolgreich angelegt
	
	<script type="text/javascript">
		//infofenster ausblenden nach x time
		setTimeout(function(){
			jx.overlay.hide();
		}, 2000);
		
	</script>
<@ else @>
<form method="post" action="#gallery_id=<@ $gallery_id @>" enctype="multipart/form-data" >
	<fieldset>
		<div>
			<label for="module_multiusergallery_file">Bilddatei:</label>
			<input type="file" name="module_multiusergallery_file" />
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
			
		</div>
		<div>
			<label for="module_multiusergallery_title">Titel:</label>
			<input type="text" name="module_multiusergallery_title" value="<@ $titel @>" />
		</div>
		<div>
			<label for="module_multiusergallery_description">Beschreibung:</label>
			<textarea name="module_multiusergallery_description"><@ $description @></textarea>
		</div>
		
		<div>
			<input type="hidden" name="module_multiusergallery_action" value="addImage" />
			<input type="hidden" name="module_multiusergallery_gallery_id" value="<@ $gallery_id @>" />
			<input type="submit" name="module_multiusergallery_submit" value="Bild hochladen" class="" />
		</div>
	</fieldset>
</form>
<@ /if @>