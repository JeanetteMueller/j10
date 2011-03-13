<div id="modul__<@ $modul->path @>_<@ $modul->id @>" title="<@ $modul->path @>" class="modul<@ if $modul->object->autoRefresh() @> refresh<@ /if @> is_<@ $modul->path @>">
	
	<@ assign var=header value=$modul->object->loadHeader() @>
	<@ if $header !== false @>
	<div class="header"><@ $header @></div>
	<@ /if @>
	
	
	<@ assign var=content value=$modul->object->loadContent() @>
	<@ if $content !== false @>
	<div class="content"><@ $content @></div>
	<@ /if @>
	
	
	<@ assign var=footer value=$modul->object->loadFooter() @>
	<@ if $footer !== false @>
	<div class="footer"><@ $footer @></div>
	<@ /if @>
	
</div>