<?php
$font = stripslashes($_REQUEST[font]);

$lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
$availfonts = explode("\n", `fc-list :lang=$lang : family | awk -F, '{print $1}'`);
sort($availfonts);
$availfonts = array_unique($availfonts);
?>
<select name="font">
<?php
foreach ($availfonts as $f) {
	if (empty($f)) { continue; }
	echo "<option value=\"$f\" style=\"font-family: $f;\"";
	if ($font == $f) { echo "selected"; }
	echo ">$f</option>\n";
}
?>
</select>
