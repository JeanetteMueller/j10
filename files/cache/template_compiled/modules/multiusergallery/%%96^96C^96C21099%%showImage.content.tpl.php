<?php /* Smarty version 2.6.26, created on 2011-03-02 06:50:25
         compiled from showImage.content.tpl */ ?>

<img src="<?php echo $this->_tpl_vars['FILES_DIR']; ?>
originals/multiUserGallery/<?php echo $this->_tpl_vars['image']->id; ?>
.jpg" 
	width="100%" 
	style="width:100%;" 
	alt="<?php echo $this->_tpl_vars['image']->title; ?>
"
/>

	
<?php if ($this->_tpl_vars['last_id']): ?><a href="#gallery_id=<?php echo $this->_tpl_vars['image']->gallery_id; ?>
&image_id=<?php echo $this->_tpl_vars['last_id']; ?>
" 
					class="is_gallery_showImage is_gallery_showImageLast" 
					id="is_gallery_showLastImage__<?php echo $this->_tpl_vars['last_id']; ?>
">vorheriges</a><?php endif; ?>
<?php if ($this->_tpl_vars['next_id']): ?><a href="#gallery_id=<?php echo $this->_tpl_vars['image']->gallery_id; ?>
&image_id=<?php echo $this->_tpl_vars['next_id']; ?>
" 
					class="is_gallery_showImage is_gallery_showImageNext" 
					id="is_gallery_showNextImage__<?php echo $this->_tpl_vars['next_id']; ?>
">next</a><?php endif; ?>