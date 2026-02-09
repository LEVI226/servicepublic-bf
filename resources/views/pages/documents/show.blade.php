@extends('layouts.app')

@section('title', $document->titre)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('documents.index') }}">Documents</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($document->titre, 30) }}</li>
@endsection

@section('content')
<section class="section pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <div class="mb-4">
                                <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                    <i class="bi bi-file-earmark-pdf text-danger" style="font-size: 2.5rem;"></i>
                                </div>
                            </div>
                            <span class="badge badge-sp mb-3">{{ strtoupper($document->type) }}</span>
                            <h1 class="h2 mb-2 fw-bold">{{ $document->titre }}</h1>
                            <p class="text-muted">
                                @if($document->numero) N° {{ $document->numero }} • @endif
                                Signé le {{ $document->date_signature ? $document->date_signature->format('d/m/Y') : 'Non daté' }}
                                @if($document->structure)
                                    <br><span class="text-primary">{{ $document->structure->nom }}</span>
                                @endif
                            </p>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-10 mx-auto">
                                <div class="bg-light p-4 rounded">
                                    <h5 class="mb-3 fw-bold">Résumé</h5>
                                    <p class="lead fs-6 mb-0">{{ $document->description }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('documents.download', $document->slug) }}" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-download me-2"></i> Télécharger le document
                            </a>
                            <div class="mt-3 text-muted small">
                                Format: <span class="fw-bold">{{ strtoupper($document->format) }}</span> • 
                                Téléchargements: <span class="fw-bold">{{ $document->telechargements }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
