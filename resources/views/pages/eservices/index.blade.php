@extends('layouts.app')

@section('title', 'E-Services')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">E-Services</li>
@endsection

@section('content')
<section class="section pt-5">
    <div class="container">
        <div class="section-title">
            <h2>Tous les E-Services</h2>
            <p class="subtitle">Effectuez vos démarches administratives en ligne</p>
            <div class="barre"></div>
        </div>
        
        <div class="row g-4">
            @forelse($eservices as $eservice)
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
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Aucun service en ligne disponible pour le moment.</div>
            </div>
            @endforelse
        </div>
        
        <div class="mt-5 d-flex justify-content-center">
            {{ $eservices->links() }}
        </div>
    </div>
</section>
@endsection
