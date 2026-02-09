@extends('layouts.app')

@section('title', $fiche->titre)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('entreprises.index') }}">Entreprises</a></li>
    <li class="breadcrumb-item"><a href="{{ route('entreprises.categorie', $categorie->slug) }}">{{ $categorie->nom }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($fiche->titre, 20) }}</li>
@endsection

@section('content')
<div class="section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Header Fiche -->
                <div class="mb-5">
                    <span class="badge badge-entreprise mb-3">{{ mb_strtoupper($categorie->nom) }}</span>
                    <h1 class="mb-3 display-6 fw-bold">{{ $fiche->titre }}</h1>
                    <p class="lead text-muted">{{ $fiche->description }}</p>
                    
                    <div class="d-flex gap-3 text-muted small mt-3">
                        <span><i class="bi bi-calendar3 me-1"></i> Mis à jour le {{ $fiche->updated_at->format('d/m/Y') }}</span>
                        <span><i class="bi bi-eye me-1"></i> {{ $fiche->vues }} consultations</span>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5 content-fiche">
                        {!! $fiche->contenu !!}
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <!-- Action Box -->
                     <div class="card border-0 shadow-sm mb-4 bg-bf-rouge text-white">
                        <div class="card-body p-4">
                            <h5 class="card-title text-white mb-3">Besoin d'assistance ?</h5>
                            <p class="card-text opacity-75 mb-4">Nos agents sont disponibles pour vous guider dans cette démarche.</p>
                            <a href="{{ route('contact') }}" class="btn btn-light w-100 text-bf-rouge fw-bold">
                                <i class="bi bi-headset me-2"></i> Contacter le support
                            </a>
                        </div>
                    </div>

                    <!-- Related Actions -->
                    @if($fichesSimilaires->count() > 0)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom fw-bold py-3">
                            Démarches similaires
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($fichesSimilaires as $similaire)
                            <a href="{{ route('entreprises.fiche', ['categorieSlug' => $categorie->slug, 'ficheSlug' => $similaire->slug]) }}" class="list-group-item list-group-item-action py-3">
                                <div class="fw-medium text-dark">{{ $similaire->titre }}</div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
