<?php /* Smarty version 2.6.26, created on 2011-02-27 18:21:44
         compiled from ../jeanette/modul.tpl */ ?>
<div id="modul__<?php echo $this->_tpl_vars['modul']->path; ?>
_<?php echo $this->_tpl_vars['modul']->id; ?>
" title="<?php echo $this->_tpl_vars['modul']->path; ?>
" class="modul<?php if ($this->_tpl_vars['modul']->object->autoRefresh()): ?> refresh<?php endif; ?> is_<?php echo $this->_tpl_vars['modul']->path; ?>
">
	
	<?php $this->assign('header', $this->_tpl_vars['modul']->object->loadHeader()); ?>
	<?php if ($this->_tpl_vars['header'] !== false): ?>
	<div class="outerHeader"><div class="header"><?php echo $this->_tpl_vars['header']; ?>
</div></div>
	<?php endif; ?>
	
	
	<?php $this->assign('content', $this->_tpl_vars['modul']->object->loadContent()); ?>
	<?php if ($this->_tpl_vars['content'] !== false): ?>
	<div class="content"><?php echo $this->_tpl_vars['content']; ?>
</div>
	<?php endif; ?>
	
	
	<?php $this->assign('footer', $this->_tpl_vars['modul']->object->loadFooter()); ?>
	<?php if ($this->_tpl_vars['footer'] !== false): ?>
	<div class="footer"><?php echo $this->_tpl_vars['footer']; ?>
</div>
	<?php endif; ?>
	
</div>