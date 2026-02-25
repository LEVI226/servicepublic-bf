@extends('layouts.app')
@section('title', "Annuaire de l'administration")

@section('content')
    <x-ui.hero-banner 
        title="Annuaire de l'administration" 
        subtitle="Retrouvez les coordonnées de tous les services publics de l'État." 
    />

    <div class="container section-padding pt-0">
        <!-- 🔍 Search & Filters -->
        <div class="card-premium mb-5 border-0 shadow-sm bg-soft">
            <form action="{{ route('annuaire.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="q" class="form-control border-start-0 ps-0 py-3" placeholder="Rechercher un organisme..." value="{{ $recherche ?? '' }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn-sp btn-sp-primary w-100 py-3">Rechercher</button>
                </div>
            </form>

            <div class="mt-3 pt-3 border-top d-flex flex-wrap gap-1 justify-content-center">
                <a href="{{ route('annuaire.index') }}" class="btn btn-sm btn-link text-decoration-none {{ !isset($lettre) || !$lettre ? 'fw-bold text-bf-green' : 'text-muted' }}">Tous</a>
                @foreach($lettres as $l)
                    <a href="{{ route('annuaire.index', ['lettre' => $l]) }}" class="btn btn-sm btn-link text-decoration-none {{ ($lettre ?? '') === $l ? 'fw-bold text-bf-green' : 'text-muted' }}">{{ $l }}</a>
                @endforeach
            </div>
        </div>

        <!-- 🏢 Organismes Grid -->
        <div class="row g-4">
            @forelse($organismes as $organisme)
                <div class="col-md-6 col-lg-4">
                    <div class="card-theme h-100 position-relative transition-all hover-shadow">
                        <div class="d-flex w-100 flex-column h-100">
                            <div class="mb-3">
                                @if($organisme->type)
                                    <span class="badge bg-soft text-dark border">{{ $organisme->type }}</span>
                                @endif
                            </div>
                            
                            <h3 class="h5 fw-bold mb-1">
                                <a href="{{ route('annuaire.show', $organisme->slug) }}" class="text-dark text-decoration-none stretched-link">{{ $organisme->name }}</a>
                            </h3>
                            @if($organisme->acronym)
                                <p class="text-muted small mb-3">({{ $organisme->acronym }})</p>
                            @endif

                            <div class="mt-auto pt-3 border-top text-sm position-relative z-index-1">
                                @if($organisme->phone)
                                    <div class="mb-1"><a href="tel:{{ preg_replace('/[^0-9+]/', '', $organisme->phone) }}" class="text-decoration-none text-dark"><i class="bi bi-telephone text-bf-green me-2"></i> {{ $organisme->phone }}</a></div>
                                @endif
                                @if($organisme->email)
                                    <div><a href="mailto:{{ $organisme->email }}" class="text-decoration-none text-dark"><i class="bi bi-envelope text-bf-green me-2"></i> {{ $organisme->email }}</a></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 py-5 text-center">
                    <div class="display-1 text-muted opacity-25 mb-3"><i class="bi bi-building-slash"></i></div>
                    <p class="lead text-muted">Aucun organisme ne correspond à votre recherche.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $organismes->appends(request()->query())->links() }}
        </div>
    </div>
@endsection