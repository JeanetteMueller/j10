<?php /* Smarty version 2.6.26, created on 2011-02-27 18:12:57
         compiled from navipunkt.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', 'navipunkt.tpl', 4, false),)), $this); ?>
<ul>
<?php $_from = $this->_tpl_vars['tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['site']):
?>

	<li><a href="<?php echo smarty_function_link(array('path' => $this->_tpl_vars['site']->path,'type' => 'site'), $this);?>
"><?php echo $this->_tpl_vars['site']->title; ?>
</a>
		<?php if ($this->_tpl_vars['site']->subnavi != false): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "navipunkt.tpl", 'smarty_include_vars' => array('tree' => $this->_tpl_vars['site']->subnavi)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
	</li>
	
<?php endforeach; endif; unset($_from); ?>
</ul>