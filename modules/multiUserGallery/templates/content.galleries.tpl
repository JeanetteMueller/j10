<@ foreach from=$galleries item=gallerie key=key @>
	<div class="griditem">
		<a href="#gallery_id=<@ $gallerie->id @>" class="is_gallery_showGallery" id="is_gallery_showGallery__<@ $gallerie->id @>">
		<@ $gallerie->title @></a>
		<br />
		<a href="#gallery_id=<@ $gallerie->id @>" class="is_gallery_showGallery without_u" id="is_gallery_showGallery__<@ $gallerie->id @>">
		<@ if $gallerie->titleimage @>
			<@ image file=$gallerie->titleimage base="multiUserGallery" link=false width=140 height=140 alt=$gallerie->title title=false @>
		<@ else @>
			<@ image file="dummy_empty" base="base" link=false width=140 height=140 alt=$gallerie->title title=false @>
		<@ /if @></a><br />
		
		<@ if $username != $gallerie->username @>
		von <a href="#user_id=<@ $gallerie->user_id @>" class="is_gallery_showUser" id="is_gallery_showUser__<@ $gallerie->user_id @>"><@ $gallerie->username @></a>
		<@ /if @>
	</div>
<@ /foreach @>