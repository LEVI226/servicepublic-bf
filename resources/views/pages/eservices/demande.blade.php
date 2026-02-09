@extends('layouts.app')

@section('title', 'Nouvelle Demande - ' . $eservice->nom)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('eservices.index') }}">E-Services</a></li>
    <li class="breadcrumb-item"><a href="{{ route('eservices.show', $eservice->slug) }}">{{ Str::limit($eservice->nom, 20) }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Formulaire</li>
@endsection

@section('content')
<section class="section pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                 <div class="text-center mb-5">
                    <span class="badge bg-bf-vert-pale text-bf-vert mb-2">NOUVELLE DEMANDE</span>
                    <h1 class="h2 fw-bold">{{ $eservice->nom }}</h1>
                    <p class="text-muted">Veuillez remplir le formulaire ci-dessous avec exactitude.</p>
                </div>

                <div class="card shadow border-0">
                    <div class="card-body p-5">
                        <form action="{{ route('eservices.demande.soumettre', $eservice->slug) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Information Demandeur -->
                            <h5 class="mb-4 text-bf-vert border-bottom pb-2">1. Informations du demandeur</h5>
                            <div class="row g-3 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Nom & Prénom</label>
                                    <p class="form-control-plaintext fw-bold">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Email</label>
                                    <p class="form-control-plaintext fw-bold">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Téléphone</label>
                                    <p class="form-control-plaintext fw-bold">{{ Auth::user()->telephone ?? 'Non renseigné' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small text-uppercase fw-bold">CNIB</label>
                                    <p class="form-control-plaintext fw-bold">{{ Auth::user()->cnib ?? 'Non renseigné' }}</p>
                                </div>
                                <div class="col-12">
                                    <div class="alert alert-warning small">
                                        <i class="bi bi-exclamation-triangle me-1"></i> Si ces informations sont incorrectes, veuillez les modifier dans <a href="{{ route('profil') }}">votre profil</a> avant de poursuivre.
                                    </div>
                                </div>
                            </div>

                            <!-- Formulaire Spécifique -->
                            <h5 class="mb-4 text-bf-vert border-bottom pb-2">2. Détails de la demande</h5>
                            
                            <!-- Champs génériques pour l'exemple, à adapter selon le modèle Eservice -->
                            <div class="mb-4">
                                <label for="objet" class="form-label">Objet de la demande <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="objet" name="objet" required placeholder="Précisez l'objet de votre demande">
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">Description / Motivation <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" name="description" rows="5" required placeholder="Décrivez votre demande en détail..."></textarea>
                            </div>

                            <!-- Upload Documents -->
                            <h5 class="mb-4 text-bf-vert border-bottom pb-2">3. Pièces jointes</h5>
                            
                            <div class="mb-4">
                                <label for="pieces_jointes" class="form-label">Documents justificatifs (PDF, JPG, PNG - Max 5Mo)</label>
                                <input class="form-control" type="file" id="pieces_jointes" name="pieces_jointes[]" multiple>
                                <div class="form-text">Vous pouvez sélectionner plusieurs fichiers.</div>
                            </div>

                            <!-- Confirmation -->
                            <div class="form-check mb-5">
                                <input class="form-check-input" type="checkbox" value="" id="certification" required>
                                <label class="form-check-label" for="certification">
                                    Je certifie sur l'honneur l'exactitude des informations fournies.
                                </label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-send-check me-2"></i> Soumettre la demande
                                </button>
                                <a href="{{ route('eservices.show', $eservice->slug) }}" class="btn btn-outline-secondary">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
