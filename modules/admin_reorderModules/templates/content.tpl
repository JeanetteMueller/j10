<select name="modulselect" class="is_modulselector">
	<option value=""> – Modul wählen – </option>
	<@ foreach from=$modules item=modul @>
		<option value="<@ $modul->id @>___<@ $modul->path @>"><@ $modul->title @></option>
	<@ /foreach @>
</select>