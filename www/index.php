<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link href="letter.css" rel="stylesheet" type="text/css">
<title>Letterly, Web form to printable PDF</title>
<meta name="description" content="Letterly is a letter template, HTML5 form to printable PDF." />
<script src="autosaver.js"></script>
</head>

<?php
function createInput($label,$placeholder,$name) {

echo '<li><label>'.$label
    .'<input placeholder="'.$placeholder
    .'" name="'.$name
    .'"></label></li>'."\n";

return $value;
}
?>

<form id="letter" method="post" action="pdf/">

<ul id="to">
<?php
$t1 = createInput("TO","Address line 1","t1");
$t2 = createInput("Address line 2","Address line 2","t2");
$t3 = createInput("Address line 3","Address line 3","t3");
$t4 = createInput("Address line 4","Address line 4","t4");
$t5 = createInput("Address line 5","Address line 5","t5");
?>
</ul>

<ul id="from">
<?php
$f1 = createInput("FROM","Your Name","f1");
$f2 = createInput("Address line 2","Address line 1","f2");
$f3 = createInput("Address line 3","Address line 2","f3");
$f4 = createInput("Address line 4","Address line 3","f4");
$f5 = createInput("Address line 5","Address line 4","f5");
?>
</ul>

<ul id="opening">
<?php
$opening = createInput("Opening","To whom it may concern","opening");
?>
</ul>

<textarea spellcheck="true" class="body" title="Letter body" required="required" placeholder="Your letter" id="body" name="body" cols="80" rows="15">
</textarea>

<ul id="closing">
<?php
$closing = createInput("Closing","Sincerely,","closing");
?>
</ul>

<div id="controls">
<button onclick="saveFormState();" type="submit"><img src="/favicon.ico" alt=""/>&nbsp;Letterly!</button>
</div>

</form>

<ul class="footer">
<li><a href="faq/"><abbr title="Frequently Asked Questions">FAQ</abbr></a></li>
</ul>

</body>
</html>
