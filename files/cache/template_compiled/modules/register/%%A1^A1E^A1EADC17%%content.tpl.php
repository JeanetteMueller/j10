<?php /* Smarty version 2.6.26, created on 2011-03-09 21:26:46
         compiled from content.tpl */ ?>
<?php if ($this->_tpl_vars['register']): ?>
	Registration hat geklappt. Bitte aktivieren Sie ihren Account über den Link den wir ihnen soeben per Mail zugestellt haben.

<?php else: ?>
<form method="POST" action="register">
	<fieldset>
		<legend>Zugansdaten</legend>
	
		<div>
			<label for="module_register_username">Benutzername:</label>
			<input type="text" name="module_register_username" value="<?php echo $this->_tpl_vars['username']; ?>
" />
			Der benutzername muss mindestens 4 Zeichen enthalten.
		</div>
		<div>
			<label for="module_register_password">Passwort:</label>
			<input type="password" name="module_register_password" value="" />
		</div>
		<div>
			<label for="module_register_password2">Passwort:</label>
			<input type="password" name="module_register_password2" value="" />
			Die Passwörter müssen mindestens 6-stellig und in beiden Feldern identisch sein.
		</div>
		<div>
			<label for="module_register_email">E-Mail:</label>
			<input type="text" name="module_register_email" value="<?php echo $this->_tpl_vars['email']; ?>
" />
		</div>
		<div>
			<label for="module_register_birthday_day">Geburtsdatum:</label>
			<select name="module_register_birthday_day">
				<?php $_from = $this->_tpl_vars['days']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['day']):
?>
					<option <?php if ($this->_tpl_vars['day'] == $this->_tpl_vars['birthday_day']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['day']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
			<select name="module_register_birthday_month">
				<?php $_from = $this->_tpl_vars['month']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nummer'] => $this->_tpl_vars['name']):
?>
					<option value="<?php echo $this->_tpl_vars['nummer']; ?>
" <?php if ($this->_tpl_vars['nummer'] == $this->_tpl_vars['birthday_month']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
			<select name="module_register_birthday_year">
				<?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['year']):
?>
					<option <?php if ($this->_tpl_vars['year'] == $this->_tpl_vars['birthday_year']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['year']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</div>
		<div>
			<label for="module_register_gender">Geschlecht:</label>
			<select name="module_register_gender">
				<?php $_from = $this->_tpl_vars['genders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
					<option value="<?php echo $this->_tpl_vars['item']->id; ?>
" <?php if ($this->_tpl_vars['item']->id == $this->_tpl_vars['gender']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']->title; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</div>
		<div>
			<input type="hidden" name="module_register_action" value="register" />
			<input type="submit" name="module_register_submit" value="Registrieren" class="is_submit" />
		</div>
	</fieldset>
</form>
<?php endif; ?>