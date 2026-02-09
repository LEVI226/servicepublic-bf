@extends('layouts.app')

@section('title', 'Détails de la demande')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.demandes') }}">Demandes</a></li>
    <li class="breadcrumb-item active" aria-current="page">#{{ $demande->reference ?? $demande->id }}</li>
@endsection

@section('content')
<section class="section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Header -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="badge bg-light text-dark border mb-2">{{ $demande->eservice->nom }}</span>
                                <h1 class="h3 fw-bold mb-1">Demande #{{ $demande->reference ?? $demande->id }}</h1>
                                <p class="text-muted mb-0">Soumise le {{ $demande->created_at->format('d/m/Y à H:i') }}</p>
                            </div>
                            @php
                                $badgeClass = match($demande->statut) {
                                    'soumise' => 'bg-info',
                                    'en_cours' => 'bg-primary',
                                    'traitee' => 'bg-success',
                                    'rejetee' => 'bg-danger',
                                    'annulee' => 'bg-secondary',
                                    'en_attente' => 'bg-warning text-dark',
                                    default => 'bg-light text-dark border',
                                };
                                $statutLabel = ucfirst(str_replace('_', ' ', $demande->statut));
                            @endphp
                            <span class="badge {{ $badgeClass }} fs-6 px-3 py-2">{{ $statutLabel }}</span>
                        </div>
                    </div>
                </div>

                <!-- Timeline / Status History (Simplified) -->
                @if($demande->commentaire)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-light fw-bold">Note de l'administration</div>
                    <div class="card-body">
                        <div class="d-flex">
                            <i class="bi bi-chat-left-quote text-muted fs-3 me-3"></i>
                            <div>
                                <p class="mb-0">{{ $demande->commentaire }}</p>
                                @if($demande->date_traitement)
                                    <small class="text-muted mt-2 d-block">Mis à jour le {{ $demande->date_traitement->format('d/m/Y à H:i') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Rendez-vous info -->
                @if($demande->date_rendez_vous)
                <div class="alert alert-info border-0 shadow-sm d-flex align-items-center">
                    <i class="bi bi-calendar-event fs-2 me-3"></i>
                    <div>
                        <h5 class="alert-heading fw-bold mb-1">Rendez-vous programmé</h5>
                        <p class="mb-0">
                            Vous êtes attendu le <strong>{{ $demande->date_rendez_vous->format('d/m/Y à H:i') }}</strong>
                            @if($demande->lieu_rendez_vous)
                                <br>Lieu : {{ $demande->lieu_rendez_vous }}
                            @endif
                        </p>
                    </div>
                </div>
                @endif

                <!-- Données du formulaire (Placeholder) -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white fw-bold py-3">Informations soumises</div>
                    <div class="card-body">
                         <div class="alert alert-light border">
                            <i class="bi bi-info-circle me-2"></i> Les détails du formulaire soumis s'afficheraient ici.
                        </div>
                        <!-- Ici, on pourrait boucler sur les champs JSON de la demande si stockés -->
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                @if(Auth::user()->isAdmin() || Auth::user()->isAgent())
                <!-- Admin Actions -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-bf-vert text-white fw-bold">Traitement</div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.demandes.update', $demande->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="statut" class="form-label">Nouveau statut</label>
                                <select name="statut" id="statut" class="form-select">
                                    <option value="soumise" {{ $demande->statut == 'soumise' ? 'selected' : '' }}>Soumise</option>
                                    <option value="en_cours" {{ $demande->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="en_attente" {{ $demande->statut == 'en_attente' ? 'selected' : '' }}>En attente d'info</option>
                                    <option value="traitee" {{ $demande->statut == 'traitee' ? 'selected' : '' }}>Traitée / Terminée</option>
                                    <option value="rejetee" {{ $demande->statut == 'rejetee' ? 'selected' : '' }}>Rejetée</option>
                                    <option value="annulee" {{ $demande->statut == 'annulee' ? 'selected' : '' }}>Annulée</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="commentaire" class="form-label">Note / Commentaire</label>
                                <textarea name="commentaire" id="commentaire" rows="3" class="form-control">{{ $demande->commentaire }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="date_rendez_vous" class="form-label">Date de rendez-vous (optionnel)</label>
                                <input type="datetime-local" name="date_rendez_vous" id="date_rendez_vous" class="form-control" value="{{ $demande->date_rendez_vous ? $demande->date_rendez_vous->format('Y-m-d\TH:i') : '' }}">
                            </div>

                             <div class="mb-3">
                                <label for="lieu_rendez_vous" class="form-label">Lieu (optionnel)</label>
                                <input type="text" name="lieu_rendez_vous" id="lieu_rendez_vous" class="form-control" value="{{ $demande->lieu_rendez_vous }}">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
                        </form>
                    </div>
                </div>
                @endif

                <!-- Demandeur Info -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold py-3">Demandeur</div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-light rounded-circle p-3 me-3">
                                <i class="bi bi-person fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">{{ $demande->user->nom }} {{ $demande->user->prenom }}</h6>
                                <small class="text-muted">{{ $demande->user->email }}</small>
                            </div>
                        </div>
                        <ul class="list-unstyled mb-0 small text-muted">
                            @if($demande->user->telephone)
                                <li class="mb-2"><i class="bi bi-telephone me-2"></i> {{ $demande->user->telephone }}</li>
                            @endif
                            @if($demande->user->cnib)
                                <li><i class="bi bi-card-heading me-2"></i> {{ $demande->user->cnib }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
