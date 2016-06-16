<?php

function rb($template_var) {
	$braces = array("{", "}");
	return str_replace($braces, "", $template_var);
}

$t1 = stripslashes($_REQUEST["t1"]);
$t2 = stripslashes($_REQUEST["t2"]);
$t3 = stripslashes($_REQUEST["t3"]);
$t4 = stripslashes($_REQUEST["t4"]);
$t5 = stripslashes($_REQUEST["t5"]);

$f1 = stripslashes($_REQUEST["f1"]);
$f2 = stripslashes($_REQUEST["f2"]);
$f3 = stripslashes($_REQUEST["f3"]);
$f4 = stripslashes($_REQUEST["f4"]);
$f5 = stripslashes($_REQUEST["f5"]);

$opening = stripslashes($_REQUEST["opening"]);
$closing = stripslashes($_REQUEST["closing"]);
$body = stripslashes($_REQUEST['body']);

// Prompted by https://news.ycombinator.com/item?id=6300061
$to = array_filter(array($t1, $t2, $t3, $t4, $t5));
$from = array_filter(array($f2, $f3, $f4, $f5));
$to = implode("\n", array_map('stripslashes', $to));
$from = implode("\n", array_map('stripslashes', $from) );

$to = preg_replace('/\n/', "\\\\\\\n", $to);
$from = preg_replace('/\n/', "\\\\\\\n", $from);

$to = trim($to);
$from = trim($from);

$body = str_replace ("\r\n", "\n", stripslashes($body));

if ($from && $to && $body && $opening && $closing) {

umask(0);

$template_file = "letter.template";
$tpl = file_get_contents($template_file);
$lettertex = sprintf($tpl, rb($from), rb($to), rb($f1), rb($opening), rb($body), rb($closing));

$writedir = '/tmp/' . gmdate("Y-m-d\TH") . '/' . $_SERVER["REMOTE_ADDR"];

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

$arg = escapeshellarg($letterloc);
exec("cd $writedir && /usr/bin/xelatex $arg -output-directory=$writedir", $output, $retval);

if ($retval == 0) {
	header("Content-type:application/pdf");
	readfile("$writedir/letter.pdf");
} else {
	echo '<h1>Oh no, your letter is causing the tex compiler to choke. Please save the letter and <a href="mailto:hendry@iki.fi">report</a> the issue.</h1>'; }
} else { echo "<h1>Please type your letter</h1>"; }
?>
