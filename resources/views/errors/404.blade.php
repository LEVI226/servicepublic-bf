@extends('layouts.app')

@section('title', 'Page non trouvée (404)')

@section('content')
    <div class="container section-padding">
        <div class="row justify-content-center py-5">
            <div class="col-lg-6 text-center">
                <div class="mb-4">
                    <x-heroicon-o-exclamation-triangle class="w-24 h-24 text-bf-red mx-auto opacity-75" />
                </div>
                
                <h1 class="display-4 fw-bold mb-3" style="font-family: var(--font-heading);">404</h1>
                <h2 class="h3 fw-bold mb-4">Oups ! Page non trouvée</h2>
                
                <p class="text-muted fs-5 mb-5">
                    Désolé, la page que vous recherchez semble avoir été déplacée, supprimée ou n'existe plus.
                </p>

                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                    <a href="{{ route('home') }}" class="btn-sp btn-sp-primary px-4">
                        <x-heroicon-o-home class="w-5 h-5 me-1 inline-block align-text-bottom" /> Retour à l'accueil
                    </a>
                    <a href="{{ route('recherche') }}" class="btn btn-outline-dark rounded-pill px-4">
                        <x-heroicon-o-magnifying-glass class="w-5 h-5 me-1 inline-block align-text-bottom" /> Rechercher une démarche
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <x-heroicon-o-envelope class="w-5 h-5 me-1 inline-block align-text-bottom" /> Nous contacter
                    </a>
                </div>

                <div class="mt-5 pt-4 border-top">
                    <p class="text-muted small">
                        Si vous pensez qu'il s'agit d'une erreur technique, merci de nous le signaler via le formulaire de contact.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
