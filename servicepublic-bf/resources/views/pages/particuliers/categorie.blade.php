@extends('layouts.app')

@section('title', $categorie->nom)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('particuliers.index') }}">Particuliers</a></li>
    @if($categorie->parent)
        <li class="breadcrumb-item"><a href="{{ route('particuliers.categorie', $categorie->parent->slug) }}">{{ $categorie->parent->nom }}</a></li>
    @endif
    <li class="breadcrumb-item active">{{ $categorie->nom }}</li>
@endsection

@section('content')
    <!-- Header -->
    <section class="section" style="padding-top: 2rem;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1>{{ $categorie->nom }}</h1>
                    <p class="lead text-muted">{{ $categorie->description }}</p>
                </div>
                <div class="col-lg-4 text-end">
                    <i class="bi bi-{{ $categorie->icone ?? 'folder' }} text-bf-vert" style="font-size: 6rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Sous-catégories -->
    @if($categorie->enfants->count() > 0)
        <section class="section section-colored" style="padding: 2rem 0;">
            <div class="container">
                <h5 class="mb-3">Sous-catégories</h5>
                <div class="row g-3">
                    @foreach($categorie->enfants as $enfant)
                        <div class="col-md-4 col-lg-3">
                            <a href="{{ route('particuliers.categorie', $enfant->slug) }}" class="btn btn-outline-primary w-100 text-start">
                                <i class="bi bi-{{ $enfant->icone ?? 'folder' }} me-2"></i> {{ $enfant->nom }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Fiches -->
    <section class="section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Fiches pratiques</h2>
                <span class="text-muted">{{ $fiches->total() }} résultat{{ $fiches->total() > 1 ? 's' : '' }}</span>
            </div>

            @if($fiches->count() > 0)
                <div class="row g-4">
                    @foreach($fiches as $fiche)
                        <div class="col-md-6 col-lg-4">
                            <div class="card card-fiche h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $fiche->titre }}</h5>
                                    <div class="meta">
                                        @if($fiche->duree_traitement)
                                            <span><i class="bi bi-clock"></i> {{ $fiche->duree_traitement }} jours</span>
                                        @endif
                                        @if($fiche->cout)
                                            <span><i class="bi bi-cash"></i> {{ number_format($fiche->cout, 0, ',', ' ') }} FCFA</span>
                                        @endif
                                    </div>
                                    <p class="card-text text-muted">{{ Str::limit($fiche->description, 100) }}</p>
                                    <a href="{{ route('particuliers.fiche', [$categorie->slug, $fiche->slug]) }}" class="btn btn-outline-primary btn-sm">
                                        Consulter <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $fiches->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Aucune fiche pratique disponible dans cette catégorie pour le moment.
                </div>
            @endif
        </div>
    </section>
@endsection
