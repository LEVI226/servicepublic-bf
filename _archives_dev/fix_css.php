<?php
$file = __DIR__ . '/public/css/style.min.css';
$css = file_get_contents($file);
$target = '.main-footer{background:white;padding:80px 0 40px;border-top:1px solid rgba(0,0,0,0.05);}';
$css = str_replace($target, '', $css);
file_put_contents($file, $css);
echo "Fixed minified CSS.\n";
