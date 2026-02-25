<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ThematiqueController;
use App\Http\Controllers\FicheController;
use App\Http\Controllers\EvenementVieController;
use App\Http\Controllers\DemarcheController;
use App\Http\Controllers\AnnuaireController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\RechercheController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EServiceController;

/*
|--------------------------------------------------------------------------
| Routes Publiques — Particuliers (par défaut)
|--------------------------------------------------------------------------
*/

// Accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Recherche globale
Route::get('/recherche', [RechercheController::class, 'index'])->name('recherche');

// Actualités
Route::get('/actualites', [ActualiteController::class, 'index'])->name('actualites.index');
Route::get('/actualites/{slug}', [ActualiteController::class, 'show'])->name('actualites.show');

/*
|--------------------------------------------------------------------------
| Comment faire si ? (Événements de vie)
|--------------------------------------------------------------------------
*/
Route::get('/comment-faire-si', [EvenementVieController::class, 'index'])->name('evenements.index');
Route::get('/comment-faire-si/{slug}', [EvenementVieController::class, 'show'])->name('evenements.show');

/*
|--------------------------------------------------------------------------
| Fiches pratiques par thème
|--------------------------------------------------------------------------
*/
Route::get('/thematiques', [ThematiqueController::class, 'index'])->name('thematiques.index');
Route::get('/thematiques/{slug}', [ThematiqueController::class, 'show'])->name('thematiques.show');
Route::get('/thematiques/{themeSlug}/{ficheSlug}', [FicheController::class, 'show'])->name('fiches.show');

// Avis sur une fiche
Route::post('/fiches/{id}/avis', [FicheController::class, 'avis'])->name('fiches.avis');

/*
|--------------------------------------------------------------------------
| Démarches et outils
|--------------------------------------------------------------------------
*/
Route::get('/demarches', [DemarcheController::class, 'index'])->name('demarches.index');
Route::get('/demarches/formulaires', [DemarcheController::class, 'formulaires'])->name('demarches.formulaires');
Route::get('/demarches/formulaires/{slug}/download', [DemarcheController::class, 'download'])->name('demarches.download');

// Services en ligne (E-Services)
Route::get('/eservices', [EServiceController::class, 'index'])->name('eservices.index');

/*
|--------------------------------------------------------------------------
| Annuaire de l'administration
|--------------------------------------------------------------------------
*/
Route::get('/annuaire', [AnnuaireController::class, 'index'])->name('annuaire.index');
Route::get('/annuaire/{slug}', [AnnuaireController::class, 'show'])->name('annuaire.show');

/*
|--------------------------------------------------------------------------
| Contact
|--------------------------------------------------------------------------
*/
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'envoyer'])->middleware('throttle:5,1')->name('contact.envoyer');

/*
|--------------------------------------------------------------------------
| Portail Entreprises
|--------------------------------------------------------------------------
*/
Route::prefix('entreprises')->name('entreprises.')->group(function () {
    Route::get('/', [EntrepriseController::class, 'index'])->name('index');
    Route::get('/comment-faire-si', [EntrepriseController::class, 'evenements'])->name('evenements');
    Route::get('/comment-faire-si/{slug}', [EntrepriseController::class, 'evenementShow'])->name('evenements.show');
    Route::get('/thematiques', [EntrepriseController::class, 'thematiques'])->name('thematiques');
    Route::get('/thematiques/{slug}', [EntrepriseController::class, 'thematiqueShow'])->name('thematiques.show');
    Route::get('/thematiques/{themeSlug}/{ficheSlug}', [EntrepriseController::class, 'ficheShow'])->name('fiches.show');
    Route::get('/annuaire', [EntrepriseController::class, 'annuaire'])->name('annuaire');
});

/*
|--------------------------------------------------------------------------
| Pages statiques
|--------------------------------------------------------------------------
*/
Route::get('/a-propos', fn() => view('pages.a-propos'))->name('a-propos');
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');
Route::get('/mentions-legales', fn() => view('pages.mentions-legales'))->name('mentions-legales');
Route::get('/accessibilite', fn() => view('pages.accessibilite'))->name('accessibilite');
Route::get('/plan-du-site', [HomeController::class, 'planDuSite'])->name('plan-du-site');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
