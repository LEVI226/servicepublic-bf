@extends('layouts.app')

@section('title', 'Suivi de demande')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Suivi</li>
@endsection

@section('content')
<section class="section pt-5" style="min-height: 60vh;">
    <div class="container">
        <div class="section-title">
            <h2>Suivi de votre demande</h2>
            <p class="subtitle">Vérifiez l'état d'avancement de votre dossier en temps réel</p>
            <div class="barre"></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0 overflow-hidden">
                    <div class="card-header bg-bf-vert text-white py-4 text-center">
                        <div class="mb-3">
                            <i class="bi bi-search fs-1"></i>
                        </div>
                        <h4 class="card-title mb-0 text-white">Vérification de statut</h4>
                    </div>
                    <div class="card-body p-5">
                        <p class="text-center text-muted mb-4">Saisissez votre numéro de référence unique (ex: DEM-2024-XXXX) reçu lors du dépôt de votre demande.</p>
                        
                        <form action="{{ route('suivi.verifier') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="reference" class="form-label text-uppercase small fw-bold">Numéro de référence</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-upc-scan"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0" id="reference" name="reference" placeholder="DEM-..." required>
                                </div>
                                @error('reference')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 uppercase">
                                Vérifier le statut
                            </button>
                        </form>
                    </div>
                    <div class="card-footer bg-light p-3 text-center small text-muted">
                        Besoin d'assistance ? <a href="{{ route('contact') }}">Contactez le support</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
