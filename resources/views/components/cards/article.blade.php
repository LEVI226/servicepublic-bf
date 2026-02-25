@props(['article'])

@php
    $hasImage = !empty($article->image);
    $colors = ['text-primary', 'text-success', 'text-danger', 'text-warning', 'text-info', 'text-secondary'];
    $colorClass = $colors[$article->id % count($colors)];
    $bgClass = str_replace('text-', 'bg-', $colorClass);
@endphp

<a href="{{ route('actualites.show', $article->slug) }}" class="card-premium h-100 p-0 overflow-hidden d-flex flex-column text-decoration-none">
    
    @if($hasImage)
        <div class="ratio ratio-16x9 position-relative">
            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="object-fit-cover">
            @if($article->category)
                <span class="position-absolute top-0 end-0 m-3 badge bg-white text-dark shadow-sm">{{ $article->category->name }}</span>
            @endif
        </div>
    @endif

    <div class="p-4 d-flex flex-column flex-grow-1">
        
        <div class="d-flex justify-content-between align-items-start mb-2">
            @if(!$hasImage && $article->category)
                <span class="badge {{ $bgClass }} bg-opacity-10 {{ $colorClass }} border-0 px-2 py-1">{{ $article->category->name }}</span>
            @endif
            @if($article->published_at)
                <span class="text-xs text-muted {{ $hasImage || !$article->category ? 'ms-auto' : '' }}"><i class="bi bi-calendar3 me-1"></i> {{ $article->published_at->format('d/m/Y') }}</span>
            @endif
        </div>

        <h3 class="h6 fw-bold text-dark mt-2 mb-3 lh-base">
            @if(!$hasImage)
                <i class="bi bi-newspaper {{ $colorClass }} me-2"></i>
            @endif
            {{ $article->title }}
        </h3>
        
        @if($article->excerpt)
            <p class="text-muted small mb-0 mt-auto" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                {{ $article->excerpt }}
            </p>
        @else
            <p class="text-muted small mb-0 mt-auto" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                {{ Str::limit(strip_tags($article->content), 100) }}
            </p>
        @endif
    </div>
</a>
