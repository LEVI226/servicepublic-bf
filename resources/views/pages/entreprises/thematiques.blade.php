@extends('layouts.app')
@section('title', $metaTitle ?? 'Thématiques Entreprises')

@section('content')
    <x-ui.hero-banner 
        title="Thématiques Professionnelles" 
        subtitle="Explorez toutes les fiches pratiques classées par secteur d'activité." 
    />

    <nav aria-label="breadcrumb" class="bg-light py-3 border-bottom mb-5">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('entreprises.index') }}">Espace Entreprises</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thématiques</li>
            </ol>
        </div>
    </nav>

    <div class="container section-padding pt-0">
        <div class="row g-4">
            @forelse($categories as $category)
                <div class="col-md-6 col-lg-4">
                    <x-cards.category :category="$category" routeName="entreprises.thematiques.show" />
                </div>
            @empty
                <div class="col-12 py-5 text-center">
                    <p class="text-muted">Aucune thématique professionnelle disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection