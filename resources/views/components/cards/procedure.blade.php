@props(['procedure'])

<a href="{{ route('fiches.show', ['themeSlug' => $procedure->category?->slug ?? 'general', 'ficheSlug' => $procedure->slug]) }}" class="card-premium h-100 text-decoration-none">
    <div class="d-flex flex-column h-100">
        <div class="mb-3">
            <span class="badge bg-soft text-bf-green border rounded-pill px-2 py-1 badge-category">
                {{ $procedure->category?->name ?? 'Général' }}
            </span>
        </div>
        <h3 class="h5 mb-2 fw-bold text-dark">
            @if(!empty($procedure->icon))
                <i class="{{ $procedure->icon }} text-bf-green me-2"></i>
            @endif
            {{ $procedure->title }}
        </h3>
        <p class="text-muted small mb-0 card-description">
            {{ Str::limit($procedure->description, 100) }}
        </p>
        <div class="mt-auto pt-3">
            <span class="text-bf-green fw-bold small">Lire la fiche <i class="bi bi-arrow-right ms-1"></i></span>
        </div>
    </div>
</a>
