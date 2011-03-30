<@ if $content @>


<h1><@ $content->ueberschrift|@utf8_encode @></h1>
<@ if $content->vorspann != null @><div class="vorspann"><@ $content->vorspann|@utf8_encode @></div><@ /if @>

<@ if $content->text1 != null @><div><@ $content->text1|@utf8_encode @></div><@ /if @>
<@ if $content->text2 != null @><div><@ $content->text2|@utf8_encode @></div><@ /if @>
<@ if $content->text3 != null @><div><@ $content->text3|@utf8_encode @></div><@ /if @>
<@ if $content->text4 != null @><div><@ $content->text4|@utf8_encode @></div><@ /if @>

<@ else @>
	Es wurde dieser Seite kein Inhalt zugewiesen.
<@ /if @>