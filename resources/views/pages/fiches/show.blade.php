@extends('layouts.app')

@section('title', $procedure->title)
@section('meta_description', $procedure->meta_description ?? Str::limit($procedure->description, 160))

@push('jsonld')
    <x-breadcrumb-jsonld :items="$breadcrumb" />
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "HowTo",
        "name": "{{ $procedure->title }}",
        "description": "{{ Str::limit(strip_tags($procedure->description), 300) }}",
        "inLanguage": "fr-BF",
        "provider": {
            "@type": "GovernmentOrganization",
            "name": "Service Public Burkina Faso",
            "url": "{{ config('app.url') }}"
        }
    }
    </script>
@endpush

@section('content')
    <x-ui.hero-banner 
        :title="$procedure->title" 
        :subtitle="$category->name" 
        :showBreadcrumb="false"
    />

    <x-ui.breadcrumb :items="[
        'Thématiques' => route('thematiques.index'),
        $category->name => route('thematiques.show', $category->slug),
        Str::limit($procedure->title, 40) => ''
    ]" />

    <div class="container section-padding pt-0">
        <div class="row g-5">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <div class="card-premium border-0 shadow-none p-0">
                    {{-- Header Meta --}}
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="badge bg-soft text-bf-green rounded-pill px-3 py-2"><x-heroicon-o-folder class="w-4 h-4 me-1 inline-block align-text-bottom" /> {{ $category->name }}</span>
                        @if($procedure->updated_at)
                            <span class="text-muted small"><x-heroicon-o-clock class="w-4 h-4 me-1 inline-block align-text-bottom" /> Mis à jour le {{ $procedure->updated_at->format('d/m/Y') }}</span>
                        @endif
                    </div>

                    {{-- Quick Info Row Component (Coût / Délai / Public) --}}
                    <x-quick-info-row :procedure="$procedure" />

                    {{-- Sections --}}
                    <div class="d-flex flex-column gap-5 mt-4">
                        @if($procedure->description)
                            <div class="fiche-section">
                                <h2 class="h4 text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);">Description</h2>
                                <div class="text-muted" style="font-size: 1.1rem;">{!! $procedure->description !!}</div>
                            </div>
                        @endif

                        @if($procedure->conditions)
                            <div class="fiche-section">
                                <h2 class="h4 text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);"><x-heroicon-o-users class="w-6 h-6 text-muted me-2 inline-block align-text-bottom" /> Conditions</h2>
                                <div class="text-muted" style="font-size: 1.05rem;">{!! $procedure->conditions !!}</div>
                            </div>
                        @endif

                        @if($procedure->documents_required)
                            <div class="fiche-section">
                                <h2 class="h4 text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);"><x-heroicon-o-folder-open class="w-6 h-6 text-muted me-2 inline-block align-text-bottom" /> Documents à fournir</h2>
                                <div class="text-muted" style="font-size: 1.05rem;">{!! $procedure->documents_required !!}</div>
                            </div>
                        @endif

                        @if($procedure->steps && count($procedure->steps) > 0)
                            <div class="fiche-section">
                                <h2 class="h4 text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);"><x-heroicon-o-list-bullet class="w-6 h-6 text-muted me-2 inline-block align-text-bottom" /> Comment faire ?</h2>
                                <div class="d-flex flex-column gap-3">
                                    @foreach($procedure->steps as $step)
                                        <div class="card bg-soft border-0 p-3 shadow-sm">
                                            <strong class="d-block mb-1 text-dark"><x-heroicon-o-check-circle class="w-5 h-5 text-bf-green me-2 inline-block align-text-bottom" /> {{ $step['titre'] ?? $step['title'] ?? '' }}</strong>
                                            @if(isset($step['description']))
                                                <p class="text-muted mb-0 small" style="padding-left: 28px;">{{ $step['description'] }}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($procedure->more_info)
                            <div class="fiche-section mb-5">
                                <h2 class="h4 text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);"><x-heroicon-o-information-circle class="w-6 h-6 text-muted me-2 inline-block align-text-bottom" /> Informations supplémentaires</h2>
                                <div class="bg-soft p-4 rounded-3 border-start border-4 border-secondary shadow-sm">
                                    <div class="text-muted" style="font-size: 1.05rem;">{!! $procedure->more_info !!}</div>
                                    <div class="mt-4">
                                        <a href="{{ route('annuaire.index') }}" class="btn btn-outline-dark rounded-pill btn-sm fw-bold">
                                            <x-heroicon-o-magnifying-glass class="w-4 h-4 me-1 inline-block align-text-bottom" /> Chercher dans l'annuaire
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="sidebar-sticky" style="position: sticky; top: 100px;">
                    @if(isset($relatedProcedures) && $relatedProcedures->isNotEmpty())
                        <div class="fiche-sidebar-card">
                            <h3>Voir aussi</h3>
                            <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                @foreach($relatedProcedures as $related)
                                    <li>
                                        <a href="{{ route('fiches.show', [$related->category?->slug ?? $category->slug, $related->slug]) }}" class="text-decoration-none text-dark">
                                            <i class="bi bi-arrow-right-short text-bf-green"></i> {{ $related->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
