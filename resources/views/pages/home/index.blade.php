@extends('layouts.app')

@section('content')
    <!-- 🌟 Hero Section -->
    <section class="hero text-center" style="background: white; padding: 100px 0 80px; position: relative; overflow: hidden;">
        <div class="container d-flex flex-column align-items-center">
            <span class="badge bg-soft text-bf-green mb-3 px-3 py-2 rounded-pill fw-bold">Site Officiel de l'Administration</span>
            <h1 class="mx-auto" style="max-width: 800px; font-size: 3.5rem; line-height: 1.15; margin-bottom: 24px; color: #111827;">Simplifiez votre quotidien administratif</h1>
            <p class="mx-auto" style="font-size: 1.25rem; color: #4B5563; margin-bottom: 40px; max-width: 600px;">Découvrez un accès centralisé à toutes les informations, démarches et services de l'administration burkinabè.</p>
            
            <form action="{{ route('recherche') }}" method="GET" class="search-wrapper mx-auto" style="width: 100%; max-width: 600px;">
                <input type="text" name="q" placeholder="Rechercher une démarche, un service, un organisme..." aria-label="Recherche">
                <button type="submit">Rechercher</button>
            </form>
            
            <div class="mt-4 gap-2 d-flex flex-wrap justify-content-center align-items-center">
                <small class="text-muted fw-bold me-2">Suggestions :</small>
                <a href="{{ route('recherche', ['q' => 'passeport']) }}" class="badge bg-light border text-muted rounded-pill text-decoration-none px-3 py-2">Passeport</a>
                <a href="{{ route('recherche', ['q' => 'CNIB']) }}" class="badge bg-light border text-muted rounded-pill text-decoration-none px-3 py-2">CNIB</a>
                <a href="{{ route('recherche', ['q' => 'casier judiciaire']) }}" class="badge bg-light border text-muted rounded-pill text-decoration-none px-3 py-2">Casier judiciaire</a>
            </div>
        </div>
    </section>

    <!-- 📊 Stats Bar -->
    <x-stats-bar />

    <!-- 📂 Catégories (Navigation Principale) -->
    <section class="section-padding bg-soft">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-md-8">
                    <h2 class="mb-2">Explorez par thématique</h2>
                    <p class="text-muted mb-0">Retrouvez toutes les fiches pratiques classées par grande catégorie</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('thematiques.index') }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold">Tout explorer</a>
                </div>
            </div>

            <!-- Grille de 4 colonnes (col-lg-3 = 12/4) -->
            <div class="row g-4 d-flex justify-content-center">
                @forelse($categories as $category)
                    <div class="col-md-6 col-lg-3">
                        <x-cards.category :category="$category" />
                    </div>
                @empty
                    <p class="text-muted">Aucune catégorie.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 👋 Événements de vie (Navigation secondaire) -->
    <section class="section-padding">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Comment faire si...</h2>
                <p class="text-muted">Des guides complets étape par étape pour vos événements de vie majeurs</p>
            </div>
            
            <div class="grid-events">
                @forelse($lifeEvents as $event)
                    <x-cards.event :event="$event" />
                @empty
                    <p class="text-center text-muted">Bientôt disponible.</p>
                @endforelse
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('evenements.index') }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold">Voir tous les guides</a>
            </div>
        </div>
    </section>

    <!-- ⭐ Services Rapides -->
    <section class="section-padding section-alt bg-soft">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <h2 class="mb-2">Services les plus consultés</h2>
                    <p class="text-muted mb-0">Les démarches préférées par les usagers cette semaine</p>
                </div>
            </div>
            <div class="row g-4 d-flex justify-content-center">
                @forelse($procedures as $procedure)
                    <!-- Adapté à 3 colonnes pour les cards populaires -->
                    <div class="col-md-6 col-lg-4">
                        <x-cards.procedure :procedure="$procedure" />
                    </div>
                @empty
                    <p class="text-muted">Aucun service populaire.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 📰 Actualités -->
    <section class="section-padding">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2>Actualités Gouvernementales</h2>
                <a href="{{ route('actualites.index') }}" class="fw-bold text-dark text-decoration-none border-bottom border-dark border-2 pb-1">Toutes les actualités</a>
            </div>
            <div class="row g-4">
                @forelse($articles as $article)
                    <div class="col-md-4">
                        <x-cards.article :article="$article" />
                    </div>
                @empty
                    <p class="text-muted">Aucune actualité.</p>
                @endforelse
            </div>
            
            <!-- Bannière Annuaire (Appel à l'action final) -->
            <x-annuaire-banner />
            
        </div>
    </section>

    <!-- 💌 Newsletter -->
    <div class="container mb-5">
        <div class="newsletter-section bg-dark text-white rounded-4 overflow-hidden position-relative">
            <!-- Ajout d'une superposition sombre pour un effet plus pro -->
            <div class="newsletter-inner position-relative z-1 p-5 text-center">
                <h2 class="h2 text-white mb-3" style="font-family: var(--font-heading);">Ne manquez aucune info officielle !</h2>
                <p class="text-white-50 mb-4 mx-auto" style="max-width: 600px;">Recevez l'essentiel des actualités et des nouvelles procédures de l'administration burkinabè chaque mois directement dans votre boîte mail.</p>
                <form class="d-flex gap-2 justify-content-center flex-wrap" action="#" method="POST">
                    @csrf
                    <input type="email" name="email" class="form-control w-auto px-4 py-3 rounded-pill border-0 newsletter-input shadow-sm" placeholder="Votre adresse email" required>
                    <!-- Bouton en style dark/institutional au lieu de warning flash -->
                    <button class="btn btn-secondary px-4 py-3 rounded-pill fw-bold bg-white text-dark shadow-sm">Je m'abonne</button>
                </form>
                <div class="mt-3 text-white-50 small">Votre email ne sera pas partagé avec des tiers.</div>
            </div>
        </div>
    </div>
@endsection
