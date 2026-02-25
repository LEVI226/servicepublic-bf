@extends('layouts.app')
@section('title', $category->name)

@section('content')
    <x-ui.hero-banner 
        :title="$category->name" 
        :subtitle="$category->description ?? 'Toutes les démarches pour cette catégorie.'" 
    />

    <div class="container section-padding pt-0">
        <div class="row g-4">
            @forelse($procedures as $procedure)
                <div class="col-md-6">
                    <x-cards.procedure :procedure="$procedure" />
                </div>
            @empty
                <div class="col-12 py-5 text-center">
                    <p class="text-muted">Aucune fiche disponible pour cette catégorie.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-5 d-flex justify-content-center">
            {{ $procedures->links() }}
        </div>
    </div>
@endsection