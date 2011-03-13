<!-- Jeanette Theme -->

<@ include file=../base/header.tpl @>

<header>
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