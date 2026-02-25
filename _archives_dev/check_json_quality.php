<?php

$jsonPath = 'c:/Users/ulric/Downloads/servicepublic-bf-v2/servicepublic-bf-v2/content_dump.json';
$data = json_decode(file_get_contents($jsonPath), true);

$goodExamples = [];
foreach($data['procedures'] as $jsonP) {
    if (isset($jsonP['documents']) && is_array($jsonP['documents']) && count($jsonP['documents']) > 1) {
        $goodExamples[] = [
            'title' => $jsonP['title'],
            'docs' => $jsonP['documents']
        ];
    }
}

echo "Procédures bien remplies (Documents multiples) : " . count($goodExamples) . "\n";
if(count($goodExamples) > 0) {
    for($i=0; $i<5; $i++) {
        echo "- " . $goodExamples[$i]['title'] . "\n";
    }
} else {
    echo "Toutes les procédures du JSON sont vides de documents.\n";
}
