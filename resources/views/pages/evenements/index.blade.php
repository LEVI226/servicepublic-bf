@extends('layouts.app')

@section('title', 'Comment faire si ?')

@section('content')
    <x-ui.hero-banner 
        title="Comment faire si ?" 
        subtitle="Nous vous guidons dans l'ensemble des démarches pour chaque moment de vie." 
    />

    <div class="container section-padding pt-0">
        <div class="grid-events">
            @forelse($lifeEvents as $event)
                <x-cards.event :event="$event" />
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Aucun événement disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection