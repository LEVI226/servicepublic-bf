@extends('layouts.app')

@section('title', 'Actualités')

@section('content')
    <x-ui.hero-banner 
        title="Actualités" 
        subtitle="Restez informé des dernières mises à jour de l'administration et des services publics." 
    />

    <div class="container section-padding pt-0">
        <div class="row g-4">
            @forelse($articles as $article)
                <div class="col-md-6 col-lg-4">
                    <x-cards.article :article="$article" />
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Aucune actualité disponible.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $articles->links() }}
        </div>
    </div>
@endsection