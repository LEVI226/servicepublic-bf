@props(['title', 'subtitle' => null, 'icon' => null, 'showBreadcrumb' => true])

@php
    // Default contextual icons based on page title if none specified
    $displayIcon = $icon ?? match(true) {
        str_contains(strtolower($title), 'actualité') => 'bi-newspaper',
        str_contains(strtolower($title), 'thématique') || str_contains(strtolower($title), 'thème') => 'bi-grid-3x3-gap',
        str_contains(strtolower($title), 'annuaire') => 'bi-building',
        str_contains(strtolower($title), 'démarche') => 'bi-clipboard-check',
        str_contains(strtolower($title), 'service') => 'bi-laptop',
        str_contains(strtolower($title), 'contact') => 'bi-headset',
        str_contains(strtolower($title), 'comment faire') || str_contains(strtolower($title), 'événement') => 'bi-signpost-split',
        str_contains(strtolower($title), 'entreprise') => 'bi-briefcase',
        str_contains(strtolower($title), 'recherche') => 'bi-search',
        str_contains(strtolower($title), 'mention') => 'bi-file-earmark-text',
        str_contains(strtolower($title), 'accessibilité') => 'bi-universal-access',
        str_contains(strtolower($title), 'plan du site') => 'bi-map',
        str_contains(strtolower($title), 'formulaire') => 'bi-file-earmark-pdf',
        default => 'bi-layers',
    };
@endphp

<div class="hero hero-banner py-5 mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                @if($showBreadcrumb)
                <nav aria-label="Fil d'Ariane" class="mb-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Accueil</a></li>
                        @if(isset($breadcrumb) && is_array($breadcrumb))
                            @foreach($breadcrumb as $item)
                                @if(!$loop->first) {{-- Skip 'Accueil' if already in list --}}
                                    @if($loop->last)
                                        <li class="breadcrumb-item active text-bf-green fw-bold" aria-current="page">{{ $item['name'] }}</li>
                                    @else
                                        @if($item['url'])
                                            <li class="breadcrumb-item"><a href="{{ $item['url'] }}" class="text-muted text-decoration-none">{{ $item['name'] }}</a></li>
                                        @else
                                            <li class="breadcrumb-item text-muted">{{ $item['name'] }}</li>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        @else
                            <li class="breadcrumb-item active text-bf-green fw-bold" aria-current="page">{{ $title }}</li>
                        @endif
                    </ol>
                </nav>
                @endif
                <h1 class="display-5 fw-bold text-dark mb-2">{{ $title }}</h1>
                @if($subtitle)
                    <p class="lead text-muted mb-0">{{ $subtitle }}</p>
                @endif
            </div>
            <div class="col-lg-4 text-lg-end d-none d-lg-block">
                <i class="bi {{ $displayIcon }} text-bf-green hero-icon-decorative"></i>
            </div>
        </div>
    </div>
</div>
