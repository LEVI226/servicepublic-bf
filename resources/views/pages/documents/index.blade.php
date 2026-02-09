@extends('layouts.app')

@section('title', 'Documents Officiels')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Documents</li>
@endsection

@section('content')
<section class="section pt-5">
    <div class="container">
        <div class="section-title">
            <h2>Documents Officiels</h2>
            <p class="subtitle">Consultez et téléchargez les textes réglementaires</p>
            <div class="barre"></div>
        </div>

        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-md-3">
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-light fw-bold text-uppercase small">
                        Filtres
                    </div>
                    <div class="card-body">
                        <h6 class="card-title text-bf-vert mb-3">Types de document</h6>
                        <div class="list-group list-group-flush mb-4">
                            <a href="{{ route('documents.index') }}" class="list-group-item list-group-item-action {{ !$type ? 'active bg-bf-vert border-bf-vert' : '' }}">Tous</a>
                            @foreach($types as $key => $label)
                                <a href="{{ route('documents.index', ['type' => $key, 'categorie' => $categorie]) }}" 
                                   class="list-group-item list-group-item-action {{ $type === $key ? 'active bg-bf-vert border-bf-vert' : '' }}">
                                    {{ $label }}
                                </a>
                            @endforeach
                        </div>

                        <h6 class="card-title text-bf-vert mb-3">Catégories</h6>
                        <div class="list-group list-group-flush">
                             <a href="{{ route('documents.index', ['type' => $type]) }}" class="list-group-item list-group-item-action {{ !$categorie ? 'active bg-bf-vert border-bf-vert' : '' }}">Toutes</a>
                            @foreach($categories as $cat)
                                <a href="{{ route('documents.index', ['categorie' => $cat->id, 'type' => $type]) }}" 
                                   class="list-group-item list-group-item-action {{ $categorie == $cat->id ? 'active bg-bf-vert border-bf-vert' : '' }}">
                                    {{ $cat->nom }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents Grid -->
            <div class="col-md-9">
                <div class="row g-4">
                    @forelse($documents as $document)
                    <div class="col-md-6">
                        <div class="card card-document h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="bg-danger bg-opacity-10 rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="bi bi-file-earmark-pdf text-danger fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <span class="badge badge-sp mb-2">{{ $document->type_label }}</span>
                                        <h5 class="card-title mb-1">
                                            <a href="{{ route('documents.show', $document->slug) }}" class="text-decoration-none text-dark">
                                                {{ $document->titre }}
                                            </a>
                                        </h5>
                                        <small class="text-muted">
                                            @if($document->numero)
                                                N° {{ $document->numero }}
                                            @endif
                                            @if($document->date_signature)
                                                | {{ $document->date_signature->format('d/m/Y') }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <p class="card-text text-muted small">{{ Str::limit($document->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                    <small class="text-muted">
                                        <i class="bi bi-download me-1"></i> {{ $document->telechargements }}
                                    </small>
                                    <div>
                                        <a href="{{ route('documents.show', $document->slug) }}" class="btn btn-sm btn-light me-1">
                                            Détails
                                        </a>
                                        <a href="{{ route('documents.download', $document->slug) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info">Aucun document trouvé avec ces critères.</div>
                    </div>
                    @endforelse
                </div>
                
                <div class="mt-5 d-flex justify-content-center">
                    {{ $documents->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
