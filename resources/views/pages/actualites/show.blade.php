@extends('layouts.app')
@section('title', $article->title)
@section('meta_description', Str::limit(strip_tags($article->excerpt ?? $article->content ?? ''), 160))

@push('jsonld')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "NewsArticle",
        "headline": "{{ $article->title }}",
        "description": "{{ Str::limit(strip_tags($article->excerpt ?? $article->content ?? ''), 200) }}",
        "datePublished": "{{ $article->published_at?->toIso8601String() }}",
        "dateModified": "{{ $article->updated_at->toIso8601String() }}",
        "inLanguage": "fr-BF",
        "publisher": {
            "@type": "GovernmentOrganization",
            "name": "Service Public Burkina Faso",
            "url": "{{ config('app.url') }}"
        }
    }
    </script>
@endpush

@section('content')
    <nav aria-label="breadcrumb" class="bg-light border-bottom py-2">
        <div class="container">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('actualites.index') }}">Actualités</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($article->title, 50) }}</li>
            </ol>
        </div>
    </nav>

    <div class="container section-padding">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">{{ $article->title }}</h1>

                @if($article->published_at)
                    <p class="text-muted mb-4">
                        <i class="bi bi-calendar3 me-1"></i> Publié le {{ $article->published_at->format('d/m/Y') }}
                    </p>
                @endif

                @if($article->excerpt)
                    <p class="lead fw-medium mb-4">{{ $article->excerpt }}</p>
                @endif

                <div class="mt-4 article-content">
                    {!! clean($article->content) !!}
                </div>
            </div>
        </div>
    </div>

    @if(isset($relatedArticles) && $relatedArticles->isNotEmpty())
        <div class="container mb-5">
            <h2 class="h4 fw-bold mb-4">Autres actualités</h2>
            <div class="row g-4">
                @foreach($relatedArticles as $related)
                    <div class="col-md-4">
                        <x-cards.article :article="$related" />
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection