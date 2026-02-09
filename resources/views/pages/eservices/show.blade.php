@extends('layouts.app')

@section('title', $eservice->nom)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('eservices.index') }}">E-Services</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($eservice->nom, 30) }}</li>
@endsection

@section('content')
<section class="section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-4">
                    @if($eservice->en_ligne)
                        <span class="badge badge-sp mb-2">SERVICE EN LIGNE</span>
                    @endif
                    <h1 class="display-5 fw-bold mb-3">{{ $eservice->nom }}</h1>
                    <p class="lead text-muted">{{ $eservice->description }}</p>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white fw-bold py-3">
                        <i class="bi bi-info-circle me-2 text-primary"></i> Informations Pratiques
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase small fw-bold">Délai de traitement</h6>
                                <p class="fs-5 mb-0">
                                    @if($eservice->duree_traitement)
                                        {{ $eservice->duree_traitement }} jours
                                    @else
                                        Non spécifié
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase small fw-bold">Coût</h6>
                                <p class="fs-5 mb-0 text-success fw-bold">
                                    {{ $eservice->cout > 0 ? number_format($eservice->cout, 0, ',', ' ') . ' FCFA' : 'Gratuit' }}
                                </p>
                            </div>
                            @if($eservice->structure)
                            <div class="col-12">
                                <h6 class="text-muted text-uppercase small fw-bold">Service Responsable</h6>
                                <p class="mb-0">{{ $eservice->structure->nom }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Prérequis et Pièces à fournir</h4>
                        <div class="content-eservice">
                             @if($eservice->pieces_requises)
                                <ul class="list-group list-group-flush mb-4">
                                     <!-- Assuming pieces_requises is stored as JSON or text list; logic might vary -->
                                     <!-- Placeholder render -->
                                     <li class="list-group-item px-0"><i class="bi bi-check2 text-success me-2"></i> CNIB ou Passeport valide</li>
                                     <li class="list-group-item px-0"><i class="bi bi-check2 text-success me-2"></i> Formulaire de demande (disponible à l'étape suivante)</li>
                                </ul>
                                <p>{{ $eservice->pieces_requises }}</p>
                             @else
                                <p class="text-muted">Aucune pièce spécifique mentionnée.</p>
                             @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow border-0 sticky-top" style="top: 100px;">
                    <div class="card-body p-4 text-center">
                        <h4 class="mb-3">Commencer la démarche</h4>
                        <p class="text-muted small mb-4">Vous allez être redirigé vers le formulaire de demande en ligne. Munissez-vous de vos pièces justificatives.</p>
                        
                        @auth
                            <a href="{{ route('eservices.demande', $eservice->slug) }}" class="btn btn-primary btn-lg w-100 mb-3 pulse-button">
                                <i class="bi bi-play-circle me-2"></i> Faire la demande
                            </a>
                        @else
                            <a href="{{ route('login') }}?redirect={{ route('eservices.demande', $eservice->slug) }}" class="btn btn-secondary btn-lg w-100 mb-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Se connecter pour commencer
                            </a>
                            <p class="small text-muted mb-0">Un compte est nécessaire pour le suivi de votre dossier.</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
