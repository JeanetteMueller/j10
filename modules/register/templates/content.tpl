<@ if $register @>
	Registration hat geklappt. Bitte aktivieren Sie ihren Account über den Link den wir ihnen soeben per Mail zugestellt haben.

<@ else @>
<form method="post" action="register">
	<fieldset>
		<legend>Ihre Zugansdaten</legend>
	
		<div>
			<label for="module_register_username">Benutzername:</label>
			<input type="text" name="module_register_username" value="<@ $username @>" />
			<p class="info">Der Benutzername muss mindestens 4 Zeichen enthalten.</p>
		</div>
		<div>
			<label for="module_register_password">Passwort:</label>
			<input type="password" name="module_register_password" value="" />
		</div>
		<div>
			<label for="module_register_password2">Passwort wiederholen:</label>
			<input type="password" name="module_register_password2" value="" />
			<p class="info">Die Passwörter müssen mindestens 6-stellig und in beiden Feldern identisch sein.</p>
		</div>
		<div>
			<label for="module_register_email">E-Mail:</label>
			<input type="text" name="module_register_email" value="<@ $email @>" />
		</div>
		<div>
			<label for="module_register_birthday_day">Geburtsdatum:</label>
			<select name="module_register_birthday_day">
				<@ foreach from=$days item=day @>
					<option <@ if $day == $birthday_day @>selected="selected"<@ /if @> ><@ $day @></option>
				<@ /foreach @>
			</select>
			<select name="module_register_birthday_month">
				<@ foreach from=$month key=nummer item=name @>
					<option value="<@ $nummer @>" <@ if $nummer == $birthday_month @>selected="selected"<@ /if @>><@ $name @></option>
				<@ /foreach @>
			</select>
			<select name="module_register_birthday_year">
				<@ foreach from=$years item=year @>
					<option <@ if $year == $birthday_year @>selected="selected"<@ /if @>><@ $year @></option>
				<@ /foreach @>
			</select>
		</div>
		<div>
			<label for="module_register_gender">Geschlecht:</label>
			<select name="module_register_gender">
				<@ foreach from=$genders item=item @>
					<option value="<@ $item->id @>" <@ if $item->id == $gender @>selected="selected"<@ /if @>><@ $item->title @></option>
				<@ /foreach @>
			</select>
		</div>
		<div>
			<input type="hidden" name="module_register_action" value="register" />
			<input type="submit" name="module_register_submit" value="Registrieren" class="is_submit" />
		</div>
	</fieldset>
</form>
<@ /if @>