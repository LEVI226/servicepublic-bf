@extends('layouts.app')
@section('title', 'Plan du site')

@section('content')
    <x-ui.hero-banner 
        title="Plan du site" 
        subtitle="Vue d'ensemble de l'architecture du portail Service Public BF" 
    />

    <div class="container section-padding pt-5">
        <div class="row g-5">
            
            <div class="col-md-6">
                <h2 class="h4 text-bf-green mb-4 border-bottom pb-2">Rubriques principales</h2>
                <ul class="list-unstyled ms-3">
                    <li class="mb-3"><a href="{{ route('home') }}" class="fw-bold text-dark text-decoration-none">Accueil</a></li>
                    <li class="mb-3"><a href="{{ route('actualites.index') }}" class="fw-bold text-dark text-decoration-none">Actualités</a></li>
                    <li class="mb-3"><a href="{{ route('demarches.formulaires') }}" class="fw-bold text-dark text-decoration-none">Formulaires administratifs</a></li>
                    <li class="mb-3"><a href="{{ route('eservices.index') }}" class="fw-bold text-dark text-decoration-none">Services en ligne (E-services)</a></li>
                    <li class="mb-3"><a href="{{ route('annuaire.index') }}" class="fw-bold text-dark text-decoration-none">Annuaire de l'administration</a></li>
                    <li class="mb-3"><a href="{{ route('faq') }}" class="fw-bold text-dark text-decoration-none">Foire aux questions (FAQ)</a></li>
                    <li class="mb-3"><a href="{{ route('contact') }}" class="fw-bold text-dark text-decoration-none">Contact / Assistance</a></li>
                </ul>

                <h2 class="h4 text-bf-green mb-4 mt-5 border-bottom pb-2">Comment faire si...</h2>
                <ul class="list-unstyled ms-3">
                    <li class="mb-3"><a href="{{ route('evenements.index') }}" class="fw-bold text-dark text-decoration-none">Tous les thèmes de vie</a></li>
                    @foreach($lifeEvents as $event)
                        <li class="mb-2 ms-4 d-flex align-items-center gap-2">
                            <i class="{{ $event->icon ?? 'bi bi-dash' }} text-muted small"></i>
                            <a href="{{ route('evenements.show', $event->slug) }}" class="text-muted text-decoration-none hover-text-primary">{{ $event->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-6">
                <h2 class="h4 text-bf-green mb-4 border-bottom pb-2">Fiches Pratiques par Thématique</h2>
                <ul class="list-unstyled ms-3">
                    <li class="mb-3"><a href="{{ route('thematiques.index') }}" class="fw-bold text-dark text-decoration-none">Toutes les thématiques</a></li>
                    @foreach($categories as $category)
                        <li class="mb-4">
                            <a href="{{ route('thematiques.show', $category->slug) }}" class="fw-bold text-dark text-decoration-none mb-2 d-block">
                                {{ $category->name }}
                            </a>
                            @if($category->subcategories && $category->subcategories->count() > 0)
                                <ul class="list-unstyled ms-4">
                                    @foreach($category->subcategories as $subcat)
                                        <li class="mb-1 text-muted small">
                                            <i class="bi bi-chevron-right me-1 text-light"></i> {{ $subcat->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
@endsection
