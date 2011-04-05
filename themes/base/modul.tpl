<div id="modul__<@ $modul->path @>_<@ $modul->id @>" class="modul<@ if $modul->object->autoRefresh() @> refresh<@ /if @> is_<@ $modul->path @>">
	
	<@ if $modul->object->params|@json_encode != "{}" @>
		<script type="text/javascript">
			modul__<@ $modul->path @>_<@ $modul->id @>_params = <@ $modul->object->params|@json_encode @>; 
		</script>
	<@ /if @>
	
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
		<div class="admin">
			<ul>
				<li><a href="javascript:;" class="is_removeModule">&uarr; Modul entfernen</a></li>
			</ul>
			<@ if $modul->object->params|@json_encode != "{}" @>
				<table width="100%" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<th>Key</th>
						<th>Value</th>
					</tr>
					<@ foreach from=$modul->object->params item=value key=key @>
						<tr>
							<td><@ $key @></td>
							<td><@ $value @></td>
						</tr>
					<@ /foreach @>
				</table>
			<@ /if @>
		</div>
	<@ /if @>
</div>