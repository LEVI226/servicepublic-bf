<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Service Public du Burkina Faso — Portail officiel des démarches administratives, fiches pratiques et services en ligne.')">
    <title>@yield('title', 'Service Public — Burkina Faso')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/armoirie.png') }}">
    
    {{-- SEO & OpenGraph --}}
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Service Public — Burkina Faso')">
    <meta property="og:description" content="@yield('meta_description', 'Portail officiel des démarches administratives, fiches pratiques et services en ligne.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="@yield('og_image', asset('img/armoirie.png'))">
    <meta property="og:locale" content="fr_BF">
    <meta property="og:site_name" content="Service Public Burkina Faso">
    @stack('jsonld')

    {{-- Local Institutional Fonts & Core CSS --}}
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/all.min.css') }}">
    <!-- Restored Bootstrap Icons for existing legacy icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    @stack('styles')
</head>
<body>

    {{-- Skip to Content (Accessibility) --}}
    <a href="#main-content" class="skip-to-content">Aller au contenu principal</a>

    <div class="tricolor-band"></div>

    <div class="official-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="devise d-flex align-items-center text-muted">
                <img src="{{ asset('img/drapeau.png') }}" alt="Drapeau du Burkina Faso" height="20" class="me-2">
                <span class="d-none d-sm-inline fw-bold">BURKINA FASO — Unité – Progrès – Justice</span>
                <span class="d-inline d-sm-none fw-bold">Unité – Progrès – Justice</span>
            </div>
            <div class="d-none d-md-flex gap-4">
                <a href="tel:+22625306630" class="text-muted text-decoration-none hover-text-dark"><i class="bi bi-telephone me-1"></i> (+226) 25 30 66 30</a>
                <a href="mailto:contact@servicepublic.gov.bf" class="text-muted text-decoration-none hover-text-dark"><i class="bi bi-envelope me-1"></i> contact@servicepublic.gov.bf</a>
            </div>
        </div>
    </div>

    <header class="main-header">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none">
                <img src="{{ asset('img/armoirie.png') }}" alt="Armoiries du Burkina Faso" height="60" class="me-3">
                <div>
                    <div class="h4 fw-bold text-uppercase mb-0 text-dark ls-1">Service Public</div>
                    <div class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 1px;">Gouvernement du Burkina Faso</div>
                </div>
            </a>
            
            <div class="d-none d-lg-flex gap-3">
                <a href="{{ route('faq') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Aide & FAQ</a>
                <a href="/admin" class="btn btn-sm btn-outline-secondary rounded-pill px-3"><i class="bi bi-gear me-1"></i>Administration</a>
            </div>
        </div>
    </header>

    <div class="nav-wrapper">
        <nav class="navbar navbar-expand-lg nav-bar navbar-dark" aria-label="Navigation principale">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Ouvrir le menu de navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav me-auto mb-0 w-100 justify-content-between py-1">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('thematiques.*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Thématiques
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('thematiques.index') }}">Toutes les thématiques</a></li>
                                <li><hr class="dropdown-divider"></li>
                                @foreach(\App\Models\Category::where('is_active', true)->orderBy('order')->take(8)->get() as $cat)
                                    <li><a class="dropdown-item" href="{{ route('thematiques.show', $cat->slug) }}">{{ $cat->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('evenements.*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Événements de vie
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('evenements.index') }}">Tous les événements</a></li>
                                <li><hr class="dropdown-divider"></li>
                                @foreach($navLifeEvents ?? [] as $navEvent)
                                    <li><a class="dropdown-item" href="{{ route('evenements.show', $navEvent->slug) }}">{{ $navEvent->title }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('eservices.index') }}" class="nav-link {{ request()->routeIs('eservices.*') ? 'active' : '' }}">E-services</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('annuaire.index') }}" class="nav-link {{ request()->routeIs('annuaire.*') ? 'active' : '' }}">Annuaire</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('entreprises.index') }}" class="nav-link {{ request()->routeIs('entreprises.*') ? 'active' : '' }}">Espace Entreprises</a>
                        </li>
                        <li class="nav-item d-flex align-items-center ms-lg-3">
                            <a href="{{ route('actualites.index') }}" class="nav-link {{ request()->routeIs('actualites.*') ? 'active' : '' }}"><i class="fas fa-newspaper me-1"></i> Actualités</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <main id="main-content">
        @yield('content')
    </main>

    <footer class="main-footer">
        <div class="container">
            <div class="footer-top row g-4 mb-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('img/armoirie.png') }}" alt="Logo" height="40" class="me-3 opacity-50">
                        <span class="h6 fw-bold mb-0 text-uppercase ls-1">Service Public</span>
                    </div>
                    <p class="text-white-50 small">Le portail officiel pour vos démarches administratives au Burkina Faso.</p>
                </div>
                <div class="col-6 col-lg-2 ms-lg-auto">
                    <h6 class="fw-bold mb-3 text-white">Découvrir</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('actualites.index') }}" class="text-white-50 text-decoration-none small">Actualités</a></li>
                        <li class="mb-2"><a href="{{ route('evenements.index') }}" class="text-white-50 text-decoration-none small">Événements de vie</a></li>
                        <li class="mb-2"><a href="{{ route('thematiques.index') }}" class="text-white-50 text-decoration-none small">Thématiques</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="fw-bold mb-3 text-white">Administration</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('annuaire.index') }}" class="text-white-50 text-decoration-none small">Annuaire</a></li>
                        <li class="mb-2"><a href="{{ route('eservices.index') }}" class="text-white-50 text-decoration-none small">Services en ligne</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="fw-bold mb-3 text-white">Aide</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('faq') }}" class="text-white-50 text-decoration-none small">Foire aux questions (FAQ)</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}" class="text-white-50 text-decoration-none small">Nous contacter</a></li>
                        <li class="mb-2"><a href="{{ route('plan-du-site') }}" class="text-white-50 text-decoration-none small">Plan du site</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom text-center">
                <div class="mb-2 text-white-50">&copy; {{ date('Y') }} Service Public. Gouvernement du Burkina Faso.</div>
                <div class="d-flex justify-content-center gap-3 text-white-50 small">
                    <a href="{{ route('mentions-legales') }}" class="footer-link text-white-50 mb-0">Mentions légales</a>
                    <a href="{{ route('accessibilite') }}" class="footer-link text-white-50 mb-0">Accessibilité</a>
                    <a href="{{ route('contact') }}" class="footer-link text-white-50 mb-0">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
