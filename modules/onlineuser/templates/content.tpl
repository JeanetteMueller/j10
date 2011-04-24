<ul>
	<@ foreach from=$list item=user @>
		<li><@ $user.username @></li>
	<@ /foreach @>
</ul>

(Maximale Anzeige <@ $maxCount @>)