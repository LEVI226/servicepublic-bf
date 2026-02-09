@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1>Les services publics à votre portée</h1>
                    <p class="lead">Accédez aux démarches administratives, e-services et informations des ministères et institutions du Burkina Faso.</p>
                    
                    <!-- Barre de recherche -->
                    <form action="{{ route('recherche') }}" method="GET" class="recherche-hero mb-4">
                        <input type="text" name="q" placeholder="Rechercher une démarche, un service, un document..." required>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-search me-2"></i> Rechercher
                        </button>
                    </form>
                    
                    <!-- Liens rapides -->
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('eservices.index') }}" class="btn btn-outline-light">
                            <i class="bi bi-laptop me-2"></i> E-Services
                        </a>
                        <a href="{{ route('suivi') }}" class="btn btn-outline-light">
                            <i class="bi bi-truck me-2"></i> Suivre ma demande
                        </a>
                        <a href="{{ route('annuaire.index') }}" class="btn btn-outline-light">
                            <i class="bi bi-building-gear me-2"></i> Annuaire
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <img src="{{ asset('images/illustration-hero.svg') }}" alt="Services publics" class="img-fluid" style="max-height: 400px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Accès rapide -->
    <div class="container">
        <div class="acces-rapide">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <a href="{{ route('particuliers.index') }}" class="item text-decoration-none d-block">
                        <div class="icone">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="titre">Particuliers</div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('entreprises.index') }}" class="item text-decoration-none d-block">
                        <div class="icone">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="titre">Entreprises</div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('documents.index') }}" class="item text-decoration-none d-block">
                        <div class="icone">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div class="titre">Documents</div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('faq') }}" class="item text-decoration-none d-block">
                        <div class="icone">
                            <i class="bi bi-question-circle"></i>
                        </div>
                        <div class="titre">FAQ</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Services aux particuliers -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Services aux Particuliers</h2>
                <p class="subtitle">Les démarches administratives les plus demandées</p>
                <div class="barre"></div>
            </div>
            
            <div class="row g-4">
                @foreach($categoriesParticuliers as $categorie)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('particuliers.categorie', $categorie->slug) }}" class="card card-categorie text-decoration-none h-100">
                            <div class="icone">
                                <i class="bi bi-{{ $categorie->icone ?? 'folder' }}"></i>
                            </div>
                            <h3 class="titre">{{ $categorie->nom }}</h3>
                            <p class="description">{{ Str::limit($categorie->description, 100) }}</p>
                            <span class="text-bf-vert fw-medium mt-auto">
                                Explorer <i class="bi bi-arrow-right ms-1"></i>
                            </span>
                        </a>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('particuliers.index') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-grid me-2"></i> Voir tous les services particuliers
                </a>
            </div>
        </div>
    </section>

    <!-- Services aux entreprises -->
    <section class="section section-colored">
        <div class="container">
            <div class="section-title">
                <h2>Services aux Entreprises</h2>
                <p class="subtitle">Facilitez vos démarches administratives professionnelles</p>
                <div class="barre"></div>
            </div>
            
            <div class="row g-4">
                @foreach($categoriesEntreprises as $categorie)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('entreprises.categorie', $categorie->slug) }}" class="card card-categorie text-decoration-none h-100">
                            <div class="icone" style="background: var(--bf-rouge-pale); color: var(--bf-rouge);">
                                <i class="bi bi-{{ $categorie->icone ?? 'building' }}"></i>
                            </div>
                            <h3 class="titre">{{ $categorie->nom }}</h3>
                            <p class="description">{{ Str::limit($categorie->description, 100) }}</p>
                            <span class="text-bf-rouge fw-medium mt-auto">
                                Explorer <i class="bi bi-arrow-right ms-1"></i>
                            </span>
                        </a>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('entreprises.index') }}" class="btn btn-secondary btn-lg">
                    <i class="bi bi-building me-2"></i> Voir tous les services entreprises
                </a>
            </div>
        </div>
    </section>

    <!-- E-Services -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>E-Services</h2>
                <p class="subtitle">Effectuez vos démarches en ligne, 24h/24 et 7j/7</p>
                <div class="barre"></div>
            </div>
            
            <div class="row g-4">
                @foreach($eservices as $eservice)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-eservice h-100 {{ $eservice->en_ligne ? 'en-ligne' : '' }}">
                            @if($eservice->en_ligne)
                                <span class="badge-en-ligne">EN LIGNE</span>
                            @endif
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="bg-bf-vert-pale rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="bi bi-{{ $eservice->icone ?? 'laptop' }} text-bf-vert fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="card-title mb-0">{{ $eservice->nom }}</h5>
                                        <small class="text-muted">{{ $eservice->structure->nom ?? 'Service Public' }}</small>
                                    </div>
                                </div>
                                <p class="card-text text-muted">{{ Str::limit($eservice->description, 120) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    @if($eservice->duree_traitement)
                                        <small class="text-muted">
                                            <i class="bi bi-clock me-1"></i> {{ $eservice->duree_traitement }} jours
                                        </small>
                                    @else
                                        <span></span>
                                    @endif
                                    <a href="{{ route('eservices.show', $eservice->slug) }}" class="btn btn-sm btn-primary">
                                        Accéder <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('eservices.index') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-laptop me-2"></i> Tous les E-Services
                </a>
            </div>
        </div>
    </section>

    <!-- Documents récents -->
    <section class="section section-colored">
        <div class="container">
            <div class="section-title">
                <h2>Documents Officiels</h2>
                <p class="subtitle">Lois, décrets, arrêtés et autres textes officiels</p>
                <div class="barre"></div>
            </div>
            
            <div class="row g-4">
                @foreach($documents as $document)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-document h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="bg-danger bg-opacity-10 rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="bi bi-file-earmark-pdf text-danger fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <span class="badge badge-sp mb-2">{{ $document->type_label }}</span>
                                        <h5 class="card-title mb-1">{{ $document->titre }}</h5>
                                        <small class="text-muted">
                                            @if($document->numero)
                                                N° {{ $document->numero }}
                                            @endif
                                            @if($document->date_signature)
                                                | {{ $document->date_signature->format('d/m/Y') }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <p class="card-text text-muted small">{{ Str::limit($document->description, 80) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-download me-1"></i> {{ $document->telechargements }} téléchargements
                                    </small>
                                    <a href="{{ route('documents.download', $document->slug) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-download"></i> Télécharger
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('documents.index') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-file-earmark-text me-2"></i> Tous les documents
                </a>
            </div>
        </div>
    </section>

    <!-- Actualités -->
    @if($actualites->count() > 0)
        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h2>Actualités</h2>
                    <p class="subtitle">Les dernières informations du service public</p>
                    <div class="barre"></div>
                </div>
                
                <div class="row g-4">
                    @foreach($actualites as $actualite)
                        <div class="col-md-6 col-lg-4">
                            <article class="card h-100">
                                @if($actualite->image)
                                    <img src="{{ asset('storage/' . $actualite->image) }}" class="card-img-top" alt="{{ $actualite->titre }}" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <span class="badge badge-sp mb-2">{{ $actualite->type_label }}</span>
                                    <h5 class="card-title">{{ $actualite->titre }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($actualite->resume, 120) }}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <small class="text-muted">
                                            <i class="bi bi-calendar me-1"></i> {{ $actualite->date_publication?->format('d/m/Y') }}
                                        </small>
                                        <a href="{{ route('actualites.show', $actualite->slug) }}" class="btn btn-sm btn-outline-primary">
                                            Lire la suite
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Statistiques -->
    <section class="stats">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-nombre">{{ $stats['services'] ?? '50+' }}</div>
                        <div class="stat-label">Services en ligne</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-nombre">{{ $stats['demandes'] ?? '10K+' }}</div>
                        <div class="stat-label">Demandes traitées</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-nombre">{{ $stats['structures'] ?? '30+' }}</div>
                        <div class="stat-label">Structures référencées</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-nombre">{{ $stats['documents'] ?? '500+' }}</div>
                        <div class="stat-label">Documents disponibles</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter / Contact -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2>Besoin d'aide ?</h2>
                    <p class="lead text-muted">Notre équipe est à votre disposition pour vous accompagner dans vos démarches administratives.</p>
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
                        <div class="d-flex align-items-center">
                            <div class="bg-bf-vert-pale rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-geo-alt text-bf-vert fs-4"></i>
                            </div>
                            <div>
                                <div class="fw-medium">Adresse</div>
                                <span class="text-muted">Ouagadougou, Burkina Faso</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="card">
                        <div class="card-body p-5">
                            <h4 class="mb-4">Envoyez-nous un message</h4>
                            <form action="{{ route('contact') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom complet</label>
                                    <input type="text" class="form-control" id="nom" name="nom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="sujet" class="form-label">Sujet</label>
                                    <select class="form-select" id="sujet" name="sujet" required>
                                        <option value="">Choisir un sujet</option>
                                        <option value="information">Demande d'information</option>
                                        <option value="assistance">Assistance technique</option>
                                        <option value="reclamation">Réclamation</option>
                                        <option value="suggestion">Suggestion</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-send me-2"></i> Envoyer le message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
