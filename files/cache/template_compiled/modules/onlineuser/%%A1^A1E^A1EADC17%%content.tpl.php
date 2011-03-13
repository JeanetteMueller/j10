<?php /* Smarty version 2.6.26, created on 2011-02-27 18:12:57
         compiled from content.tpl */ ?>
<ul>
	<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
		<li><?php echo $this->_tpl_vars['user']; ?>
</li>
	<?php endforeach; endif; unset($_from); ?>
</ul>
