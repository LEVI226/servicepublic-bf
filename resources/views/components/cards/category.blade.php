@props(['category', 'routeName' => 'thematiques.show'])

<a href="{{ route($routeName, $category->slug) }}" class="card-premium d-flex flex-row align-items-start gap-3 text-decoration-none">
    <div class="icon-wrapper flex-shrink-0" @if($category->color) style="color: {{ $category->color }};" @endif>
        @if(empty($category->icon))
            <i class="bi bi-folder"></i>
        @elseif(str_contains($category->icon, ' '))
            <i class="{{ $category->icon }}"></i>
        @else
            <i class="bi bi-{{ str_replace('bi-', '', $category->icon) }}"></i>
        @endif
    </div>
    <div class="flex-grow-1">
        <h3 class="h6 mb-1">{{ $category->name }}</h3>
        <p class="text-sm text-muted mb-2">{{ Str::limit($category->description, 60) }}</p>
        <div class="text-xs text-secondary fw-bold">
            {{ $category->procedures_count ?? 0 }} fiches pratiques
        </div>
    </div>
</a>
