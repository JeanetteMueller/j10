<@ if $editGallery @>
	Die Gallerie wurde erfolgreich verändert
	<script type="text/javascript">
		//infofenster ausblenden nach x time
		setTimeout(function(){
			jx.overlay.hide();
		}, 2000);
		
	</script>
	
<@ else @>
<form method="post" action="editGallery" >
	<fieldset>
			
		<div>
			<label for="module_multiusergallery_title">Titel:</label>
			<input type="text" name="module_multiusergallery_title" value="<@ $gallery->title @>" />
		</div>
		<div>
			<label for="module_multiusergallery_description">Beschreibung:</label>
			<textarea name="module_multiusergallery_description"><@ $gallery->description @></textarea>
		</div>
		
		<div>
			<input type="hidden" name="module_multiusergallery_action" value="editGallery" />
			<input type="hidden" name="module_multiusergallery_id" value="<@ $gallery->id @>" />
			<input type="submit" name="module_multiusergallery_submit" value="Änderung Speichern" class="is_submit" />
		</div>
	</fieldset>
</form>
<@ /if @>