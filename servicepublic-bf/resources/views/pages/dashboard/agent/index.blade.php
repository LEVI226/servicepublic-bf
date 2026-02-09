@extends('layouts.app')

@section('title', 'Espace Agent')

@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="dashboard-sidebar">
                    <div class="text-center mb-4">
                        <div class="bg-bf-vert-pale rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 80px; height: 80px;">
                            <i class="bi bi-person-badge text-bf-vert" style="font-size: 2.5rem;"></i>
                        </div>
                        <h5 class="mb-0">{{ Auth::user()->nom_complet }}</h5>
                        <span class="badge bg-primary">Agent</span>
                    </div>

                    <nav class="nav flex-column">
                        <a class="nav-link active" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Tableau de bord
                        </a>
                        <a class="nav-link" href="{{ route('dashboard.demandes') }}">
                            <i class="bi bi-file-earmark-text"></i> Toutes les demandes
                        </a>
                        <a class="nav-link" href="{{ route('dashboard.notifications') }}">
                            <i class="bi bi-bell"></i> Notifications
                        </a>
                        <a class="nav-link" href="{{ route('profil') }}">
                            <i class="bi bi-person"></i> Mon profil
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="col-lg-9">
                <h2 class="mb-4">Tableau de bord Agent</h2>

                <!-- Stats -->
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="icone jaune">
                                <i class="bi bi-hourglass-split"></i>
                            </div>
                            <div>
                                <div class="valeur">{{ $stats['demandes_en_attente'] }}</div>
                                <div class="label">En attente</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="icone vert">
                                <i class="bi bi-arrow-repeat"></i>
                            </div>
                            <div>
                                <div class="valeur">{{ $stats['demandes_en_cours'] }}</div>
                                <div class="label">En cours</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="icone bleu">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div>
                                <div class="valeur">{{ $stats['demandes_traitees_aujourd'hui'] }}</div>
                                <div class="label">Traitées aujourd'hui</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="icone rouge">
                                <i class="bi bi-files"></i>
                            </div>
                            <div>
                                <div class="valeur">{{ $stats['total_demandes'] }}</div>
                                <div class="label">Total demandes</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Demandes en attente -->
                <div class="dashboard-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Demandes en attente de traitement</h5>
                        <a href="{{ route('dashboard.demandes') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
                    </div>

                    @if($demandesEnAttente->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Référence</th>
                                        <th>Citoyen</th>
                                        <th>Service</th>
                                        <th>Date de soumission</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($demandesEnAttente as $demande)
                                        <tr>
                                            <td><code>{{ $demande->reference }}</code></td>
                                            <td>{{ $demande->user->nom_complet }}</td>
                                            <td>{{ $demande->eservice->nom }}</td>
                                            <td>{{ $demande->date_soumission?->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('dashboard.demandes.show', $demande->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-eye me-1"></i> Traiter
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle me-2"></i> Aucune demande en attente de traitement.
                        </div>
                    @endif
                </div>

                <!-- Mes dernières demandes traitées -->
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Mes dernières demandes traitées</h5>
                        <a href="{{ route('dashboard.demandes') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
                    </div>

                    @if($mesDemandes->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Référence</th>
                                        <th>Citoyen</th>
                                        <th>Service</th>
                                        <th>Date de traitement</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mesDemandes as $demande)
                                        <tr>
                                            <td><code>{{ $demande->reference }}</code></td>
                                            <td>{{ $demande->user->nom_complet }}</td>
                                            <td>{{ $demande->eservice->nom }}</td>
                                            <td>{{ $demande->date_traitement?->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $demande->statut_color }}">
                                                    {{ $demande->statut_label }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle me-2"></i> Vous n\'avez pas encore traité de demandes.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
