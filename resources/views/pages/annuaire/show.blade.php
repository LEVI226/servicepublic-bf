@extends('layouts.app')

@section('title', $structure->nom)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('annuaire.index') }}">Annuaire</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($structure->nom, 30) }}</li>
@endsection

@section('content')
<section class="section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Structure Header -->
                <div class="card border-0 shadow-sm mb-5">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex align-items-start">
                            <div class="icon-box bg-bf-vert-pale text-bf-vert rounded p-3 me-4 d-none d-md-block">
                                <i class="bi bi-building" style="font-size: 2.5rem;"></i>
                            </div>
                            <div>
                                <h1 class="card-title h2 mb-2 fw-bold">{{ $structure->nom }}</h1>
                                @if($structure->sigle)
                                    <h5 class="text-muted mb-3">{{ $structure->sigle }}</h5>
                                @endif
                                <div class="mb-4">
                                    <span class="badge bg-bf-vert text-white py-2 px-3">{{ ucfirst($structure->type) }}</span>
                                </div>
                                <p class="card-text text-muted">{{ $structure->description }}</p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row g-4">
                            <div class="col-md-6">
                                <h5 class="fw-bold mb-3"><i class="bi bi-geo-alt me-2 text-bf-vert"></i> Adresse</h5>
                                <p class="mb-2 text-muted">{{ $structure->adresse ?? 'Non renseignée' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="fw-bold mb-3"><i class="bi bi-telephone me-2 text-bf-vert"></i> Contact</h5>
                                <ul class="list-unstyled text-muted mb-0">
                                    @if($structure->telephone)
                                        <li class="mb-2"><a href="tel:{{ $structure->telephone }}" class="text-decoration-none text-muted hover-primary">{{ $structure->telephone }}</a></li>
                                    @endif
                                    @if($structure->email)
                                        <li class="mb-2"><a href="mailto:{{ $structure->email }}" class="text-decoration-none text-muted hover-primary">{{ $structure->email }}</a></li>
                                    @endif
                                    @if($structure->site_web)
                                        <li><a href="{{ $structure->site_web }}" target="_blank" class="text-decoration-none text-primary"><i class="bi bi-link-45deg"></i> Site web officiel</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- E-Services -->
                @if($structure->eservices->count() > 0)
                <div class="mb-5">
                    <div class="d-flex align-items-center mb-4">
                        <h3 class="h4 mb-0 fw-bold">Services en ligne</h3>
                        <div class="ms-3 flex-grow-1 border-bottom"></div>
                    </div>
                    <div class="row g-4">
                        @foreach($structure->eservices as $service)
                        <div class="col-md-12">
                            <div class="card card-eservice h-100 p-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 fw-bold">{{ $service->nom }}</h5>
                                        <p class="mb-0 text-muted small">{{ Str::limit($service->description, 120) }}</p>
                                    </div>
                                    <a href="{{ route('eservices.show', $service->slug) }}" class="btn btn-sm btn-outline-primary ms-3">Accéder</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Documents Recents -->
                @if($structure->documents->count() > 0)
                <div class="mb-5">
                    <div class="d-flex align-items-center mb-4">
                        <h3 class="h4 mb-0 fw-bold">Documents récents</h3>
                        <div class="ms-3 flex-grow-1 border-bottom"></div>
                    </div>
                    <div class="list-group shadow-sm">
                        @foreach($structure->documents as $doc)
                        <a href="{{ route('documents.show', $doc->slug) }}" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                            <i class="bi bi-file-earmark-text text-danger fs-5 me-3"></i>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-medium">{{ $doc->titre }}</h6>
                                <small class="text-muted">{{ $doc->date_signature ? 'Signé le ' . $doc->date_signature->format('d/m/Y') : '' }}</small>
                            </div>
                            <i class="bi bi-chevron-right text-muted small"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="col-lg-4">
                <!-- Structures rattachées -->
                @if($structure->enfants->count() > 0)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white fw-bold py-3 border-bottom">Structures rattachées</div>
                    <div class="list-group list-group-flush">
                        @foreach($structure->enfants as $child)
                        <a href="{{ route('annuaire.structure', $child->slug) }}" class="list-group-item list-group-item-action py-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-arrow-return-right text-muted me-2"></i>
                                {{ $child->nom }}
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
