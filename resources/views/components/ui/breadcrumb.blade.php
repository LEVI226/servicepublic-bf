@props(['items' => []])

<nav aria-label="breadcrumb" class="bg-light py-3 border-bottom mb-5">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
            @foreach($items as $label => $url)
                @if(!$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $url }}">{{ $label }}</a></li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{ $label }}</li>
                @endif
            @endforeach
        </ol>
    </div>
</nav>
