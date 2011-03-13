
<div id="slot_<@ $slot->id @>" class="slot slot_<@ $slot->title @>">
<small><@ $slot->title @></small>

<@ foreach from=$modules key=key item=item @>
	
	<@ include file=../$THEME/modul.tpl modul=$item @>

<@ /foreach @>
</div>