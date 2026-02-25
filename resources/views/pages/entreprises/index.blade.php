@extends('layouts.app')
@section('title', 'Portail Entreprises')

@section('content')
    <x-ui.hero-banner
        title="Portail Entreprises"
        subtitle="Toutes les démarches pour créer, gérer et développer votre entreprise au Burkina Faso."
    >
        <div class="mt-4 pb-2">
            <span class="badge bg-white text-dark mb-3 px-3 py-2 rounded-pill fw-bold shadow-sm d-inline-flex align-items-center border"><i class="bi bi-briefcase-fill text-success me-2"></i>Espace Professionnels</span>
            <form action="{{ route('recherche') }}" method="GET" class="search-wrapper bg-white p-2 rounded-pill d-flex shadow-sm mx-auto" style="max-width: 600px; border: 1px solid #dee2e6;">
                <i class="bi bi-search text-muted ms-3 d-flex align-items-center"></i>
                <input type="text" name="q" class="form-control border-0 shadow-none px-3 bg-transparent" placeholder="Rechercher une démarche entreprise..." aria-label="Recherche">
                <button class="btn btn-dark rounded-pill px-4 fw-bold shadow-sm" type="submit">Rechercher</button>
            </form>
        </div>
    </x-ui.hero-banner>
    <!-- 🌟 Démarches Populaires B2B -->
    <section class="section-padding bg-soft">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h2 class="mb-2 fw-bold text-dark">Démarches les plus demandées</h2>
                    <p class="text-muted mb-0">Les procédures les plus consultées par les professionnels</p>
                </div>
            </div>
            
            <div class="row g-4 justify-content-center">
                @forelse($popularProcedures as $procedure)
                    <div class="col-md-6 col-lg-4">
                        <x-cards.procedure :procedure="$procedure" />
                    </div>
                @empty
                    <p class="text-muted">Aucune démarche populaire.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 📂 Catégories B2B -->
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-md-8">
                    <h2 class="mb-2 fw-bold text-dark">Thématiques Professionnelles</h2>
                    <p class="text-muted mb-0">Découvrez les secteurs et procédures dédiées au monde des affaires</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('entreprises.thematiques') }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold">Tout explorer</a>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                @forelse($categories as $category)
                    <div class="col-md-6 col-lg-4">
                        <x-cards.category :category="$category" routeName="entreprises.thematiques.show" />
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-briefcase text-muted fs-1 mb-3 d-block"></i>
                        <p class="text-muted">Les thématiques dédiées aux entreprises sont en cours de mise à jour.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 👋 Événements de vie B2B -->
    @if($lifeEvents->isNotEmpty())
    <section class="section-padding bg-soft">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold text-dark">Événements de vie entreprise</h2>
                <p class="text-muted">Des guides complets étape par étape pour le cycle de vie de votre société</p>
            </div>
            
            <div class="grid-events">
                @foreach($lifeEvents as $event)
                    <x-cards.event :event="$event" />
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- 💻 E-services B2B -->
    @if($eservices->isNotEmpty())
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-md-8">
                    <h2 class="mb-2 fw-bold text-dark">E-services pour les professionnels</h2>
                    <p class="text-muted mb-0">Accédez directement aux plateformes (CEFORE, eSINTAX, etc.)</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('eservices.index') }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold">Tous les services en ligne</a>
                </div>
            </div>

            <div class="row g-4">
                @foreach($eservices as $service)
                    <div class="col-md-6 col-lg-4">
                        <x-cards.eservice :service="$service" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- 🏢 Appui aux entreprises (Annuaire) -->
    <section class="section-padding bg-soft">
        <div class="container">
            <div class="card-premium bg-white border-0 shadow-sm overflow-hidden rounded-4">
                <div class="row g-0 align-items-center">
                    <div class="col-lg-8 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="bi bi-building fs-3"></i>
                        </div>
                        <h2 class="h3 fw-bold text-dark mb-3">Annuaire des structures d'appui</h2>
                        <p class="text-muted lead mb-4">Trouvez rapidement les coordonnées des Chambres de Commerce, CEFORE, ministères de tutelle et agences de promotion des investissements.</p>
                        <a href="{{ route('annuaire.index') }}" class="btn btn-primary rounded-pill px-4 py-3 fw-bold shadow-sm">Rechercher un organisme <i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                    <div class="col-lg-4 d-none d-lg-flex bg-light align-items-center justify-content-center h-100 p-5" style="min-height: 400px; border-left: 1px solid rgba(0,0,0,0.05);">
                        <i class="bi bi-map text-primary opacity-25" style="font-size: 10rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection