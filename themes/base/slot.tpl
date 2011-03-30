
<div id="slot_<@ $slot->id @>" class="slot slot_<@ $slot->title @>">
<@*<small><@ $slot->title @></small>*@>

<@ foreach from=$modules key=key item=item @>
	
	<@ if file_exists("$THEMEPATH/modul.tpl") @>
		<@ include file=../$THEME/modul.tpl modul=$item @>
	<@ else @>
		<@ include file=../base/modul.tpl modul=$item @>
	<@ /if @>
	
<@ /foreach @>
</div>