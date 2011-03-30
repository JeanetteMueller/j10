
<@ if $loggedIn == true @>
	<@ include file="content.logged_in.tpl" @>
<@ else @>
	<@ include file="content.logged_out.tpl" @>
<@ /if @>