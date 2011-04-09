<@ if $addGallery @>
	Galerie wurde erfolgreich angelegt
	
	<script type="text/javascript">
		//infofenster ausblenden nach x time
		setTimeout(function(){
			jx.overlay.hide();
		}, 2000);
		
	</script>
<@ else @>
<form method="post" action="addGallery" >
	<fieldset>
			
		<div>
			<label for="module_multiusergallery_title">Titel:</label>
			<input type="text" name="module_multiusergallery_title" value="<@ $titel @>" />
		</div>
		<div>
			<label for="module_multiusergallery_description">Beschreibung:</label>
			<textarea name="module_multiusergallery_description"><@ $description @></textarea>
		</div>
		
		<div>
			<input type="hidden" name="module_multiusergallery_action" value="addGallery" />
			<input type="submit" name="module_multiusergallery_submit" value="Gallerie anlegen" class="is_submit" />
		</div>
	</fieldset>
</form>
<@ /if @>