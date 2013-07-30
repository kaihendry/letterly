<?php

$to = implode("\n", array($t1,$t2, $t3, $t4, $t5));
$from = implode("\n", array($f2, $f3, $f4, $f5));

$to = trim($to);
$from = trim($from);

$to = preg_replace('/\n/', "\\\\\\\n", $to);
$from = preg_replace('/\n/', "\\\\\\\n", $from);
$body = str_replace ("\r\n", "\n", $body);


if ($from && $to && $body && $opening && $closing && $font) {

umask(0);

$template_file = "letter.template";

$lettertex = sprintf(fread(fopen($template_file, 'r'), filesize($template_file)), stripslashes($font), stripslashes($from), stripslashes($to), stripslashes($f1), stripslashes($opening), stripslashes($body), stripslashes($closing));

$PWD = dirname($_SERVER["SCRIPT_FILENAME"]);
$uid = 'l/' . gmdate("Y-m-d\TH") . '/' . $_SERVER["REMOTE_ADDR"];

$writedir = $PWD . "/$uid";
if (!is_dir($writedir)) {
    if ($body) {
    mkdir($writedir, 0777, true);
    }
}

$letterloc = $writedir . "/letter.tex";

if (is_dir($writedir)) {
$file = fopen($letterloc, 'w');
fwrite($file, $lettertex);
fclose($file);
}

$letterEOL = addcslashes($lettertex, "\0..\37!@\177..\377");

echo "<!-- <pre>\n";
echo "$letterEOL";
echo "\n\n";
echo "$lettertex";
echo "</pre> -->\n";


echo "<!-- XeLateX output: \n";
$arg = escapeshellarg($letterloc);

echo "Attempting to write to: $writedir\n";
echo system("test -w $writedir && echo test > $writedir/letter.pdf", $retval);
echo $retval;
echo system("ls -lah $writedir/letter.pdf", $retval);
echo $retval;
echo system("whoami && cd $writedir && /usr/bin/xelatex $arg -output-directory=$writedir", $retval);
echo "\n-->\n";

if ($retval == 0) {
	echo "<h1><a href=\"$uid/letter.pdf\">Download and View PDF Letter</a></h1>";
} else { echo '<h1>Oh no, your letter is causing the compiler to choke. Please save the letter and <a href="mailto:hendry@iki.fi">report</a> the issue.</h1>'; }
} else { echo "<h1>Please type your letter</h1>"; }
?>
