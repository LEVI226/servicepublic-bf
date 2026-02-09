@extends('layouts.app')

@section('title', 'Mes Demandes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
    <li class="breadcrumb-item active" aria-current="page">Demandes</li>
@endsection

@section('content')
<section class="section pt-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold mb-0">Gestion des Demandes</h2>
            <a href="{{ route('eservices.index') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-2"></i> Nouvelle Demande
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Référence</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($demandes as $demande)
                            <tr>
                                <td class="ps-4 fw-medium text-primary">#{{ $demande->reference ?? $demande->id }}</td>
                                <td>{{ $demande->eservice->nom }}</td>
                                <td>{{ $demande->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @php
                                        $badgeClass = match($demande->statut) {
                                            'soumise' => 'bg-info',
                                            'en_cours' => 'bg-primary',
                                            'traitee' => 'bg-success',
                                            'rejetee' => 'bg-danger',
                                            'annulee' => 'bg-secondary',
                                            'en_attente' => 'bg-warning text-dark',
                                            default => 'bg-light text-dark border',
                                        };
                                        $statutLabel = ucfirst(str_replace('_', ' ', $demande->statut));
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $statutLabel }}</span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('dashboard.demandes.show', $demande->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Consulter
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-folder2-open fs-1 d-block mb-3"></i>
                                        Aucune demande trouvée.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($demandes->hasPages())
            <div class="card-footer bg-white border-top-0 py-3">
                {{ $demandes->links() }}
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
