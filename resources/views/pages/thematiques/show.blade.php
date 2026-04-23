@extends('layouts.app')
@section('title', $category->name)

@push('jsonld')
    <x-breadcrumb-jsonld :items="$breadcrumb" />
@endpush

@section('content')
    <x-ui.hero-banner 
        :title="$category->name" 
        :subtitle="$category->description" 
    />

    <div class="container section-padding pt-0">
        @if($subcategories->isNotEmpty())
            <div class="mb-5">
                <h2 class="h4 fw-bold mb-4">Sous-catégories</h2>
                <div class="row g-4">
                    @foreach($subcategories as $sub)
                        <div class="col-md-6 col-lg-4">
                            <div class="card-premium d-flex flex-row align-items-start gap-3">
                                <div class="flex-grow-1">
                                    <h3 class="h6 mb-1">{{ $sub->name }}</h3>
                                    <div class="text-xs text-secondary fw-bold">
                                        {{ $sub->procedures_count ?? 0 }} fiches pratiques
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div>
            <h2 class="h4 fw-bold mb-4">Fiches pratiques</h2>
            <div class="row g-4">
                @forelse($procedures as $procedure)
                    <div class="col-md-6">
                        <x-cards.procedure :procedure="$procedure" />
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">Aucune fiche disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-5 d-flex justify-content-center">
                {{ $procedures->links() }}
            </div>
        </div>
    </div>
@endsection