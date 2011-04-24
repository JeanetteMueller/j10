<div id="modul__<@ $modul->path @>_<@ $modul->id @>" class="modul <@ if $modul->object->autoRefresh() @> refresh<@ /if @> is_<@ $modul->path @>">
	
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
	<div class="outerContent"><div class="content"><@ $content @></div></div>
	<@ /if @>
	
	
	<@ assign var=footer value=$modul->object->loadFooter() @>
	<@ if $footer !== false @>
	<div class="footer"><@ $footer @></div>
	<@ /if @>
	
	
	<@ if $modul->object->reorder @>
		
		<div class="admin">
			<fieldset>
				<legend>Optionen</legend>
			<ul>
				<li><a href="javascript:;" class="is_removeModule">Dieses Modul entfernen</a></li>
			</ul>
			
			<@ if $modul->object->optionTitles|@count > 0 @>
				
				<table cellspacing="0" cellpadding="0" border="0" class="admin_optionstable">
					<@ foreach from=$modul->object->params item=value key=key @>
						<tr>
							<td><@ $modul->object->optionTitles[$key] @></td>
							<td><select id="modul__<@ $modul->path @>_<@ $modul->id @>_option__<@ $key @>" class="is_updateModulParams">
								<@ foreach from=$modul->object->options[$key] item=option key=optionKey @>
									<option value="<@ $optionKey @>" <@ if $optionKey == $value @>selected="selected"<@ /if @>><@ $option @></option>
								<@ /foreach @>
								</select>
							</td>
						</tr>
					<@ /foreach @>

				</table>
				
			<@ /if @>
			</fieldset>
		</div>
	<@ /if @>
</div>