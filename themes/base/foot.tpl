<!-- Javascript at the bottom for fast page loading -->

<script src="<@ $EXTERNALS_DIR @>jquery/jquery.js"></script>
<script src="<@ $EXTERNALS_DIR @>jquery/jquery-ui-1.8.11.custom.min.js"></script>

<!-- load basic JS files -->
<script src="<@ $TEMPLATE_DIR_BASE @>js/jx.js?v=1"></script>
<script type="text/javascript">
/* <![CDATA[ */
	jx.root = "<@ $ROOT @>";
/* ]]> */	
</script>
<script src="<@ $TEMPLATE_DIR_BASE @>js/jx/validator.js?v=1"></script>
<script src="<@ $TEMPLATE_DIR_BASE @>js/jx/modules.js?v=1"></script>
<script src="<@ $TEMPLATE_DIR_BASE @>js/jx/autorefresh.js?v=1"></script>
<script src="<@ $TEMPLATE_DIR_BASE @>js/jx/overlay.js?v=1"></script>
<script src="<@ $TEMPLATE_DIR_BASE @>js/jx/listener.js?v=1"></script>
<script src="<@ $TEMPLATE_DIR_BASE @>js/plugins.js?v=1"></script>

<!-- load theme special JS file -->
<script src="<@ $TEMPLATE_DIR @>js/javascript.js"></script>

<!-- load the JS of the modules -->
<@ foreach from=$moduleIncludes.javascript item=pfad @>
<script src="<@ $ROOT @><@ $pfad @>"></script>
<@ /foreach @>