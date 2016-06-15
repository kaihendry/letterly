<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link href="letter.css" rel="stylesheet" type="text/css">
<title>Letterly, Web form to printable PDF</title>
<meta name="description" content="Letterly is a letter template, HTML5 form to printable PDF. Opensource. Unicode." />
<script src="autosaver.js"></script>
</head>

<?php
function createInput($label,$placeholder,$name) {

$value = stripslashes($_REQUEST[$name]);

echo '<li><label>'.$label
    .'<input placeholder="'.$placeholder
    .'" name="'.$name
    .'" value="'.htmlspecialchars($value).'"></label></li>'."\n";

return $value;
}
?>

<form id="letter" method="POST">

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
<?php
$body = stripslashes($_REQUEST['body']);
echo(htmlspecialchars($body));
?>
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

<?php include 'generate.php'; ?>

<ul class="footer">
<li><a href="faq/"><abbr title="Frequently Asked Questions">FAQ</abbr></a></li>
</ul>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-195686-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html>
