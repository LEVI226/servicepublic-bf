@extends('layouts.app')

@section('title', 'Résultats de recherche')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Recherche</li>
@endsection

@section('content')
<section class="section pt-5">
    <div class="container">
        <div class="mb-5">
            <h1 class="display-6 fw-bold mb-3">Résultats de recherche</h1>
            @if(request('q'))
                <p class="lead text-muted">Recherche pour : <span class="text-bf-vert fw-bold">"{{ request('q') }}"</span></p>
            @endif
        </div>

        <!-- Fiches -->
        @if($fiches->count() > 0)
        <div class="mb-5">
            <div class="d-flex align-items-center mb-4">
                <h3 class="h4 mb-0 fw-bold">Fiches de procédures</h3>
                <div class="ms-3 flex-grow-1 border-bottom"></div>
                <span class="badge bg-bf-vert ms-3">{{ $fiches->total() }}</span>
            </div>
            <div class="row g-4">
                @foreach($fiches as $fiche)
                <div class="col-md-6">
                    <div class="card card-fiche h-100 hover-shadow">
                        <div class="card-body">
                            <div class="mb-2">
                                <span class="badge badge-sp">{{ $fiche->categorie->type_label }}</span>
                            </div>
                            <h5 class="card-title">
                                <a href="{{ route($fiche->categorie->type === 'particulier' ? 'particuliers.fiche' : 'entreprises.fiche', ['categorieSlug' => $fiche->categorie->slug, 'ficheSlug' => $fiche->slug]) }}" class="text-decoration-none text-dark stretched-link">
                                    {{ $fiche->titre }}
                                </a>
                            </h5>
                            <p class="card-text text-muted small">{{ Str::limit($fiche->description, 120) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $fiches->appends(['q' => request('q')])->links() }}
            </div>
        </div>
        @endif

        <!-- E-Services -->
        @if($eservices->count() > 0)
        <div class="mb-5">
            <div class="d-flex align-items-center mb-4">
                <h3 class="h4 mb-0 fw-bold">Services en ligne</h3>
                <div class="ms-3 flex-grow-1 border-bottom"></div>
                <span class="badge bg-bf-vert ms-3">{{ $eservices->total() }}</span>
            </div>
            <div class="row g-4">
                @foreach($eservices as $eservice)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-eservice h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-bf-vert-pale rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-laptop text-bf-vert fs-4"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="card-title mb-0">{{ $eservice->nom }}</h5>
                                </div>
                            </div>
                            <p class="card-text text-muted small">{{ Str::limit($eservice->description, 100) }}</p>
                            <a href="{{ route('eservices.show', $eservice->slug) }}" class="btn btn-sm btn-primary mt-2">Accéder</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $eservices->appends(['q' => request('q')])->links() }}
            </div>
        </div>
        @endif

        <!-- Documents -->
        @if($documents->count() > 0)
        <div class="mb-5">
            <div class="d-flex align-items-center mb-4">
                <h3 class="h4 mb-0 fw-bold">Documents officiels</h3>
                <div class="ms-3 flex-grow-1 border-bottom"></div>
                <span class="badge bg-bf-vert ms-3">{{ $documents->total() }}</span>
            </div>
            <div class="list-group shadow-sm">
                @foreach($documents as $document)
                <a href="{{ route('documents.show', $document->slug) }}" class="list-group-item list-group-item-action py-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-file-earmark-pdf text-danger fs-3 me-3"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-medium">{{ $document->titre }}</h6>
                            <small class="text-muted">{{ $document->type_label }} - {{ $document->date_signature ? $document->date_signature->format('d/m/Y') : '' }}</small>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $documents->appends(['q' => request('q')])->links() }}
            </div>
        </div>
        @endif

        <!-- Structures -->
        @if($structures->count() > 0)
        <div class="mb-5">
            <div class="d-flex align-items-center mb-4">
                <h3 class="h4 mb-0 fw-bold">Structures et institutions</h3>
                <div class="ms-3 flex-grow-1 border-bottom"></div>
                <span class="badge bg-bf-vert ms-3">{{ $structures->total() }}</span>
            </div>
            <div class="row g-4">
                @foreach($structures as $structure)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 hover-shadow border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-3">
                                <div class="icon-box bg-light rounded text-bf-vert p-2 me-3">
                                    <i class="bi bi-building fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $structure->nom }}</h6>
                                    @if($structure->sigle)
                                        <small class="text-muted">{{ $structure->sigle }}</small>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('annuaire.structure', $structure->slug) }}" class="btn btn-sm btn-outline-primary w-100">Voir les détails</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $structures->appends(['q' => request('q')])->links() }}
            </div>
        </div>
        @endif

        <!-- No Results -->
        @if($fiches->count() === 0 && $eservices->count() === 0 && $documents->count() === 0 && $structures->count() === 0)
        <div class="text-center py-5">
            <i class="bi bi-search fs-1 text-muted mb-3 d-block"></i>
            <h4 class="text-muted">Aucun résultat trouvé</h4>
            <p class="text-muted">Essayez avec d'autres mots-clés ou consultez nos catégories.</p>
            <div class="mt-4">
                <a href="{{ route('particuliers.index') }}" class="btn btn-outline-primary me-2">Particuliers</a>
                <a href="{{ route('entreprises.index') }}" class="btn btn-outline-primary me-2">Entreprises</a>
                <a href="{{ route('eservices.index') }}" class="btn btn-outline-primary">E-Services</a>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
