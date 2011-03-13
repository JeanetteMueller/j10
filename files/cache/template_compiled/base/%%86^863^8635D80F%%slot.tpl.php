<?php /* Smarty version 2.6.26, created on 2011-02-27 18:19:24
         compiled from slot.tpl */ ?>

<div id="slot_<?php echo $this->_tpl_vars['slot']->id; ?>
" class="slot slot_<?php echo $this->_tpl_vars['slot']->title; ?>
">
<small><?php echo $this->_tpl_vars['slot']->title; ?>
</small>

<?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
	
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../".($this->_tpl_vars['THEME'])."/modul.tpl", 'smarty_include_vars' => array('modul' => $this->_tpl_vars['item'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endforeach; endif; unset($_from); ?>
</div>