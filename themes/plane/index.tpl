<!-- Jeanette Theme -->

<@ include file=../base/header.tpl @>

<header>
	<a href="<@ $ROOT @>" class="rootlink">j10 Portal</a>
	<@ slot title=header @>
</header>

<div id="main">
	<@ slot title=sidebar_left @>

	<@ slot title=content @>

	<@ slot title=sidebar_right @>
</div>

<footer>
	<@ slot title=footer @>
</footer>







<@ include file=../base/footer.tpl @>