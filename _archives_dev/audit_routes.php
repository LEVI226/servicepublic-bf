<?php
// Script to ping all public routes and find breakages
$url = 'http://127.0.0.1:8000';

$routesToTest = [
    '/',
    '/a-propos',
    '/mentions-legales',
    '/accessibilite',
    '/plan-du-site',
    '/contact',
    '/faq',
    '/annuaire',
    '/eservices',
    '/actualites',
    '/evenements-de-vie',
    '/thematiques',
    '/recherche?q=passeport'
];

echo "Démarrage de l'Audit des Routes Publiques...\n";
echo "==========================================\n";

foreach ($routesToTest as $route) {
    $fullUrl = $url . $route;
    
    $ch = curl_init($fullUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_NOBODY, true); // just HEAD to be fast, but wait, error 500 might only trigger on GET
    // Actually let's do full GET request to ensure templates render
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        echo "[OK] \033[32m200\033[0m : $route\n";
    } elseif ($httpCode === 500) {
        echo "[ERREUR] \033[31m500\033[0m : $route (Casse !)\n";
    } elseif ($httpCode === 404) {
        echo "[INCONNU] \033[33m404\033[0m : $route\n";
    } else {
        echo "[INFO] $httpCode : $route\n";
    }
}
echo "==========================================\n";
echo "Audit terminé.\n";
