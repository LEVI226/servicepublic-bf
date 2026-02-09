<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParticulierController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\EserviceController;
use App\Http\Controllers\AnnuaireController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/

// Accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Recherche
Route::get('/recherche', [HomeController::class, 'recherche'])->name('recherche');

// Suivi des demandes
Route::get('/suivi', [HomeController::class, 'suivi'])->name('suivi');
Route::post('/suivi', [HomeController::class, 'verifierSuivi'])->name('suivi.verifier');

// Contact
Route::post('/contact', [HomeController::class, 'contact'])->name('contact');

/*
|--------------------------------------------------------------------------
| Routes Particuliers
|--------------------------------------------------------------------------
*/
Route::prefix('particuliers')->group(function () {
    Route::get('/', [ParticulierController::class, 'index'])->name('particuliers.index');
    Route::get('/categorie/{slug}', [ParticulierController::class, 'categorie'])->name('particuliers.categorie');
    Route::get('/categorie/{categorieSlug}/fiche/{ficheSlug}', [ParticulierController::class, 'fiche'])->name('particuliers.fiche');
});

/*
|--------------------------------------------------------------------------
| Routes Entreprises
|--------------------------------------------------------------------------
*/
Route::prefix('entreprises')->group(function () {
    Route::get('/', [EntrepriseController::class, 'index'])->name('entreprises.index');
    Route::get('/categorie/{slug}', [EntrepriseController::class, 'categorie'])->name('entreprises.categorie');
    Route::get('/categorie/{categorieSlug}/fiche/{ficheSlug}', [EntrepriseController::class, 'fiche'])->name('entreprises.fiche');
});

/*
|--------------------------------------------------------------------------
| Routes E-Services
|--------------------------------------------------------------------------
*/
Route::prefix('eservices')->group(function () {
    Route::get('/', [EserviceController::class, 'index'])->name('eservices.index');
    Route::get('/{slug}', [EserviceController::class, 'show'])->name('eservices.show');
    Route::get('/{slug}/demande', [EserviceController::class, 'demande'])->name('eservices.demande');
    Route::post('/{slug}/demande', [EserviceController::class, 'soumettreDemande'])->name('eservices.demande.soumettre');
});

/*
|--------------------------------------------------------------------------
| Routes Annuaire
|--------------------------------------------------------------------------
*/
Route::prefix('annuaire')->group(function () {
    Route::get('/', [AnnuaireController::class, 'index'])->name('annuaire.index');
    Route::get('/structure/{slug}', [AnnuaireController::class, 'show'])->name('annuaire.structure');
});

/*
|--------------------------------------------------------------------------
| Routes Documents
|--------------------------------------------------------------------------
*/
Route::prefix('documents')->group(function () {
    Route::get('/', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/{slug}', [DocumentController::class, 'show'])->name('documents.show');
    Route::get('/{slug}/download', [DocumentController::class, 'download'])->name('documents.download');
});

/*
|--------------------------------------------------------------------------
| Routes FAQ
|--------------------------------------------------------------------------
*/
Route::get('/faq', [FaqController::class, 'index'])->name('faq');

/*
|--------------------------------------------------------------------------
| Routes Authentification
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profil', [AuthController::class, 'profil'])->name('profil');
    Route::put('/profil', [AuthController::class, 'updateProfil'])->name('profil.update');
    Route::put('/profil/password', [AuthController::class, 'updatePassword'])->name('profil.password');
});

/*
|--------------------------------------------------------------------------
| Routes Dashboard (Protégées)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Demandes
    Route::get('/demandes', [DashboardController::class, 'demandes'])->name('dashboard.demandes');
    Route::get('/demandes/{id}', [DashboardController::class, 'showDemande'])->name('dashboard.demandes.show');
    Route::put('/demandes/{id}', [DashboardController::class, 'updateDemande'])->name('dashboard.demandes.update');
    
    // Notifications
    Route::get('/notifications', [DashboardController::class, 'notifications'])->name('dashboard.notifications');
});

/*
|--------------------------------------------------------------------------
| Routes Actualités (si nécessaire)
|--------------------------------------------------------------------------
*/
Route::get('/actualites/{slug}', [\App\Http\Controllers\ActualiteController::class, 'show'])->name('actualites.show');
