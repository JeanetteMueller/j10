<@ if $editImage @>
	Bild wurde erfolgreich geändert
	
	<script type="text/javascript">
		//infofenster ausblenden nach x time
		setTimeout(function(){
			jx.overlay.hide();
		}, 2000);
		
	</script>
<@ else @>

<form method="post" action="editImage" >
	<fieldset>
		
		<div>
			<label for="module_multiusergallery_title">Titel:</label>
			<input type="text" name="module_multiusergallery_title" value="<@ $image->titel @>" />
		</div>
		<div>
			<label for="module_multiusergallery_description">Beschreibung:</label>
			<textarea name="module_multiusergallery_description"><@ $image->description @></textarea>
		</div>
		
		<div>
			<input type="hidden" name="module_multiusergallery_action" value="addImage" />
			<input type="hidden" name="module_multiusergallery_image_id" value="<@ $image->id @>" />
			<input type="submit" name="module_multiusergallery_submit" value="Speichern" class="is_submit" />
		</div>
		
	</fieldset>
</form>
<@ /if @>