@props(['title' => null, 'alt' => false, 'link' => null, 'linkText' => 'Voir tout'])

<section {{ $attributes->merge(['class' => 'section-padding ' . ($alt ? 'section-alt' : '')]) }}>
    <div class="container">
        @if($title)
            <div class="section-title">
                <h2 class="mb-0">{{ $title }}</h2>
                @if($link)
                    <a href="{{ $link }}" class="btn-sp btn-sp-secondary">
                        {{ $linkText }} <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                @endif
            </div>
        @endif
        {{ $slot }}
    </div>
</section>
