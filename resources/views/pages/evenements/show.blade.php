@extends('layouts.app')
@section('title', $lifeEvent->title)

@section('content')
    <x-ui.hero-banner 
        :title="$lifeEvent->title" 
        :subtitle="$lifeEvent->description" 
    />

    <div class="container section-padding pt-0">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if($lifeEvent->content)
                    <div class="mb-5">
                        <div class="lead text-muted">{!! nl2br(e($lifeEvent->content)) !!}</div>
                    </div>
                @endif

                @if($procedures->isNotEmpty())
                    <h2 class="h4 fw-bold mb-4">Procédures associées</h2>
                    <div class="d-flex flex-column gap-4">
                        @foreach($procedures as $procedure)
                            <div class="card-premium flex-row align-items-center gap-4 p-4">
                                <div class="step-counter bg-soft text-bf-green rounded-circle flex-shrink-0">
                                    {{ $loop->iteration }}
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="h5 fw-bold mb-1">{{ $procedure->title }}</h3>
                                    @if($procedure->description)
                                        <p class="text-muted mb-2">{{ Str::limit($procedure->description, 150) }}</p>
                                    @endif
                                    
                                    <div class="mt-2">
                                        <a href="{{ route('fiches.show', [$procedure->category?->slug ?? 'general', $procedure->slug]) }}" class="btn-sp btn-sp-outline btn-sp-sm py-1 px-3">
                                            Voir la fiche <i class="bi bi-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-muted">Aucune procédure associée pour le moment.</p>
                @endif
            </div>
        </div>
    </div>
@endsection