<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Portail des Services Publics du Burkina Faso - Accédez aux démarches administratives, e-services et informations des ministères et institutions')">
    <meta name="keywords" content="@yield('meta_keywords', 'service public, Burkina Faso, démarches administratives, e-services, ministères')">
    <meta name="author" content="Gouvernement du Burkina Faso">
    
    <title>@yield('title', 'Service Public') - Burkina Faso</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body>
    <!-- Barre officielle -->
    <div class="barre-officielle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span class="devise">
                        <i class="bi bi-flag-fill me-2"></i>
                        BURKINA FASO - Unité - Progrès - Justice
                    </span>
                </div>
                <div class="col-md-6 text-md-end contact-info">
                    <a href="tel:+22625306630" class="me-3">
                        <i class="bi bi-telephone-fill me-1"></i> (+226) 25 30 66 30
                    </a>
                    <a href="mailto:contact@servicepublic.gov.bf">
                        <i class="bi bi-envelope-fill me-1"></i> contact@servicepublic.gov.bf
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Header principal -->
    <header class="header-principal">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <a href="{{ route('home') }}" class="logo text-decoration-none">
                        <img src="{{ asset('images/armoirie-burkina-faso.png') }}" alt="Armoiries du Burkina Faso">
                        <div class="logo-text">
                            <span class="logo-titre">SERVICE PUBLIC</span>
                            <span class="logo-sous-titre">Service Public de l'Administration Burkinabè</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 mt-3 mt-lg-0">
                    <div class="d-flex justify-content-lg-end align-items-center gap-3">
                        <!-- Recherche -->
                        <form action="{{ route('recherche') }}" method="GET" class="d-flex">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Rechercher..." aria-label="Rechercher">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                        
                        <!-- Boutons d'action -->
                        <a href="{{ route('suivi') }}" class="btn btn-outline-primary">
                            <i class="bi bi-truck me-1"></i> Suivi
                        </a>
                        
                        @auth
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->prenom }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Mon espace</a></li>
                                    <li><a class="dropdown-item" href="{{ route('profil') }}"><i class="bi bi-person"></i> Mon profil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="bi bi-person me-1"></i> Connexion
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation principale -->
    <nav class="navbar navbar-expand-lg navbar-principale sticky-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i> ACCUEIL
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('particuliers.*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-people me-1"></i> PARTICULIERS
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('particuliers.index') }}"><i class="bi bi-grid"></i> Toutes les catégories</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @foreach(\App\Models\Categorie::particuliers()->racines()->limit(5)->get() as $cat)
                                <li><a class="dropdown-item" href="{{ route('particuliers.categorie', $cat->slug) }}"><i class="bi bi-{{ $cat->icone ?? 'folder' }}"></i> {{ $cat->nom }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('entreprises.*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-building me-1"></i> ENTREPRISES
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('entreprises.index') }}"><i class="bi bi-grid"></i> Toutes les catégories</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @foreach(\App\Models\Categorie::entreprises()->racines()->limit(5)->get() as $cat)
                                <li><a class="dropdown-item" href="{{ route('entreprises.categorie', $cat->slug) }}"><i class="bi bi-{{ $cat->icone ?? 'folder' }}"></i> {{ $cat->nom }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('documents.*') ? 'active' : '' }}" href="{{ route('documents.index') }}">
                            <i class="bi bi-file-earmark-text me-1"></i> DOCUMENTS
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('eservices.*') ? 'active' : '' }}" href="{{ route('eservices.index') }}">
                            <i class="bi bi-laptop me-1"></i> E-SERVICES
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('annuaire.*') ? 'active' : '' }}" href="{{ route('annuaire.index') }}">
                            <i class="bi bi-building-gear me-1"></i> ANNUAIRE
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}" href="{{ route('faq') }}">
                            <i class="bi bi-question-circle me-1"></i> FAQ
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Fil d'Ariane -->
    @hasSection('breadcrumb')
        <nav aria-label="breadcrumb" class="breadcrumb">
            <div class="container">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    @yield('breadcrumb')
                </ol>
            </div>
        </nav>
    @endif

    <!-- Contenu principal -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Logo et description -->
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="logo-footer">
                        <img src="{{ asset('images/armoirie-burkina-faso.png') }}" alt="Armoiries du Burkina Faso">
                        <div>
                            <div class="text-white fw-bold">SERVICE PUBLIC</div>
                            <div class="devise-footer">Unité - Progrès - Justice</div>
                        </div>
                    </div>
                    <p class="mb-4">Le portail des services publics du Burkina Faso vous accompagne dans vos démarches administratives et vous donne accès aux informations des ministères et institutions.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width: 40px; height: 40px;">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width: 40px; height: 40px;">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width: 40px; height: 40px;">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Liens rapides -->
                <div class="col-lg-2 col-md-4 mb-4 mb-lg-0">
                    <h5>Services</h5>
                    <a href="{{ route('particuliers.index') }}">Particuliers</a>
                    <a href="{{ route('entreprises.index') }}">Entreprises</a>
                    <a href="{{ route('eservices.index') }}">E-Services</a>
                    <a href="{{ route('documents.index') }}">Documents</a>
                    <a href="{{ route('annuaire.index') }}">Annuaire</a>
                </div>
                
                <div class="col-lg-2 col-md-4 mb-4 mb-lg-0">
                    <h5>Informations</h5>
                    <a href="{{ route('faq') }}">FAQ</a>
                    <a href="#">Accessibilité</a>
                    <a href="#">Plan du site</a>
                    <a href="#">Mentions légales</a>
                    <a href="#">Cookies</a>
                </div>
                
                <!-- Annuaire officiel -->
                <div class="col-lg-2 col-md-4 mb-4 mb-lg-0">
                    <h5>Annuaire</h5>
                    <a href="{{ route('annuaire.structure', 'presidence') }}">Présidence</a>
                    <a href="{{ route('annuaire.structure', 'primature') }}">Primature</a>
                    <a href="{{ route('annuaire.structure', 'assemblee') }}">Assemblée Nationale</a>
                    <a href="{{ route('annuaire.index') }}">Ministères</a>
                    <a href="{{ route('annuaire.index') }}">Institutions</a>
                </div>
                
                <!-- Contact -->
                <div class="col-lg-2">
                    <h5>Contact</h5>
                    <p class="mb-2">
                        <i class="bi bi-geo-alt me-2"></i>
                        Ouagadougou, Burkina Faso
                    </p>
                    <p class="mb-2">
                        <i class="bi bi-telephone me-2"></i>
                        (+226) 25 30 66 30
                    </p>
                    <p class="mb-2">
                        <i class="bi bi-envelope me-2"></i>
                        contact@servicepublic.gov.bf
                    </p>
                </div>
            </div>
            
            <!-- Footer bottom -->
            <div class="footer-bottom">
                <p class="mb-0">
                    &copy; {{ date('Y') }} Service Public de l'Administration du Burkina Faso. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
