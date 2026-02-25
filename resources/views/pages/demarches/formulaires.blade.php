@extends('layouts.app')
@section('title', 'Formulaires')
@section('content')
<div class="container section-padding">
    <h1 class="mb-4 fw-bold">Formulaires administratifs</h1>
    @forelse($documents as $doc)
        <div class="card-premium mb-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h3 class="h5 fw-bold mb-1">{{ $doc->title }}</h3>
                    @if($doc->description)<p class="text-muted mb-0">{{ $doc->description }}</p>@endif
                </div>
                @if($doc->file_path)
                    <a href="{{ asset('storage/' . $doc->file_path) }}" class="btn-sp btn-sp-primary" download>
                        <i class="bi bi-download me-1"></i> Télécharger
                    </a>
                @endif
            </div>
        </div>
    @empty
        <p class="text-muted">Aucun formulaire disponible pour le moment.</p>
    @endforelse
</div>
@endsection