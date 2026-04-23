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
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-4"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="q" class="form-control border-start-0 py-3 rounded-end-pill" placeholder="Rechercher un organisme..." value="{{ $recherche ?? '' }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="region" class="form-select py-3 shadow-none border-light rounded-pill px-4">
                        <option value="">Toutes les régions</option>
                        @foreach(['Centre', 'Hauts-Bassins', 'Boucle du Mouhoun', 'Cascades', 'Centre-Est', 'Centre-Nord', 'Centre-Ouest', 'Centre-Sud', 'Est', 'Nord', 'Plateau-Central', 'Sahel', 'Sud-Ouest'] as $r)
                            <option value="{{ $r }}" {{ request('region') == $r ? 'selected' : '' }}>{{ $r }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn-sp btn-sp-primary w-100 py-3">Filtrer</button>
                </div>
            </form>

            @if(request('region') || request('q'))
                <div class="mt-3 d-flex align-items-center gap-2">
                    <span class="text-muted small">Filtres actifs :</span>
                    @if(request('region'))
                        <span class="badge bg-white text-bf-green border rounded-pill px-3 py-2 fw-normal">
                            Région : <strong>{{ request('region') }}</strong>
                            <a href="{{ route('annuaire.index', request()->except('region')) }}" class="ms-2 text-danger text-decoration-none"><i class="bi bi-x-circle-fill"></i></a>
                        </span>
                    @endif
                    @if(request('q'))
                        <span class="badge bg-white text-bf-green border rounded-pill px-3 py-2 fw-normal">
                            Recherche : <strong>{{ request('q') }}</strong>
                            <a href="{{ route('annuaire.index', request()->except('q')) }}" class="ms-2 text-danger text-decoration-none"><i class="bi bi-x-circle-fill"></i></a>
                        </span>
                    @endif
                    <a href="{{ route('annuaire.index') }}" class="btn btn-sm btn-link text-danger text-decoration-none small ms-auto">Réinitialiser tout</a>
                </div>
            @endif

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
                    <div class="card-organisme text-start overflow-hidden hover-shadow transition-all d-flex flex-column">
                        <!-- Top Content -->
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <div class="mb-3">
                                @if($organisme->type)
                                    <span class="badge bg-light text-secondary border px-2 py-1">{{ $organisme->type }}</span>
                                @endif
                            </div>

                            <h3 class="fs-5 fw-bold mb-1 lh-sm">
                                <a href="{{ route('annuaire.show', $organisme->slug) }}" class="text-dark text-decoration-none link-hover-green">
                                    {{ Str::limit($organisme->name, 60) }}
                                </a>
                            </h3>

                            @if($organisme->acronym)
                                <div class="mt-2">
                                    <span class="badge bg-soft text-bf-green border border-success border-opacity-10">{{ $organisme->acronym }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Contact Footer -->
                        <div class="px-4 py-3 card-organisme-contact border-top">
                            @if($organisme->phone)
                                <div class="mb-1 d-flex align-items-center">
                                    <i class="bi bi-telephone text-bf-green me-2 opacity-75 flex-shrink-0"></i>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $organisme->phone) }}" class="text-decoration-none text-dark small fw-medium">{{ $organisme->phone }}</a>
                                </div>
                            @endif
                            @if($organisme->email)
                                <div class="d-flex align-items-center text-truncate mb-1">
                                    <i class="bi bi-envelope text-bf-green me-2 opacity-75 flex-shrink-0"></i>
                                    <a href="mailto:{{ $organisme->email }}" class="text-decoration-none text-dark small text-truncate">{{ $organisme->email }}</a>
                                </div>
                            @endif
                            @if(!$organisme->phone && !$organisme->email)
                                <div class="text-muted small py-1 fst-italic mb-1"><i class="bi bi-info-circle me-1"></i>Contact non renseigné</div>
                            @endif
                            <div class="mt-3">
                                <a href="{{ route('annuaire.show', $organisme->slug) }}" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1">
                                    Voir la fiche &rarr;
                                </a>
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