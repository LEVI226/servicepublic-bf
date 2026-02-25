@extends('layouts.app')
@section('title', 'Événements de vie - Entreprises')

@section('content')
    <x-ui.hero-banner 
        title="Comment faire si ? (Entreprises)" 
        subtitle="Des guides étape par étape pour la vie de votre entreprise." 
    />

    <div class="container section-padding pt-0">
        <div class="grid-events">
            @foreach($lifeEvents as $event)
                <x-cards.event :event="$event" />
            @endforeach
        </div>
    </div>
@endsection