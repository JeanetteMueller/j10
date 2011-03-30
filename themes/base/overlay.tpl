<@ if $overlay !== false @>

<div id="modul__<@ $modul->path @>_<@ $modul->id @>" title="<@ $modul->path @>" class="modul<@ if $modul->object->autoRefresh() @> refresh<@ /if @> is_<@ $modul->path @>">
	
	
	<@ assign var=header value=$overlay.head @>
	<@ if $header !== false @>
	<div class="outerHeader"><div class="header"><@ $header @></div></div>
	<@ /if @>
	
	<@ assign var=content value=$overlay.content @>
	<@ if $content !== false @>
	<div class="content"><@ $content @></div>
	<@ /if @>
	
	
	<@ assign var=footer value=$overlay.footer @>
	<@ if $footer !== false @>
	<div class="footer"><@ $footer @></div>
	<@ /if @>
	
	
</div>
<@ /if @>