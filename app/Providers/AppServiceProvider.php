<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categorie;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        // Partager les catégories avec toutes les vues
        View::composer('layouts.app', function ($view) {
            $view->with('categoriesParticuliersNav', Categorie::particuliers()->racines()->orderBy('ordre')->limit(5)->get());
            $view->with('categoriesEntreprisesNav', Categorie::entreprises()->racines()->orderBy('ordre')->limit(5)->get());
        });
    }
}
