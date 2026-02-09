@extends('layouts.app')

@section('title', 'Annuaire des Services')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Annuaire</li>
@endsection

@section('content')
<section class="section pt-5">
    <div class="container">
        <div class="section-title">
            <h2>Annuaire des Services Publics</h2>
            <p class="subtitle">Retrouvez les contacts des ministères et institutions</p>
            <div class="barre"></div>
        </div>
        
        <!-- Search / Filter -->
        <div class="card mb-5 border-0 shadow-sm" style="background-color: var(--bf-vert-pale);">
            <div class="card-body p-4">
                <form action="{{ route('annuaire.index') }}" method="GET" class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <label class="form-label text-bf-vert fw-bold">Type de structure</label>
                        <select name="type" class="form-select border-0 shadow-sm" onchange="this.form.submit()">
                            <option value="">Toutes les structures</option>
                            @foreach($types as $key => $label)
                                <option value="{{ $key }}" {{ $type === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Alphabetical Filter -->
                    <div class="col-md-8">
                        <label class="form-label text-bf-vert fw-bold">Filtrer par nom</label>
                        <div class="d-flex flex-wrap gap-1">
                            <a href="{{ route('annuaire.index', ['type' => $type]) }}" class="btn btn-sm btn-outline-success {{ !$lettre ? 'active' : '' }}">Tous</a>
                            @foreach(range('A', 'Z') as $char)
                                <a href="{{ route('annuaire.index', ['type' => $type, 'lettre' => $char]) }}" 
                                   class="btn btn-sm btn-outline-success {{ $lettre === $char ? 'active' : '' }}">
                                    {{ $char }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results -->
        <div class="row g-4">
            @forelse($structures as $structure)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 hover-shadow border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="icon-box bg-light rounded text-bf-vert p-2">
                                <i class="bi bi-building fs-4"></i>
                            </div>
                            <span class="badge bg-light text-dark">{{ $types[$structure->type] ?? ucfirst($structure->type) }}</span>
                        </div>
                        <h5 class="card-title fw-bold">
                            <a href="{{ route('annuaire.structure', $structure->slug) }}" class="text-decoration-none text-dark stretched-link">
                                {{ $structure->nom }}
                            </a>
                        </h5>
                        @if($structure->sigle)
                            <h6 class="card-subtitle mb-3 text-muted">{{ $structure->sigle }}</h6>
                        @endif
                        <p class="card-text small text-muted">
                            <i class="bi bi-geo-alt me-1"></i> {{ Str::limit($structure->adresse, 60) }}
                        </p>
                    </div>
                    <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                        <a href="{{ route('annuaire.structure', $structure->slug) }}" class="btn btn-sm btn-outline-primary w-100 position-relative z-2">
                            Voir les détails
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">Aucune structure trouvée.</div>
            </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $structures->links() }}
        </div>
    </div>
</section>
@endsection
