@extends('layouts.app')

@section('title', 'Page non trouvée — Service Public BF')
@section('meta_description', 'La page que vous cherchez est introuvable. Retournez à l\'accueil du portail Service Public du Burkina Faso.')

@section('content')
    <section class="section-padding text-center" style="min-height: 60vh; display: flex; align-items: center;">
        <div class="container">
            <div class="mx-auto" style="max-width: 600px;">
                <div class="mb-4">
                    <span style="font-size: 6rem; font-weight: 800; color: #e5e7eb; line-height: 1;">404</span>
                </div>
                <h1 class="h3 fw-bold mb-3">Page introuvable</h1>
                <p class="text-muted mb-4">
                    Désolé, la page que vous recherchez n'existe pas ou a été déplacée.
                    Vérifiez l'adresse ou utilisez les liens ci-dessous.
                </p>
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="{{ route('home') }}" class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-home me-2"></i>Retour à l'accueil
                    </a>
                    <a href="{{ route('recherche') }}" class="btn btn-outline-dark rounded-pill px-4">
                        <i class="fas fa-search me-2"></i>Rechercher
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-envelope me-2"></i>Nous contacter
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection