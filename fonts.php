<?php
$font = stripslashes($_REQUEST[font]);

$lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
$availfonts = explode("\n", `fc-list :lang=$lang : family`);
sort($availfonts);
?>
<select name="font">
<?php
foreach ($availfonts as $f) {
	if (empty($f)) { continue; }
	list($fontname) = explode(',', $f);
	echo "<option value=\"$fontname\" style=\"font-family: $fontname;\"";
	if ($font == $fontname) { echo "selected"; }
	echo ">$fontname</option>\n";
}
?>
</select>
