@extends('layouts.app')
@section('title', 'Recherche')
@section('meta_description', 'Recherchez une démarche, un service ou une fiche pratique sur le portail Service Public du Burkina Faso.')

@section('content')
    <x-ui.hero-banner
        title="Recherche"
        subtitle="Trouvez rapidement l'information, la démarche ou le service que vous cherchez."
    />

    <div class="container section-padding pt-0">
        <form action="{{ route('recherche') }}" method="GET" class="search-wrapper search-full mb-5">
            <input type="text" name="q" value="{{ $q }}" placeholder="Tapez votre recherche..." autofocus aria-label="Recherche">
            <button type="submit">Rechercher</button>
        </form>

        @if($q)
            <p class="text-muted mb-4">
                <strong>{{ $resultats->count() }}</strong> résultat(s) pour « <strong>{{ $q }}</strong> »
            </p>

            <div class="row g-4">
                @forelse($resultats as $r)
                    <div class="col-md-6">
                        <div class="card-premium">
                            <span class="badge badge-type text-bf-green rounded-pill mb-2">
                                {{ ucfirst($r['type']) }}
                            </span>
                            <h5 class="fw-bold mb-2">
                                <a href="{{ $r['url'] }}" class="text-bf-green text-decoration-none">
                                    {!! preg_replace('/('.preg_quote($q, '/').')/i', '<mark class="bg-warning px-1 rounded-1">$1</mark>', e($r['titre'])) !!}
                                </a>
                            </h5>
                            @if($r['description'])
                                <p class="text-muted small mb-0">
                                    {!! preg_replace('/('.preg_quote($q, '/').')/i', '<mark class="bg-warning px-1 rounded-1">$1</mark>', e(Str::limit($r['description'], 200))) !!}
                                </p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-search empty-state-icon"></i>
                        <p class="text-muted mt-3">Aucun résultat trouvé pour « <strong>{{ $q }}</strong> ».</p>
                        <p class="text-muted small">Essayez avec d'autres mots-clés.</p>
                    </div>
                @endforelse
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-signpost-split empty-state-icon"></i>
                <p class="text-muted mt-3">Saisissez un terme pour lancer la recherche.</p>
            </div>
        @endif
    </div>
@endsection