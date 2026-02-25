@props(['actualite'])

<a href="{{ route('actualites.show', $actualite->slug) }}" class="card-premium p-0 overflow-hidden">
    <div class="ratio ratio-16x9 bg-light">
        @if($actualite->image)
            <img src="{{ asset('storage/' . $actualite->image) }}" alt="{{ $actualite->titre }}" class="object-fit-cover">
        @else
            <div class="d-flex align-items-center justify-content-center text-gray-300">
                <i class="bi bi-newspaper display-4"></i>
            </div>
        @endif
    </div>
    <div class="p-4">
        <div class="text-xs text-muted mb-2">{{ $actualite->publie_le->format('d/m/Y') }}</div>
        <h3 class="h6 mb-0">{{ $actualite->titre }}</h3>
    </div>
</a>
