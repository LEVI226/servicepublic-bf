@echo off
set PHP_BIN="c:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe"

echo ========================================================
echo   LANCEMENT RAPIDE - SERVICE PUBLIC BF
echo ========================================================
echo.
echo 1. Lancement du serveur Laravel...
echo    Utilisation de PHP : %PHP_BIN%

start "Serveur Laravel" cmd /k "%PHP_BIN% artisan serve"
echo    [OK] Serveur lance.
echo.
echo 2. Lancement de Ngrok...
echo.
if exist "ngrok.exe" (
    echo    Ngrok trouve ! Lancement du tunnel...
    .\ngrok.exe http 8000
) else (
    echo    [ATTENTION] ngrok.exe n'est pas dans ce dossier.
    echo    Veuillez le copier ici pour que ca marche automatiquement.
    echo    Sinon, lancez-le manuellement.
    pause
)
