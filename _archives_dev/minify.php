<?php
$css = file_get_contents(__DIR__ . '/public/css/style.css');

// simple minify
$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
$css = str_replace(["\r\n", "\r", "\n", "\t", '  ', '    ', '    '], '', $css);
$css = str_replace([' { ', ' {', '{ '], '{', $css);
$css = str_replace([' } ', ' }', '} '], '}', $css);
$css = str_replace([' : ', ' :', ': '], ':', $css);
$css = str_replace([' ; ', ' ;', '; '], ';', $css);

file_put_contents(__DIR__ . '/public/css/style.min.css', $css);
echo "Minification compelte.\n";
