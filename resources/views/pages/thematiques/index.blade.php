@extends('layouts.app')

@section('title', 'Thématiques')

@section('content')
    <x-ui.hero-banner 
        title="Thématiques" 
        subtitle="Explorez toutes les fiches pratiques classées par domaine administratif." 
    />

    <div class="container section-padding pt-0">
        <div class="row g-4">
            @forelse($categories as $category)
                <div class="col-md-6 col-lg-4">
                    <x-cards.category :category="$category" />
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Aucune thématique disponible.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection