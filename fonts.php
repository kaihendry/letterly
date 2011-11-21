<?php
$font = stripslashes($_POST[font]);
?>
<select name="font" size="1">
<option value="DejaVu Sans" style="font-family: DejaVu Sans;" <? if ($font == "DejaVu Sans") { echo "selected"; } ?>>DejaVu Sans</option>
<option value="Charis SIL" style="font-family: Charis;" <? if ($font == "Charis SIL") { echo "selected"; } ?>>Charis SIL</option>
<option value="Gentium" style="font-family: gentium;" <? if ($font == "Gentium") { echo "selected"; } ?>>Gentium</option>
</select>
