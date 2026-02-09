@extends('layouts.app')

@section('title', $fiche->titre)

@section('meta_description', Str::limit($fiche->description, 160))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('particuliers.index') }}">Particuliers</a></li>
    @if($categorie->parent)
        <li class="breadcrumb-item"><a href="{{ route('particuliers.categorie', $categorie->parent->slug) }}">{{ $categorie->parent->nom }}</a></li>
    @endif
    <li class="breadcrumb-item"><a href="{{ route('particuliers.categorie', $categorie->slug) }}">{{ $categorie->nom }}</a></li>
    <li class="breadcrumb-item active">{{ $fiche->titre }}</li>
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Contenu principal -->
            <div class="col-lg-8">
                <h1>{{ $fiche->titre }}</h1>
                <p class="lead text-muted">{{ $fiche->description }}</p>

                <!-- Informations clés -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-3">
                            @if($fiche->duree_traitement)
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-bf-vert-pale rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="bi bi-clock text-bf-vert fs-4"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small">Durée</div>
                                            <div class="fw-bold">{{ $fiche->duree_traitement }} jours</div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($fiche->cout)
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-bf-vert-pale rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="bi bi-cash text-bf-vert fs-4"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small">Coût</div>
                                            <div class="fw-bold">{{ number_format($fiche->cout, 0, ',', ' ') }} FCFA</div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-bf-vert-pale rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="bi bi-eye text-bf-vert fs-4"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">Consultations</div>
                                        <div class="fw-bold">{{ $fiche->vues }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenu -->
                <div class="card">
                    <div class="card-body">
                        {!! $fiche->contenu !!}
                    </div>
                </div>

                <!-- Partager -->
                <div class="mt-4">
                    <h5>Partager cette fiche</h5>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-outline-primary">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($fiche->titre) }}" target="_blank" class="btn btn-outline-info">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($fiche->titre . ' ' . request()->url()) }}" target="_blank" class="btn btn-outline-success">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <button onclick="navigator.clipboard.writeText(window.location.href)" class="btn btn-outline-secondary">
                            <i class="bi bi-link-45deg"></i> Copier le lien
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Actions -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Actions</h5>
                        <div class="d-grid gap-2">
                            <a href="{{ route('suivi') }}" class="btn btn-primary">
                                <i class="bi bi-truck me-2"></i> Suivre ma demande
                            </a>
                            <a href="{{ route('faq') }}" class="btn btn-outline-primary">
                                <i class="bi bi-question-circle me-2"></i> Consulter la FAQ
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                @if($fiche->contact || $fiche->lieu)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Informations de contact</h5>
                            @if($fiche->contact)
                                <p class="mb-2">
                                    <i class="bi bi-telephone me-2 text-bf-vert"></i> {{ $fiche->contact }}
                                </p>
                            @endif
                            @if($fiche->lieu)
                                <p class="mb-0">
                                    <i class="bi bi-geo-alt me-2 text-bf-vert"></i> {{ $fiche->lieu }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Fiches similaires -->
                @if($fichesSimilaires->count() > 0)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Fiches similaires</h5>
                            <div class="list-group list-group-flush">
                                @foreach($fichesSimilaires as $similaire)
                                    <a href="{{ route('particuliers.fiche', [$categorie->slug, $similaire->slug]) }}" class="list-group-item list-group-item-action px-0">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">{{ $similaire->titre }}</h6>
                                        </div>
                                        <small class="text-muted">{{ Str::limit($similaire->description, 60) }}</small>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
