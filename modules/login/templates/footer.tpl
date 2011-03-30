
<@ if $loggedIn == true @>
	<@ include file="footer.logged_in.tpl" @>
<@ else @>
	<@ include file="footer.logged_out.tpl" @>
<@ /if @>