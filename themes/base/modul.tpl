<div id="modul__<@ $modul->path @>_<@ $modul->id @>" class="modul<@ if $modul->object->autoRefresh() @> refresh<@ /if @> is_<@ $modul->path @>">
	
	<script type="text/javascript">
		modul__<@ $modul->path @>_<@ $modul->id @>_params = <@ $modul->object->params|@json_encode @>; 
	</script>
	
	<@ assign var=header value=$modul->object->loadHeader() @>
	<@ if $header !== false @>
	<div class="outerHeader"><div class="header"><@ $header @></div></div>
	<@ /if @>
	
	
	<@ assign var=content value=$modul->object->loadContent() @>
	<@ if $content !== false @>
	<div class="content"><@ $content @></div>
	<@ /if @>
	
	
	<@ assign var=footer value=$modul->object->loadFooter() @>
	<@ if $footer !== false @>
	<div class="footer"><@ $footer @></div>
	<@ /if @>
	
	
	<@ if $modul->object->reorder @>
		<a href="javascript:;" class="is_removeModule">&uarr; Modul entfernen</a>
	<@ /if @>
</div>