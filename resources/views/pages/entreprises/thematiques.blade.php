@extends('layouts.app')
@section('title', 'Catégories Entreprises')

@section('content')
    <x-ui.hero-banner 
        title="Catégories Entreprises" 
        subtitle="Explorez toutes les fiches pratiques pour les professionnels et entreprises." 
    />

    <div class="container section-padding pt-0">
        <div class="row g-4">
            @foreach($categories as $category)
                <div class="col-md-6 col-lg-4">
                    <x-cards.category :category="$category" />
                </div>
            @endforeach
        </div>
    </div>
@endsection