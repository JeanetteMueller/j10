<form method="post" action="<@ $ROOT @>module/login">
	<fieldset>
		<div>
			<label for="module_login_username">Benutzername:</label>
			<input type="text" name="module_login_username" value="" />
		</div>
		<div>
			<label for="module_login_password">Passwort:</label>
			<input type="password" name="module_login_password" value="" />
		</div>
		<div>
			<input type="hidden" name="module_login_action" value="login" />
			<input type="submit" name="module_login_submit" value="Anmelden" class="is_submit" />
		</div>
	</fieldset>
</form>