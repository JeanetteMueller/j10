<?php /* Smarty version 2.6.26, created on 2011-03-13 12:32:37
         compiled from content.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'image', 'content.tpl', 15, false),)), $this); ?>
<h2>Rubriken dieser Bilder</h2>
<div>
<?php $_from = $this->_tpl_vars['taxonomie']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['tax']):
?>
	<a href="#<?php if ($this->_tpl_vars['images']): ?>gallery_id=<?php echo $this->_tpl_vars['images'][0]->gallery_id; ?>
&<?php endif; ?>taxonomie_id=<?php echo $this->_tpl_vars['tax']->id; ?>
"><?php echo $this->_tpl_vars['tax']->title; ?>
</a>, 
<?php endforeach; endif; unset($_from); ?>	
</div>


<?php if ($this->_tpl_vars['galleries']): ?>
<h2>Neueste Galerien</h2>
<div class="grid">
<?php $_from = $this->_tpl_vars['galleries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['gallerie']):
?>
	<div class="griditem">
		<a href="#gallery_id=<?php echo $this->_tpl_vars['gallerie']->id; ?>
" class="is_gallery_showGallery" id="is_gallery_showGallery__<?php echo $this->_tpl_vars['gallerie']->id; ?>
">
		<?php echo smarty_function_image(array('file' => $this->_tpl_vars['gallerie']->titleimage,'base' => 'multiUserGallery','link' => false,'width' => 140,'height' => 'auto','alt' => $this->_tpl_vars['gallerie']->title,'title' => false), $this);?>

		
		<?php echo $this->_tpl_vars['gallerie']->title; ?>
</a>
	</div>
<?php endforeach; endif; unset($_from); ?>

<?php endif; ?>




<?php if ($this->_tpl_vars['images']): ?>
<h2>Bilder dieser Galerie</h2>
<div class="grid">
<?php $_from = $this->_tpl_vars['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['image']):
?>
	<div class="griditem">
		<a href="#gallery_id=<?php echo $this->_tpl_vars['image']->gallery_id; ?>
&image_id=<?php echo $this->_tpl_vars['image']->id; ?>
" class="is_gallery_showImage" id="is_gallery_showImage__<?php echo $this->_tpl_vars['image']->id; ?>
">
		<?php echo smarty_function_image(array('file' => $this->_tpl_vars['image']->id,'base' => 'multiUserGallery','link' => false,'width' => 140,'height' => 'auto','alt' => $this->_tpl_vars['image']->title), $this);?>

		
		<?php echo $this->_tpl_vars['image']->title; ?>
</a>
	</div>
<?php endforeach; endif; unset($_from); ?>

<?php endif; ?>

</div>