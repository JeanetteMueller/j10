<@ if $addImage @>
	Bild wurde erfolgreich angelegt
	
	<script type="text/javascript">
		//infofenster ausblenden nach x time
		setTimeout(function(){
			jx.overlay.hide();
		}, 2000);
		
	</script>
<@ else @>

<@* if $error|@count > 0 *@>
<div class="error">
	<ul>
		<@ foreach from=$error item=message @>
			<li><@ $message @></li>
		<@ /foreach @>
	</ul>
</div>
<@* /if *@>
<form method="post" action="addImage" enctype="multipart/form-data" >
	<fieldset>
		<@*
		<div>
			<label for="module_multiusergallery_file">Bilddatei:</label>
			<input type="file" name="module_multiusergallery_file" />
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
			
		</div>
		*@>
		<div id="file-uploader">       
		    <noscript>          
		        <p>Please enable JavaScript to use file uploader.</p>
		        <!-- or put a simple form for upload here -->
		    </noscript>         
		</div>
		
		<script type="text/javascript">
		
		var uploader = new qq.FileUploader({
		    // pass the dom node (ex. $(selector)[0] for jQuery users)
		    element: document.getElementById('file-uploader'),
		    // path to server-side upload script
		    action: '<@ $ROOT @>/ajax/multiUserGallery/AddImage',
			params: {
			        gallery_id: <@ $gallery_id @>
			    },
			
			// validation    
			// ex. ['jpg', 'jpeg', 'png', 'gif'] or []
			allowedExtensions: ['jpg', 'jpeg'],        
			// each file size limit in bytes
			// this option isn't supported in all browsers
			//sizeLimit: 0, // max size   
			minSizeLimit: 10, // min size

			// set to true to output server response to console
			debug: false,

			// events         
			// you can return false to abort submit
			onSubmit: function(id, fileName){},
			onProgress: function(id, fileName, loaded, total){},
			onComplete: function(id, fileName, responseJSON){},
			onCancel: function(id, fileName){},

			showMessage: function(message){ alert(message); },
			
			template: '<div class="qq-uploader">' + 
	                '<div class="qq-upload-drop-area"><span>Ziehe Dateien hier her um sie hochzuladen</span></div>'+
					'<div>oder</div>' +
	                '<div class="qq-upload-button">Klicke hier um Bilder hinzuzufügen (Mehrfachauswahl möglich)</div>' +
					'<div>Bisher geladene Bilder:</div>' +
	                '<ul class="qq-upload-list"></ul>' + 
	             '</div>',
		});
	

		
		</script>
		<@*
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
			<input type="submit" name="module_multiusergallery_submit" value="Bild hochladen" class="is_submit" />
		</div>
		*@>
	</fieldset>
</form>
<@ /if @>