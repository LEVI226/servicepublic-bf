$ErrorActionPreference = "Stop"

# Configuration
$projectName = "servicepublic-bf"
$dbName = "servicepublic_bf"
$dbUser = "root"
$dbPassword = "" # Laisser vide si pas de mot de passe
$timestamp = Get-Date -Format "yyyyMMdd_HHmmss"
$exportDir = "export_$timestamp"
$zipName = "$projectName_$timestamp.zip"

Write-Host "=== Début de l'exportation du projet $projectName ===" -ForegroundColor Cyan

# 1. Création du dossier temporaire d'export
if (Test-Path $exportDir) { Remove-Item $exportDir -Recurse -Force }
New-Item -ItemType Directory -Force -Path $exportDir | Out-Null
Write-Host "[+] Dossier temporaire créé : $exportDir" -ForegroundColor Green

# 2. Export de la base de données
Write-Host "Export de la base de données..." -ForegroundColor Yellow
$dumpFile = "$exportDir\database_dump.sql"
try {
    # Tentative d'utilisation de mysqldump via le PATH ou Laragon
    $mysqldump = Get-Command mysqldump -ErrorAction SilentlyContinue
    if ($null -eq $mysqldump) {
        # Fallback pour Laragon si non trouvé dans le PATH
        $laragonBin = "C:\laragon\bin\mysql"
        if (Test-Path $laragonBin) {
            $latestMysql = Get-ChildItem $laragonBin | Sort-Object Name -Descending | Select-Object -First 1
            if ($latestMysql) {
                $env:Path += ";$($latestMysql.FullName)\bin"
            }
        }
    }

    if ($dbPassword) {
        mysqldump -u $dbUser -p$dbPassword $dbName > $dumpFile
    } else {
        mysqldump -u $dbUser $dbName > $dumpFile
    }
    
    if (Test-Path $dumpFile) {
        Write-Host "[+] Base de données exportée vers $dumpFile" -ForegroundColor Green
    } else {
        throw "Le fichier dump sql n'a pas été créé."
    }
} catch {
    Write-Host "[-] Erreur lors de l'export SQL : $_" -ForegroundColor Red
    Write-Host "Assurez-vous que MySQL est lancé et que mysqldump est accessible."
}

# 3. Copie des fichiers du projet (Exclusion de vendor et node_modules)
Write-Host "Copie des fichiers sources..." -ForegroundColor Yellow
$exclude = @("vendor", "node_modules", ".git", ".idea", ".vscode", "storage\framework", "storage\logs", $exportDir)

# Copie manuelle avec exclusion (robocopy est plus robuste mais Copy-Item plus simple pour script portable)
# On utilise une méthode simple : Tout copier sauf exclusions
Get-ChildItem -Path . -Exclude $exportDir | ForEach-Object {
    if ($exclude -notcontains $_.Name) {
        Copy-Item -Path $_.FullName -Destination $exportDir -Recurse -Force
    }
}
Write-Host "[+] Fichiers sources copiés (sans vendor/node_modules)" -ForegroundColor Green

# 4. Création de l'archive ZIP
Write-Host "Création de l'archive ZIP..." -ForegroundColor Yellow
$source = Resolve-Path $exportDir
$destination = Join-Path (Get-Location) $zipName

Compress-Archive -Path "$source\*" -DestinationPath $destination -Force

# Nettoyage
Remove-Item $exportDir -Recurse -Force

Write-Host ""
Write-Host "=== EXPORT TERMINÉ AVEC SUCCÈS ===" -ForegroundColor Cyan
Write-Host "Fichier créé : $zipName" -ForegroundColor Green
Write-Host "Ce fichier contient :"
Write-Host "1. Le code source (sans dépendances lourdes)"
Write-Host "2. Le dump de la base de données (database_dump.sql)"
Write-Host ""
Write-Host "Pour réimporter :"
Write-Host "1. Dézippez"
Write-Host "2. Créez la base de données '$dbName'"
Write-Host "3. Importez le fichier SQL"
Write-Host "4. Lancez 'composer install' et 'npm install'"
Write-Host "5. Copiez .env.example vers .env et générez la clé (php artisan key:generate)"
