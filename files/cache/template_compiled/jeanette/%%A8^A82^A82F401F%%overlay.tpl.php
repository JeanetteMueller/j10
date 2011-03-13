<?php /* Smarty version 2.6.26, created on 2011-03-13 10:41:30
         compiled from overlay.tpl */ ?>
<div id="modul__<?php echo $this->_tpl_vars['modul']->path; ?>
_<?php echo $this->_tpl_vars['modul']->id; ?>
" title="<?php echo $this->_tpl_vars['modul']->path; ?>
" class="modul<?php if ($this->_tpl_vars['modul']->object->autoRefresh()): ?> refresh<?php endif; ?> is_<?php echo $this->_tpl_vars['modul']->path; ?>
">
	
	
	<?php $this->assign('header', $this->_tpl_vars['overlay']['head']); ?>
	<?php if ($this->_tpl_vars['header'] !== false): ?>
	<div class="outerHeader"><div class="header"><?php echo $this->_tpl_vars['header']; ?>
</div></div>
	<?php endif; ?>
	
	<?php $this->assign('content', $this->_tpl_vars['overlay']['content']); ?>
	<?php if ($this->_tpl_vars['content'] !== false): ?>
	<div class="content"><?php echo $this->_tpl_vars['content']; ?>
</div>
	<?php endif; ?>
	
	
	<?php $this->assign('footer', $this->_tpl_vars['overlay']['footer']); ?>
	<?php if ($this->_tpl_vars['footer'] !== false): ?>
	<div class="footer"><?php echo $this->_tpl_vars['footer']; ?>
</div>
	<?php endif; ?>
	
	
</div>