@props(['service'])

@php
    // Variate colors by ID to distinguish services
    $colors = ['text-primary', 'text-success', 'text-danger', 'text-warning', 'text-info', 'text-secondary'];
    $colorClass = $colors[$service->id % count($colors)] ?? 'text-secondary';
    $bgClass = str_replace('text-', 'bg-', $colorClass);
@endphp

<div class="card-eservice h-100 d-flex flex-column border-0 shadow-sm p-4 bg-white rounded-4 transition-all">
    <div class="d-flex align-items-center mb-3">
        <div class="icon-wrapper flex-shrink-0 me-3 {{ $bgClass }} bg-opacity-10 {{ $colorClass }} p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
            <i class="{{ $service->icon ?? 'bi bi-laptop' }} fs-4"></i>
        </div>
        <div>
            @if($service->category)
                <span class="badge bg-light text-secondary border mb-1" style="font-size: 0.65rem;"><i class="bi bi-folder me-1"></i>{{ $service->category->name }}</span>
            @endif
            <h3 class="h6 fw-bold mb-0 text-dark lh-sm">{{ $service->title }}</h3>
        </div>
    </div>
    
    <p class="text-muted small mb-4 flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
        {{ strip_tags($service->description) ?: 'Aucune description disponible.' }}
    </p>

    <a href="{{ $service->url }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-dark w-100 justify-content-center fw-bold rounded-pill gap-2 mt-auto">
        <span>Accéder au service</span>
        <i class="bi bi-box-arrow-up-right ms-2"></i>
    </a>
</div>
