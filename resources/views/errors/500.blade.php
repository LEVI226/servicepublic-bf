@extends('layouts.app')

@section('title', 'Erreur serveur — Service Public BF')
@section('meta_description', 'Une erreur interne est survenue. Veuillez réessayer plus tard.')

@section('content')
    <section class="section-padding text-center" style="min-height: 60vh; display: flex; align-items: center;">
        <div class="container">
            <div class="mx-auto" style="max-width: 600px;">
                <div class="mb-4">
                    <span style="font-size: 6rem; font-weight: 800; color: #e5e7eb; line-height: 1;">500</span>
                </div>
                <h1 class="h3 fw-bold mb-3">Erreur interne du serveur</h1>
                <p class="text-muted mb-4">
                    Une erreur technique est survenue. Notre équipe a été informée et travaille à la résoudre.
                    Veuillez réessayer dans quelques instants.
                </p>
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="{{ route('home') }}" class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-home me-2"></i>Retour à l'accueil
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-envelope me-2"></i>Signaler le problème
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection