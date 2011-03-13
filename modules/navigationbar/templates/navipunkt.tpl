<ul>
<@ foreach from=$tree item=site @>

	<li><a href="<@ link path=$site->path type='site' @>"><@ $site->title @></a>
		<@ if $site->subnavi != false @>
			<@ include file=navipunkt.tpl tree=$site->subnavi @>
		<@ /if @>
	</li>
	
<@ /foreach @>
</ul>