@props(['event'])

@php
    $colors = ['text-primary', 'text-success', 'text-danger', 'text-warning', 'text-info', 'text-secondary'];
    $colorClass = $colors[$event->id % count($colors)];
    $bgClass = str_replace('text-', 'bg-', $colorClass) . ' bg-opacity-10';
@endphp

<a href="{{ route('evenements.show', $event->slug) }}" class="card-premium h-100 text-center d-flex flex-column">
    <div class="icon-wrapper mx-auto mb-3 {{ $bgClass }} {{ $colorClass }}" style="width: 64px; height: 64px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 1.75rem;">
        <i class="{{ $event->icon ?? 'bi bi-question-circle' }}"></i>
    </div>
    <h3 class="h6 mb-2 fw-bold text-dark">{{ $event->title }}</h3>
    @if(isset($event->procedures_count))
        <p class="text-muted small mt-auto mb-0">{{ $event->procedures_count }} démarches associées</p>
    @endif
</a>
