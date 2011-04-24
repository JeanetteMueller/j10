<div id="modul__<@ $modul->path @>_<@ $modul->slotmodul_id @>" class="modul <@ if $modul->object->autoRefresh() @> refresh<@ /if @> is_<@ $modul->path @>">
	
	<@ if $modul->object->params|@json_encode != "[]" @>
		<script type="text/javascript">
			modul__<@ $modul->path @>_<@ $modul->id @>_params = <@ $modul->object->params|@json_encode @>; 
		</script>
	<@ /if @>
	
	
	<@ assign var=header value=$modul->object->loadHeader() @>
	<@ if $header !== false @>
	<div class="outerHeader"><@* $modul->site_id *@><div class="header"><@ $header @>
		
	</div></div>
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
			
		<a href="javascript:;" class="admin_optionButtons is_removeModule">X</a>
	

		<a href="javascript:;" class="admin_optionButtons is_showAdminOptionsOnModul" title="Zeige Administrationsoptionen">#</a>
		<div class="admin hide">
			
			<table cellspacing="0" cellpadding="0" border="0" class="admin_optionstable">
				<tr>
					<td>Sichtbar an dieser Position auf allen Seiten </td>
					<td><input type="checkbox" id="modul__<@ $modul->path @>_<@ $modul->slotmodul_id @>_option__modulVisibleAllOver" class="is_updateModulParams" <@ if $modul->site_id < 1 @>checked="checked"<@ /if @> /></td>
				</tr>
				<@ foreach from=$modul->object->params item=value key=key @>
					<tr>
						<td><@ $modul->object->optionTitles[$key] @></td>
						<td><select id="modul__<@ $modul->path @>_<@ $modul->slotmodul_id @>_option__<@ $key @>" class="is_updateModulParams">
							<@ foreach from=$modul->object->options[$key] item=option key=optionKey @>
								<option value="<@ $optionKey @>" <@ if $optionKey == $value @>selected="selected"<@ /if @>><@ $option @></option>
							<@ /foreach @>
							</select>
						</td>
					</tr>
				<@ /foreach @>

			</table>
		</div>

		
	<@ /if @>
</div>