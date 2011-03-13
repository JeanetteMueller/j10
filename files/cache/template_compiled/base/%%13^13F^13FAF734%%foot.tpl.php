<?php /* Smarty version 2.6.26, created on 2011-03-13 10:36:40
         compiled from ../base/foot.tpl */ ?>
<!-- Javascript at the bottom for fast page loading -->

<!-- Grab Google CDN's jQuery. fall back to local if necessary -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="<?php echo $this->_tpl_vars['EXTERNALS_DIR']; ?>
jquery/jquery.js"><\/script>')</script>

<!-- load basic JS files -->
<script src="<?php echo $this->_tpl_vars['TEMPLATE_DIR_BASE']; ?>
js/jx.js?v=1"></script>
<script type="text/javascript">
/* <![CDATA[ */
	jx.root = "<?php echo $this->_tpl_vars['ROOT']; ?>
/";
/* ]]> */	
</script>
<script src="<?php echo $this->_tpl_vars['TEMPLATE_DIR_BASE']; ?>
js/jx/valudator.js?v=1"></script>
<script src="<?php echo $this->_tpl_vars['TEMPLATE_DIR_BASE']; ?>
js/jx/modules.js?v=1"></script>
<script src="<?php echo $this->_tpl_vars['TEMPLATE_DIR_BASE']; ?>
js/jx/autorefresh.js?v=1"></script>
<script src="<?php echo $this->_tpl_vars['TEMPLATE_DIR_BASE']; ?>
js/jx/overlay.js?v=1"></script>
<script src="<?php echo $this->_tpl_vars['TEMPLATE_DIR_BASE']; ?>
js/jx/listener.js?v=1"></script>
<script src="<?php echo $this->_tpl_vars['TEMPLATE_DIR_BASE']; ?>
js/plugins.js?v=1"></script>

<!-- load theme special JS file -->
<script src="<?php echo $this->_tpl_vars['TEMPLATE_DIR']; ?>
js/javascript.js"></script>

<!-- load the JS of the modules -->
<?php $_from = $this->_tpl_vars['moduleIncludes']['javascript']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pfad']):
?>
<script src="<?php echo $this->_tpl_vars['ROOT']; ?>
/<?php echo $this->_tpl_vars['pfad']; ?>
"></script>
<?php endforeach; endif; unset($_from); ?>