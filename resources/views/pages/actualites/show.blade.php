@extends('layouts.app')

@section('title', $actualite->titre)

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Actualités</li>
    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($actualite->titre, 30) }}</li>
@endsection

@section('content')
<section class="section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article class="card shadow-sm border-0 mb-5">
                    @if($actualite->image)
                        <img src="{{ asset('storage/' . $actualite->image) }}" class="card-img-top" alt="{{ $actualite->titre }}" style="max-height: 400px; object-fit: cover;">
                    @endif
                    <div class="card-body p-4 p-md-5">
                        <div class="mb-3">
                            <span class="badge badge-sp">{{ $actualite->type_label }}</span>
                            <span class="text-muted ms-2 small"><i class="bi bi-calendar me-1"></i> Publié le {{ $actualite->date_publication->format('d/m/Y') }}</span>
                        </div>
                        
                        <h1 class="card-title display-6 fw-bold mb-4">{{ $actualite->titre }}</h1>
                        
                        <div class="lead text-muted mb-4 fst-italic ps-4 border-start border-4 border-success">
                            {{ $actualite->resume }}
                        </div>
                        
                        <div class="content-article">
                            {!! $actualite->contenu !!}
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-lg-4">
                @if($actualitesSimilaires->count() > 0)
                <div class="card shadow-sm border-0 mb-4 bg-light">
                    <div class="card-header bg-transparent fw-bold py-3 border-bottom">
                        Dernières actualités
                    </div>
                    <div class="list-group list-group-flush bg-transparent">
                        @foreach($actualitesSimilaires as $actu)
                        <a href="{{ route('actualites.show', $actu->slug) }}" class="list-group-item list-group-item-action bg-transparent py-3">
                            <h6 class="mb-1 text-dark fw-medium">{{ $actu->titre }}</h6>
                            <small class="text-muted">{{ $actu->date_publication->diffForHumans() }}</small>
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
