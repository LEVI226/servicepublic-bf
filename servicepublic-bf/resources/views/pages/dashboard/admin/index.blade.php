@extends('layouts.app')

@section('title', 'Espace Administrateur')

@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="dashboard-sidebar">
                    <div class="text-center mb-4">
                        <div class="bg-bf-rouge-pale rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 80px; height: 80px;">
                            <i class="bi bi-shield-lock text-bf-rouge" style="font-size: 2.5rem;"></i>
                        </div>
                        <h5 class="mb-0">{{ Auth::user()->nom_complet }}</h5>
                        <span class="badge bg-danger">Administrateur</span>
                    </div>

                    <nav class="nav flex-column">
                        <a class="nav-link active" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Tableau de bord
                        </a>
                        <a class="nav-link" href="{{ route('dashboard.demandes') }}">
                            <i class="bi bi-file-earmark-text"></i> Demandes
                        </a>
                        <a class="nav-link" href="/admin">
                            <i class="bi bi-gear"></i> Administration
                        </a>
                        <a class="nav-link" href="{{ route('profil') }}">
                            <i class="bi bi-person"></i> Mon profil
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="col-lg-9">
                <h2 class="mb-4">Tableau de bord Administrateur</h2>

                <!-- Stats -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="icone vert">
                                <i class="bi bi-people"></i>
                            </div>
                            <div>
                                <div class="valeur">{{ $stats['total_citoyens'] }}</div>
                                <div class="label">Citoyens inscrits</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="icone bleu">
                                <i class="bi bi-person-badge"></i>
                            </div>
                            <div>
                                <div class="valeur">{{ $stats['total_agents'] }}</div>
                                <div class="label">Agents</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="icone jaune">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div>
                                <div class="valeur">{{ $stats['total_demandes'] }}</div>
                                <div class="label">Demandes totales</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="icone rouge">
                                <i class="bi bi-arrow-repeat"></i>
                            </div>
                            <div>
                                <div class="valeur">{{ $stats['demandes_en_cours'] }}</div>
                                <div class="label">Demandes en cours</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="icone vert">
                                <i class="bi bi-laptop"></i>
                            </div>
                            <div>
                                <div class="valeur">{{ $stats['total_eservices'] }}</div>
                                <div class="label">E-Services</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="icone bleu">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </div>
                            <div>
                                <div class="valeur">{{ $stats['total_documents'] }}</div>
                                <div class="label">Documents</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alertes -->
                @if($nouveauxCitoyens > 0)
                    <div class="alert alert-info mb-4">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>{{ $nouveauxCitoyens }}</strong> nouveau(x) citoyen(s) s\'est/sont inscrit(s) cette semaine.
                    </div>
                @endif

                <!-- Demandes récentes -->
                <div class="dashboard-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Demandes récentes</h5>
                        <a href="{{ route('dashboard.demandes') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
                    </div>

                    @if($demandesRecentes->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Référence</th>
                                        <th>Citoyen</th>
                                        <th>Service</th>
                                        <th>Date</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($demandesRecentes as $demande)
                                        <tr>
                                            <td><code>{{ $demande->reference }}</code></td>
                                            <td>{{ $demande->user->nom_complet }}</td>
                                            <td>{{ $demande->eservice->nom }}</td>
                                            <td>{{ $demande->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $demande->statut_color }}">
                                                    {{ $demande->statut_label }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('dashboard.demandes.show', $demande->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle me-2"></i> Aucune demande pour le moment.
                        </div>
                    @endif
                </div>

                <!-- Accès rapide -->
                <div class="dashboard-card">
                    <h5 class="mb-3">Accès rapide administration</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="/admin/users" class="btn btn-outline-primary w-100 text-start">
                                <i class="bi bi-people me-2"></i> Gestion des utilisateurs
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="/admin/eservices" class="btn btn-outline-primary w-100 text-start">
                                <i class="bi bi-laptop me-2"></i> Gestion des e-services
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="/admin/structures" class="btn btn-outline-primary w-100 text-start">
                                <i class="bi bi-building me-2"></i> Gestion des structures
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="/admin/categories" class="btn btn-outline-primary w-100 text-start">
                                <i class="bi bi-folder me-2"></i> Gestion des catégories
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="/admin/documents" class="btn btn-outline-primary w-100 text-start">
                                <i class="bi bi-file-earmark-text me-2"></i> Gestion des documents
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="/admin/actualites" class="btn btn-outline-primary w-100 text-start">
                                <i class="bi bi-newspaper me-2"></i> Gestion des actualités
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
