@extends('layouts.app')
@section('title', $organisme->name)
@section('meta_description', Str::limit($organisme->description ?? 'Fiche de l\'organisme ' . $organisme->name, 160))

@section('content')
    <div class="fil-ariane">
        <div class="container">
            <a href="{{ route('home') }}">Accueil</a>
            <span class="separator">›</span>
            <a href="{{ route('annuaire.index') }}">Annuaire</a>
            <span class="separator">›</span>
            <span class="current">{{ $organisme->name }}</span>
        </div>
    </div>

    <div class="container section-padding">
        <div class="row g-5">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">{{ $organisme->name }}</h1>
                
                @if($organisme->acronym)
                    <p class="text-muted lead">{{ $organisme->acronym }}</p>
                @endif
                
                @if($organisme->description)
                    <div class="fiche-section">
                        <h2><i class="bi bi-bullseye"></i> Description</h2>
                        <div>{!! nl2br(e($organisme->description)) !!}</div>
                    </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="fiche-sidebar-card">
                    <h3>Coordonnées</h3>
                    @if($organisme->address)
                        <p><i class="bi bi-geo-alt-fill text-bf-green me-2"></i>{{ $organisme->address }}</p>
                    @endif
                    @if($organisme->phone)
                        <p><i class="bi bi-telephone-fill text-bf-green me-2"></i>{{ $organisme->phone }}</p>
                    @endif
                    @if($organisme->email)
                        <p><i class="bi bi-envelope-fill text-bf-green me-2"></i><a href="mailto:{{ $organisme->email }}">{{ $organisme->email }}</a></p>
                    @endif
                    @if($organisme->website)
                        <p><i class="bi bi-globe text-bf-green me-2"></i><a href="{{ $organisme->website }}" target="_blank" rel="noopener">{{ $organisme->website }}</a></p>
                    @endif
                    @if($organisme->hours)
                        <p><i class="bi bi-clock text-bf-green me-2"></i>{{ $organisme->hours }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection