<?php

function rb($template_var) {
	$braces = array("{", "}");
	return str_replace($braces, "", $template_var);
}

$to = implode("\n", array_map('stripslashes', array($t1, $t2, $t3, $t4, $t5)) );
$from = implode("\n", array_map('stripslashes', array($f2, $f3, $f4, $f5)) );

$to = preg_replace('/\n/', "\\\\\\\n", $to);
$from = preg_replace('/\n/', "\\\\\\\n", $from);

$to = trim($to);
$from = trim($from);

$body = str_replace ("\r\n", "\n", stripslashes($body));

if ($from && $to && $body && $opening && $closing && $font) {

umask(0);

$template_file = "letter.template";
$tpl = file_get_contents($template_file);
$lettertex = sprintf($tpl, stripslashes($font), rb($from), rb($to), rb($f1), rb($opening), rb($body), rb($closing));

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
echo system("whoami && cd $writedir && /usr/bin/xelatex $arg -output-directory=$writedir", $retval);
echo "\n-->\n";

if ($retval == 0) {
	echo "<h1><a href=\"$uid/letter.pdf\">Download and View PDF Letter</a> <small>" .
	round(filesize("$uid/letter.pdf") / 1048576, 2) . "  megabytes</small></h1>";
} else {
	echo '<h1>Oh no, your letter is causing the compiler to choke. Please save the letter and <a href="mailto:hendry@iki.fi">report</a> the issue.</h1>'; }
} else { echo "<h1>Please type your letter</h1>"; }
?>
