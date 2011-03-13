<?php /* Smarty version 2.6.26, created on 2011-02-27 18:51:02
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'slot', 'index.tpl', 6, false),)), $this); ?>
<!-- Jeanette Theme -->

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../base/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<header>
	<?php echo smarty_function_slot(array('title' => 'header'), $this);?>

</header>

<div id="main">
	<?php echo smarty_function_slot(array('title' => 'sidebar_left'), $this);?>


	<?php echo smarty_function_slot(array('title' => 'content'), $this);?>


	<?php echo smarty_function_slot(array('title' => 'sidebar_right'), $this);?>

</div>

<footer>
	<?php echo smarty_function_slot(array('title' => 'footer'), $this);?>

</footer>







<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../base/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>