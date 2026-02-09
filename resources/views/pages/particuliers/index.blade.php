@extends('layouts.app')

@section('title', 'Services aux Particuliers')

@section('breadcrumb')
    <li class="breadcrumb-item active">Particuliers</li>
@endsection

@section('content')
    <!-- Hero -->
    <section class="hero" style="padding: 4rem 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1>Services aux Particuliers</h1>
                    <p class="lead">Toutes les démarches administratives pour les citoyens burkinabè.</p>
                </div>
                <div class="col-lg-4 text-end">
                    <i class="bi bi-people" style="font-size: 8rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Catégories -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Catégories de services</h2>
                <p class="subtitle">Choisissez une catégorie pour trouver votre démarche</p>
                <div class="barre"></div>
            </div>

            <div class="row g-4">
                @foreach($categories as $categorie)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('particuliers.categorie', $categorie->slug) }}" class="card card-categorie text-decoration-none h-100">
                            <div class="icone">
                                <i class="bi bi-{{ $categorie->icone ?? 'folder' }}"></i>
                            </div>
                            <h3 class="titre">{{ $categorie->nom }}</h3>
                            <p class="description">{{ Str::limit($categorie->description, 100) }}</p>
                            <span class="badge badge-particulier mt-2">
                                {{ $categorie->fiches_count }} fiche{{ $categorie->fiches_count > 1 ? 's' : '' }}
                            </span>
                            <span class="text-bf-vert fw-medium mt-auto pt-3">
                                Explorer <i class="bi bi-arrow-right ms-1"></i>
                            </span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Fiches populaires -->
    @if($fichesPopulaires->count() > 0)
        <section class="section section-colored">
            <div class="container">
                <div class="section-title">
                    <h2>Fiches pratiques populaires</h2>
                    <p class="subtitle">Les démarches les plus consultées par les citoyens</p>
                    <div class="barre"></div>
                </div>

                <div class="row g-4">
                    @foreach($fichesPopulaires as $fiche)
                        <div class="col-md-6 col-lg-4">
                            <div class="card card-fiche h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $fiche->titre }}</h5>
                                    <div class="meta">
                                        <span><i class="bi bi-clock"></i> {{ $fiche->duree_traitement }} jours</span>
                                        <span><i class="bi bi-cash"></i> {{ number_format($fiche->cout, 0, ',', ' ') }} FCFA</span>
                                    </div>
                                    <p class="card-text text-muted">{{ Str::limit($fiche->description, 100) }}</p>
                                    <a href="{{ route('particuliers.fiche', [$fiche->categorie->slug, $fiche->slug]) }}" class="btn btn-outline-primary btn-sm">
                                        Consulter <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Contact -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2>Besoin d\'aide ?</h2>
                    <p class="lead text-muted">Notre équipe est à votre disposition pour vous accompagner dans vos démarches.</p>
                    <div class="d-flex flex-column gap-3 mt-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-bf-vert-pale rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-telephone text-bf-vert fs-4"></i>
                            </div>
                            <div>
                                <div class="fw-medium">Téléphone</div>
                                <a href="tel:+22625306630" class="text-muted">(+226) 25 30 66 30</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="bg-bf-vert-pale rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-envelope text-bf-vert fs-4"></i>
                            </div>
                            <div>
                                <div class="fw-medium">Email</div>
                                <a href="mailto:contact@servicepublic.gov.bf" class="text-muted">contact@servicepublic.gov.bf</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Conseil :</strong> Avant de vous déplacer, vérifiez les documents requis et les horaires d\'ouverture du service concerné.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
