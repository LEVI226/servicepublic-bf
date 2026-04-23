@extends('layouts.app')
@section('title', $organisme->name)
@section('meta_description', Str::limit($organisme->description ?? 'Fiche de l\'organisme ' . $organisme->name, 160))

@section('content')
    <x-ui.hero-banner 
        :title="$organisme->name" 
        :subtitle="$organisme->acronym ?? 'Fiche de l\'organisme'" 
        :showBreadcrumb="false"
    />

    <x-ui.breadcrumb :items="['Annuaire' => route('annuaire.index'), $organisme->name => '']" />

    <div class="container section-padding">
        <div class="row g-5">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">{{ $organisme->name }}</h1>
                
                @if($organisme->acronym)
                    <p class="text-muted lead">{{ $organisme->acronym }}</p>
                @endif
                
                @if($organisme->description)
                    <div class="card-premium border-0 shadow-sm p-4 mb-4">
                        <h2 class="h4 fw-bold text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);">
                            <i class="bi bi-info-circle text-bf-green me-2"></i>Missions & Description
                        </h2>
                        <div class="text-muted lead" style="font-size: 1.1rem;">{!! nl2br(e($organisme->description)) !!}</div>
                    </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="fiche-sidebar-card shadow-sm border-0">
                    <h3 class="h5 fw-bold mb-4 border-bottom pb-2">Coordonnées</h3>
                    <div class="d-flex flex-column gap-3">
                        @if($organisme->address)
                            <div class="d-flex">
                                <i class="bi bi-geo-alt-fill text-bf-green me-3 mt-1"></i>
                                <div>
                                    <span class="d-block small text-muted">Adresse</span>
                                    <span class="fw-medium">{{ $organisme->address }}</span>
                                </div>
                            </div>
                        @endif
                        @if($organisme->phone)
                            <div class="d-flex">
                                <i class="bi bi-telephone-fill text-bf-green me-3 mt-1"></i>
                                <div>
                                    <span class="d-block small text-muted">Téléphone</span>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $organisme->phone) }}" class="text-decoration-none text-dark fw-medium">{{ $organisme->phone }}</a>
                                </div>
                            </div>
                        @endif
                        @if($organisme->email)
                            <div class="d-flex">
                                <i class="bi bi-envelope-fill text-bf-green me-3 mt-1"></i>
                                <div class="text-truncate">
                                    <span class="d-block small text-muted">Email</span>
                                    <a href="mailto:{{ $organisme->email }}" class="text-decoration-none text-dark fw-medium text-truncate d-block">{{ $organisme->email }}</a>
                                </div>
                            </div>
                        @endif
                        @if($organisme->website)
                            <div class="d-flex">
                                <i class="bi bi-globe text-bf-green me-3 mt-1"></i>
                                <div class="text-truncate">
                                    <span class="d-block small text-muted">Site Web</span>
                                    <a href="{{ $organisme->website }}" target="_blank" rel="noopener" class="text-decoration-none text-bf-green fw-medium text-truncate d-block">{{ str_replace(['http://', 'https://'], '', $organisme->website) }}</a>
                                </div>
                            </div>
                        @endif
                        @if($organisme->hours)
                            <div class="d-flex">
                                <i class="bi bi-clock-fill text-bf-green me-3 mt-1"></i>
                                <div>
                                    <span class="d-block small text-muted">Horaires d'ouverture</span>
                                    <span class="fw-medium">{{ $organisme->hours }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection