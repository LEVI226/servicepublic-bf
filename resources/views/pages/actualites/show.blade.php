@extends('layouts.app')
@section('title', $article->title)
@section('meta_description', Str::limit(strip_tags($article->excerpt ?? $article->content ?? ''), 160))

@section('content')
    <div class="fil-ariane">
        <div class="container">
            <a href="{{ route('home') }}">Accueil</a>
            <span class="separator">›</span>
            <a href="{{ route('actualites.index') }}">Actualités</a>
            <span class="separator">›</span>
            <span class="current">{{ Str::limit($article->title, 50) }}</span>
        </div>
    </div>

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