@props(['fiche'])

<a href="{{ route('fiches.show', ['themeSlug' => $fiche->theme->slug, 'ficheSlug' => $fiche->slug]) }}" class="card-premium h-100 text-decoration-none">
    <div class="d-flex flex-column h-100">
        <div class="mb-3">
            <span class="badge bg-soft text-bf-green border rounded-pill px-2 py-1 badge-category">
                {{ $fiche->theme->nom }}
            </span>
        </div>
        <h3 class="h5 mb-2 fw-bold text-dark">{{ $fiche->titre }}</h3>
        <p class="text-muted small mb-0 card-description">
            {{ Str::limit($fiche->resume, 100) }}
        </p>
        <div class="mt-auto pt-3">
            <span class="text-bf-green fw-bold small">Lire la fiche <i class="bi bi-arrow-right ms-1"></i></span>
        </div>
    </div>
</a>
