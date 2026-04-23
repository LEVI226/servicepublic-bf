@props(['theme'])

<a href="{{ route('thematiques.show', $theme->slug) }}" class="card-premium d-flex flex-row align-items-start gap-3">
    <div class="icon-wrapper flex-shrink-0">
        <i class="{{ $theme->icone ?? 'bi bi-folder' }}"></i>
    </div>
    <div class="flex-grow-1">
        <h3 class="h6 mb-1">{{ $theme->nom }}</h3>
        <p class="text-sm text-muted mb-2">{{ Str::limit($theme->description, 60) }}</p>
        <div class="text-xs text-secondary font-weight-bold">
            {{ $theme->fiches_publiees_count ?? 0 }} fiches pratiques
        </div>
    </div>
</a>
