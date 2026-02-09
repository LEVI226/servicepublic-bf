@extends('layouts.app')

@section('title', $categorie->nom)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('entreprises.index') }}">Entreprises</a></li>
    @if($categorie->parent)
        <li class="breadcrumb-item"><a href="{{ route('entreprises.categorie', $categorie->parent->slug) }}">{{ $categorie->parent->nom }}</a></li>
    @endif
    <li class="breadcrumb-item active" aria-current="page">{{ $categorie->nom }}</li>
@endsection

@section('content')
<!-- Category Header -->
<div class="bg-bf-rouge-pale py-5 mb-5 border-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <span class="badge badge-entreprise mb-3">ENTREPRISES</span>
                <h1 class="display-5 fw-bold text-gray-900 mb-3">{{ $categorie->nom }}</h1>
                <p class="lead text-gray-600 mb-0">{{ $categorie->description }}</p>
            </div>
            <div class="col-md-4 text-md-end d-none d-md-block">
                <div class="icone-xl text-bf-rouge opacity-25" style="font-size: 8rem;">
                    <i class="bi bi-{{ $categorie->icone ?? 'building' }}"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row">
        <!-- Subcategories Sidebar -->
        @if($categorie->enfants->count() > 0)
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom fw-bold text-uppercase small py-3">
                    Sous-catégories
                </div>
                <div class="list-group list-group-flush">
                    @foreach($categorie->enfants as $child)
                    <a href="{{ route('entreprises.categorie', $child->slug) }}" class="list-group-item list-group-item-action py-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-chevron-right small me-2 text-bf-rouge"></i>
                            {{ $child->nom }}
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Fiches (Procedures) -->
        <div class="{{ $categorie->enfants->count() > 0 ? 'col-md-9' : 'col-md-12' }}">
            <div class="d-flex align-items-center mb-4">
                <h2 class="h4 mb-0">Démarches et services disponibles</h2>
                <div class="ms-3 flex-grow-1 border-bottom"></div>
            </div>
            
            <div class="row g-4">
                @forelse($fiches as $fiche)
                <div class="col-md-6">
                    <div class="card h-100 card-fiche hover-shadow">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('entreprises.fiche', ['categorieSlug' => $categorie->slug, 'ficheSlug' => $fiche->slug]) }}" class="text-decoration-none text-dark stretched-link">
                                    {{ $fiche->titre }}
                                </a>
                            </h5>
                            <p class="card-text text-muted mb-4">{{ Str::limit($fiche->description, 100) }}</p>
                            
                            <div class="meta text-muted small mt-auto">
                                <span><i class="bi bi-eye"></i> {{ $fiche->vues }} vues</span>
                                <span><i class="bi bi-calendar"></i> Mis à jour le {{ $fiche->updated_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info border-bf-rouge-pale bg-bf-rouge-pale text-bf-rouge-dark">
                        <i class="bi bi-info-circle me-2"></i> Aucune fiche de procédure disponible dans cette catégorie pour le moment.
                    </div>
                </div>
                @endforelse
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $fiches->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
