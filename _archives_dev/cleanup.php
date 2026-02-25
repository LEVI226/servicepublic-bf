<?php

$archiveDir = __DIR__ . '/_archives_dev';
if (!is_dir($archiveDir)) {
    mkdir($archiveDir, 0777, true);
}

$filesToMove = [];

// Fichiers statiques et images à bouger
$exactFiles = [
    'ngrok.exe',
    'START_PRESENTATION.bat',
    'armoirie-burkina-faso.png',
    'dropdowncategorie.png',
    'imagescategorie.png',
    'problemeDropdownCategorie.png',
    'photo_5818939542688435774_y.jpg',
    'siteCompletPageDaccueil.png',
    '—Pngtree—burkina faso flag_8526976.png',
    'entreprises-2026-02-21-02_03_55.png',
    'install_shield.ps1',
    'query',
    'content_dump.json',
    'debug_out.json',
    'audit_raw.md',
    'sitemap.md'
];

foreach ($exactFiles as $f) {
    if (file_exists(__DIR__ . '/' . $f) && is_file(__DIR__ . '/' . $f)) {
        $filesToMove[] = $f;
    }
}

// Boucle sur le dossier racine
$dir = opendir(__DIR__);
while (($file = readdir($dir)) !== false) {
    if (is_file(__DIR__ . '/' . $file)) {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $basename = basename($file);
        
        // Logs, Pythons, CSV, Textes
        if (in_array($ext, ['txt', 'log', 'csv', 'py'])) {
            // on ne touche pas à robots.txt s'il était là, mais il est dans public normaalement
            $filesToMove[] = $file;
        }
        
        // Fichiers PHP de debug (sauf artisan, mais il n'a pas d'extension, et server.php/index.php)
        if ($ext === 'php') {
            if (!in_array($basename, ['server.php', 'index.php', 'cleanup.php'])) {
                $filesToMove[] = $file;
            }
        }
    }
}
closedir($dir);

$filesToMove = array_unique($filesToMove);

$count = 0;
foreach ($filesToMove as $file) {
    $source = __DIR__ . '/' . $file;
    $dest = $archiveDir . '/' . $file;
    if (file_exists($source)) {
        rename($source, $dest);
        $count++;
    }
}

// Dossier cleaned_assets
if (is_dir(__DIR__ . '/cleaned_assets')) {
    rename(__DIR__ . '/cleaned_assets', $archiveDir . '/cleaned_assets');
    $count++;
}

echo "Succès: $count fichiers et dossiers ont été déplacés vers l'archive ($archiveDir).\n";
