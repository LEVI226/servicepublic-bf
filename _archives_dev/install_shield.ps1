$ErrorActionPreference = "Stop"
$PHP = "C:\xampp\php\php.exe"

Write-Host "Vérification de Composer..."
if (-not (Test-Path "composer.phar")) {
    & $PHP -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    & $PHP composer-setup.php
    & $PHP -r "unlink('composer-setup.php');"
}

Write-Host "Installation de Filament Shield via Composer..."
& $PHP composer.phar require bezhanshah/filament-shield -W

Write-Host "Installation terminée avec succès."
