@extends('layouts.app')

@section('title', 'Mon espace')

@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="dashboard-sidebar">
                    <div class="text-center mb-4">
                        <div class="bg-bf-vert-pale rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 80px; height: 80px;">
                            <i class="bi bi-person text-bf-vert" style="font-size: 2.5rem;"></i>
                        </div>
                        <h5 class="mb-0">{{ Auth::user()->nom_complet }}</h5>
                        <small class="text-muted">{{ Auth::user()->email }}</small>
                    </div>

                    <nav class="nav flex-column">
                        <a class="nav-link active" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Tableau de bord
                        </a>
                        <a class="nav-link" href="{{ route('dashboard.demandes') }}">
                            <i class="bi bi-file-earmark-text"></i> Mes demandes
                        </a>
                        <a class="nav-link" href="{{ route('dashboard.notifications') }}">
                            <i class="bi bi-bell"></i> Notifications
                            @if($stats['notifications_non_lues'] > 0)
                                <span class="badge bg-danger ms-auto">{{ $stats['notifications_non_lues'] }}</span>
                            @endif
                        </a>
                        <a class="nav-link" href="{{ route('profil') }}">
                            <i class="bi bi-person"></i> Mon profil
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="col-lg-9">
                <h2 class="mb-4">Tableau de bord</h2>

                <!-- Stats -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="icone vert">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div>
                                <div class="valeur">{{ $stats['demandes_en_cours'] }}</div>
                                <div class="label">Demandes en cours</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="icone bleu">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div>
                                <div class="valeur">{{ $stats['demandes_terminees'] }}</div>
                                <div class="label">Demandes terminées</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="icone jaune">
                                <i class="bi bi-bell"></i>
                            </div>
                            <div>
                                <div class="valeur">{{ $stats['notifications_non_lues'] }}</div>
                                <div class="label">Notifications non lues</div>
                            </div>
                        </div>
                    </div>
                </div>

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
                                            <td>{{ $demande->eservice->nom }}</td>
                                            <td>{{ $demande->created_at->format('d/m/Y') }}</td>
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
                        <div class="text-center py-4">
                            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">Aucune demande pour le moment</p>
                            <a href="{{ route('eservices.index') }}" class="btn btn-primary">
                                <i class="bi bi-laptop me-2"></i> Découvrir les e-services
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Notifications récentes -->
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Notifications récentes</h5>
                        <a href="{{ route('dashboard.notifications') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
                    </div>

                    @if($notifications->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($notifications as $notification)
                                <div class="list-group-item px-0 {{ $notification->lu ? '' : 'bg-light' }}">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">
                                            @if(!$notification->lu)
                                                <span class="badge bg-primary me-2">Nouveau</span>
                                            @endif
                                            {{ $notification->titre }}
                                        </h6>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1 text-muted">{{ $notification->message }}</p>
                                    @if($notification->lien)
                                        <a href="{{ $notification->lien }}" class="btn btn-sm btn-outline-primary">
                                            Voir les détails
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-bell-slash text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">Aucune notification</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
