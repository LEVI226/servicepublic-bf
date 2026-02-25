@extends('layouts.app')
@section('title', 'Démarches et outils')

@section('content')
    <x-ui.hero-banner 
        title="Démarches et outils" 
        subtitle="Accédez aux formulaires et services en ligne de l'administration." 
    />

    <div class="container section-padding pt-5">
        <div class="row g-4">
            
            <!-- Formulaires administratifs -->
            <div class="col-lg-6">
                <a href="{{ route('demarches.formulaires') }}" class="card-premium text-decoration-none h-100">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-wrapper icon-wrapper-sm bg-soft text-bf-green rounded-circle d-flex align-items-center justify-content-center me-3 mb-0">
                            <i class="bi bi-file-earmark-pdf"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-0 text-dark">Formulaires administratifs</h3>
                    </div>
                    <p class="text-muted mb-4 card-description">
                        Téléchargez les formulaires officiels (Cerfa, requêtes, demandes) nécessaires à la constitution de vos dossiers administratifs physiques.
                    </p>
                    <div class="mt-auto pt-3 border-top border-light">
                        <span class="btn-sp btn-sp-secondary btn-sp-sm">Accéder aux formulaires <i class="bi bi-arrow-right ms-1"></i></span>
                    </div>
                </a>
            </div>
            
            <!-- Démarches en ligne -->
            <div class="col-lg-6">
                <div class="card-premium h-100">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-wrapper icon-wrapper-sm bg-soft text-primary rounded-circle d-flex align-items-center justify-content-center me-3 mb-0">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-0 text-dark">Démarches en ligne</h3>
                    </div>
                    <p class="text-muted mb-4 card-description">
                        Accédez directement aux plateformes gouvernementales dématérialisées pour accomplir vos formalités sur internet.
                    </p>
                        
                    @if(isset($eservices) && $eservices->count() > 0)
                        <ul class="list-unstyled mb-4 flex-grow-1">
                            @foreach($eservices->take(5) as $service)
                                <li class="mb-3 pb-2 border-bottom border-light border-opacity-50 last-child-no-border">
                                    <a href="{{ $service->url }}" target="_blank" rel="noopener" class="text-decoration-none d-flex align-items-start gap-2 group">
                                        <i class="bi bi-arrow-up-right-circle-fill text-primary mt-1"></i>
                                        <span class="text-dark fw-medium group-hover-text-primary transition-all">{{ $service->title }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        
                        <div class="mt-auto pt-3 border-top border-light">
                            <a href="{{ route('eservices.index') }}" class="btn-sp btn-sp-secondary btn-sp-sm text-primary border-primary">Voir tous les services en ligne <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    @else
                        <div class="alert alert-light border text-muted small mt-auto mb-0">
                            <i class="bi bi-info-circle me-2"></i> Aucun service en ligne disponible pour le moment.
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection