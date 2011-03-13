<?php /* Smarty version 2.6.26, created on 2011-03-13 10:37:58
         compiled from ../base/head.tpl */ ?>

<meta charset="utf-8">

<!-- www.phpied.com/conditional-comments-block-downloads/ -->
<!--[if IE]><![endif]-->

<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
     Remove this if you use the .htaccess -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?php echo $this->_tpl_vars['site']->title; ?>
</title>
<meta name="description" content="">
<meta name="author" content="">

<!--  Mobile Viewport Fix
      j.mp/mobileviewport & davidbcalhoun.com/2010/viewport-metatag 
device-width : Occupy full width of the screen in its current orientation
initial-scale = 1.0 retains dimensions instead of zooming out if page height > device height
maximum-scale = 1.0 retains dimensions instead of zooming in if page width < device width
-->
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">


<!-- Place favicon.ico and apple-touch-icon.png in the root of your domain and delete these references -->
<link rel="shortcut icon" href="/favicon.ico">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">


<!-- CSS : implied media="all" -->
<link rel="stylesheet" media="all" href="<?php echo $this->_tpl_vars['TEMPLATE_DIR_BASE']; ?>
css/style.css?v=1">
<link rel="stylesheet" media="all" href="<?php echo $this->_tpl_vars['TEMPLATE_DIR']; ?>
css/style.css?v=1">

<!-- For the less-enabled mobile browsers like Opera Mini -->
<link rel="stylesheet" media="handheld" href="<?php echo $this->_tpl_vars['TEMPLATE_DIR_BASE']; ?>
css/handheld.css?v=1">


<!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
<script src="<?php echo $this->_tpl_vars['EXTERNALS_DIR']; ?>
modernizr-1.5/modernizr-1.5.min.js"></script>

<!-- load the JS of the modules -->
<?php $_from = $this->_tpl_vars['moduleIncludes']['css']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pfad']):
?>
<link rel="stylesheet" media="all" href="<?php echo $this->_tpl_vars['ROOT']; ?>
/<?php echo $this->_tpl_vars['pfad']; ?>
?v=1">
<?php endforeach; endif; unset($_from); ?>

