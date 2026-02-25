@extends('layouts.app')
@section('title', 'Contact')
@section('meta_description', 'Contactez le service public du Burkina Faso pour toute question relative à vos démarches administratives.')

@section('content')
    <x-ui.hero-banner
        title="Nous contacter"
        subtitle="Une question sur vos démarches ? Contactez-nous."
    />

    <div class="container section-padding pt-0">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="card-premium">
                    <h2 class="h3 fw-bold mb-4" style="font-family: var(--font-heading);">Envoyez-nous un message</h2>

                    @if(session('success'))
                        <div class="alert-success-sp mb-4">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger rounded-3 mb-4">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.envoyer') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label fw-semibold">Nom complet</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="sujet" class="form-label fw-semibold">Sujet</label>
                            <input type="text" class="form-control @error('sujet') is-invalid @enderror" id="sujet" name="sujet" value="{{ old('sujet') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label fw-semibold">Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn-sp btn-sp-primary">
                            <i class="fas fa-paper-plane me-1"></i> Envoyer
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="fiche-sidebar-card">
                    <h2 class="h3 fw-bold mb-4" style="font-family: var(--font-heading);">Nos coordonnées</h2>
                    <div class="mb-3">
                        <i class="fas fa-phone text-bf-green me-2"></i>
                        <a href="tel:+22625306630" class="text-decoration-none text-dark">(+226) 25 30 66 30</a>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-phone text-bf-green me-2"></i>
                        <a href="tel:+22625304110" class="text-decoration-none text-dark">(+226) 25 30 41 10</a>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-envelope text-bf-green me-2"></i>
                        <a href="mailto:contact@servicepublic.gov.bf" class="text-decoration-none text-dark">contact@servicepublic.gov.bf</a>
                    </div>
                    <hr class="my-4">
                    <div class="mb-3">
                        <i class="fas fa-map-marker-alt text-bf-green me-2"></i>
                        <span>Ouagadougou, Burkina Faso</span>
                    </div>
                    <div>
                        <i class="fas fa-clock text-bf-green me-2"></i>
                        <span>Lun – Ven : 07h30 – 12h30, 15h – 17h30</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection