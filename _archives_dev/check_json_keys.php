<?php
$json = file_get_contents('content_dump.json');
$data = json_decode($json, true);
echo "Keys in JSON:\n";
print_r(array_keys($data));
