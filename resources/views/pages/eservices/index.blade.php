@extends('layouts.app')

@section('title', 'Services en ligne')

@section('content')
    <x-ui.hero-banner
        title="Services en ligne"
        subtitle="Accédez directement aux plateformes numériques de l'administration burkinabè."
    />

    <div class="container section-padding pt-0">
        <!-- 🔍 Category Filter -->
        <div class="card-premium mb-5 border-0 shadow-sm bg-soft">
            <form action="{{ route('eservices.index') }}" method="GET" class="d-flex flex-column flex-md-row gap-3 align-items-center justify-content-between">
                <label for="category_filter" class="fw-bold text-dark text-nowrap mb-0"><i class="bi bi-funnel me-2"></i> Filtrer par catégorie :</label>
                <select name="category_id" id="category_filter" class="form-select border-0 shadow-sm py-3" onchange="this.form.submit()" style="max-width: 400px; flex-grow: 1;">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="row g-4">
            @forelse($eservices as $service)
                <div class="col-md-6 col-lg-4">
                    <x-cards.eservice :service="$service" />
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted mb-3"><i class="bi bi-inbox empty-state-icon"></i></div>
                    <h3 class="h5">Aucun service en ligne disponible</h3>
                    <p class="text-muted">Les services seront bientôt ajoutés.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $eservices->links() }}
        </div>
    </div>
@endsection
