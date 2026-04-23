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
    <x-ui.hero-banner 
        :title="$article->title" 
        subtitle="Actualités de l'administration" 
        :showBreadcrumb="false"
    />

    <x-ui.breadcrumb :items="['Actualités' => route('actualites.index'), Str::limit($article->title, 40) => '']" />

    <div class="container section-padding">
        <div class="row">
            <div class="col-lg-8">
                <div class="card-premium border-0 shadow-sm p-4 p-md-5">
                    @if($article->published_at)
                        <div class="d-flex align-items-center text-muted mb-4 small">
                            <span class="badge bg-soft text-bf-green me-3 px-3 py-2">
                                <i class="bi bi-calendar3 me-1"></i> {{ $article->published_at->format('d/m/Y') }}
                            </span>
                            @if($article->category)
                                <span><i class="bi bi-tag me-1"></i> {{ $article->category->name }}</span>
                            @endif
                        </div>
                    @endif

                    <h1 class="h2 fw-bold mb-4" style="font-family: var(--font-heading);">{{ $article->title }}</h1>
                    
                    @if($article->excerpt)
                        <p class="lead fw-medium mb-4 text-dark border-start border-4 border-bf-green ps-4 py-2 bg-light rounded-end">{{ $article->excerpt }}</p>
                    @endif
                    
                    <div class="article-content text-muted" style="font-size: 1.15rem; line-height: 1.8;">
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