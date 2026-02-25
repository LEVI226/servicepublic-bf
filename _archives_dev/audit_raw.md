# RAW DATA FOR AUDIT

## 1.1 Arborescence (Models, Controllers, Migrations, Seeders, Views)
- Models: 12 fichiers
  - Article.php
  - Category.php
  - Document.php
  - Eservice.php
  - Faq.php
  - LifeEvent.php
  - Organisme.php
  - Page.php
  - Procedure.php
  - Region.php
  - Subcategory.php
  - User.php
- Controllers: 12 fichiers
  - ActualiteController.php
  - AnnuaireController.php
  - ContactController.php
  - Controller.php
  - DemarcheController.php
  - EServiceController.php
  - EntrepriseController.php
  - EvenementVieController.php
  - FicheController.php
  - HomeController.php
  - RechercheController.php
  - ThematiqueController.php
- Migrations: 13 fichiers
  - 0001_01_01_000001_create_users_table.php
  - 2026_02_19_190001_create_categories_table.php
  - 2026_02_19_190002_create_subcategories_table.php
  - 2026_02_19_190003_create_procedures_table.php
  - 2026_02_19_190004_create_eservices_table.php
  - 2026_02_19_190005_create_organismes_table.php
  - 2026_02_19_190006_create_articles_table.php
  - 2026_02_19_190007_create_life_events_table.php
  - 2026_02_19_190008_create_faqs_table.php
  - 2026_02_19_190009_create_pages_table.php
  - 2026_02_19_190010_create_documents_table.php
  - 2026_02_19_190011_create_life_event_procedure_table.php
  - 2026_02_20_150303_add_icon_to_procedures_table.php
- Seeders: 8 fichiers
  - ArticleSeeder.php
  - CategorySeeder.php
  - DatabaseSeeder.php
  - EserviceSeeder.php
  - LifeEventSeeder.php
  - OrganismeSeeder.php
  - ProcedureSeeder.php
  - UserSeeder.php
- Views: 38 fichiers
  - components\annuaire-banner.blade.php
  - components\cards\actualite.blade.php
  - components\cards\article.blade.php
  - components\cards\category.blade.php
  - components\cards\eservice.blade.php
  - components\cards\event.blade.php
  - components\cards\fiche.blade.php
  - components\cards\procedure.blade.php
  - components\cards\theme.blade.php
  - components\quick-info-row.blade.php
  - components\stats-bar.blade.php
  - components\ui\hero-banner.blade.php
  - components\ui\section.blade.php
  - layouts\app.blade.php
  - pages\a-propos.blade.php
  - pages\accessibilite.blade.php
  - pages\actualites\index.blade.php
  - pages\actualites\show.blade.php
  - pages\annuaire\index.blade.php
  - pages\annuaire\show.blade.php
  - pages\contact\index.blade.php
  - pages\demarches\formulaires.blade.php
  - pages\demarches\index.blade.php
  - pages\entreprises\evenements.blade.php
  - pages\entreprises\index.blade.php
  - pages\entreprises\thematique-show.blade.php
  - pages\entreprises\thematiques.blade.php
  - pages\eservices\index.blade.php
  - pages\evenements\index.blade.php
  - pages\evenements\show.blade.php
  - pages\faq.blade.php
  - pages\fiches\show.blade.php
  - pages\home\index.blade.php
  - pages\mentions-legales.blade.php
  - pages\plan-du-site.blade.php
  - pages\recherche\index.blade.php
  - pages\thematiques\index.blade.php
  - pages\thematiques\show.blade.php
- Filament: 34 fichiers
  - Resources\ArticleResource.php
  - Resources\ArticleResource\Pages\CreateArticle.php
  - Resources\ArticleResource\Pages\EditArticle.php
  - Resources\ArticleResource\Pages\ListArticles.php
  - Resources\CategoryResource.php
  - Resources\CategoryResource\Pages\CreateCategory.php
  - Resources\CategoryResource\Pages\EditCategory.php
  - Resources\CategoryResource\Pages\ListCategories.php
  - Resources\EserviceResource.php
  - Resources\EserviceResource\Pages\CreateEservice.php
  - Resources\EserviceResource\Pages\EditEservice.php
  - Resources\EserviceResource\Pages\ListEservices.php
  - Resources\LifeEventResource.php
  - Resources\LifeEventResource\Pages\CreateLifeEvent.php
  - Resources\LifeEventResource\Pages\EditLifeEvent.php
  - Resources\LifeEventResource\Pages\ListLifeEvents.php
  - Resources\OrganismeResource.php
  - Resources\OrganismeResource\Pages\CreateOrganisme.php
  - Resources\OrganismeResource\Pages\EditOrganisme.php
  - Resources\OrganismeResource\Pages\ListOrganismes.php
  - Resources\ProcedureResource.php
  - Resources\ProcedureResource\Pages\CreateProcedure.php
  - Resources\ProcedureResource\Pages\EditProcedure.php
  - Resources\ProcedureResource\Pages\ListProcedures.php
  - Resources\RegionResource.php
  - Resources\RegionResource\Pages\CreateRegion.php
  - Resources\RegionResource\Pages\EditRegion.php
  - Resources\RegionResource\Pages\ListRegions.php
  - Resources\UserResource.php
  - Resources\UserResource\Pages\CreateUser.php
  - Resources\UserResource\Pages\EditUser.php
  - Resources\UserResource\Pages\ListUsers.php
  - Widgets\ProceduresParCategorieChart.php
  - Widgets\StatsOverview.php
- Middleware: 2 fichiers
  - BlockDangerousHeaders.php
  - SecurityHeaders.php

## 3. Models Analysis
### Article.php
- fillable defined
### Category.php
- fillable defined
### Document.php
- fillable defined
### Eservice.php
- fillable defined
### Faq.php
- fillable defined
### LifeEvent.php
- fillable defined
### Organisme.php
- fillable defined
### Page.php
- fillable defined
### Procedure.php
- fillable defined
### Region.php
- fillable defined
### Subcategory.php
- fillable defined
### User.php
- fillable defined

## 4. Controller N+1 Check
- POTENTIAL N+1 in ActualiteController.php:25 : ->get();
- POTENTIAL N+1 in DemarcheController.php:16 : ->get();
- POTENTIAL N+1 in DemarcheController.php:21 : ->get();
- POTENTIAL N+1 in EntrepriseController.php:22 : ->get();
- POTENTIAL N+1 in EntrepriseController.php:40 : ->get();
- POTENTIAL N+1 in EntrepriseController.php:75 : $procedures = $lifeEvent->procedures()->active()->get();
- POTENTIAL N+1 in EvenementVieController.php:13 : ->get();
- POTENTIAL N+1 in EvenementVieController.php:25 : ->get();
- POTENTIAL N+1 in FicheController.php:23 : ->get();
- POTENTIAL N+1 in HomeController.php:19 : ->get();
- POTENTIAL N+1 in HomeController.php:25 : ->get();
- POTENTIAL N+1 in HomeController.php:31 : ->get();
- POTENTIAL N+1 in HomeController.php:36 : ->get();
- POTENTIAL N+1 in HomeController.php:41 : ->get();
- POTENTIAL N+1 in HomeController.php:52 : $lifeEvents = LifeEvent::active()->ordered()->get();
- POTENTIAL N+1 in HomeController.php:59 : $faqs = Faq::active()->orderBy('order')->get();
- POTENTIAL N+1 in RechercheController.php:27 : ->get()
- POTENTIAL N+1 in RechercheController.php:43 : ->get()
- POTENTIAL N+1 in RechercheController.php:57 : ->get()
- POTENTIAL N+1 in ThematiqueController.php:16 : ->get();
- POTENTIAL N+1 in ThematiqueController.php:29 : ->get();

## 8. Security
### app.php (Middleware Registration)
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
        $middleware->append(\App\Http\Middleware\BlockDangerousHeaders::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
