@extends('layouts.app')

@section('title', 'À propos - Service Public Burkina Faso')
@section('meta_description', 'Découvrez la mission, la vision et le fonctionnement du portail officiel du Service Public du Burkina Faso.')

@section('content')
    <x-ui.hero-banner 
        title="À propos du Service Public" 
        subtitle="Un accès centralisé, transparent et moderne à l'administration burkinabè." 
    />

    <div class="container section-padding">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card-premium border-0 p-4 p-md-5">
                    <h2 class="h3 fw-bold mb-4" style="font-family: var(--font-heading);">Notre Mission</h2>
                    <p class="text-muted" style="font-size: 1.1rem; line-height: 1.7;">
                        Le portail <strong>Service Public BF</strong> est la porte d'entrée numérique unique de l'administration publique du Burkina Faso. 
                        Notre mission est de simplifier le quotidien des citoyens, des entreprises et des associations en offrant un accès fluide, sécurisé et transparent à l'ensemble des démarches administratives.
                    </p>

                    <h2 class="h3 fw-bold mt-5 mb-4" style="font-family: var(--font-heading);">Une architecture souveraine</h2>
                    <p class="text-muted" style="font-size: 1.1rem; line-height: 1.7;">
                        Conçu sous le prisme d'un « Sovereign OS » (Système d'Exploitation Souverain), ce portail vise à garantir l'indépendance technologique de l'État tout en fournissant une qualité de service de standard international. Les données, l'infrastructure et le code qui propulsent cette plateforme répondent aux exigences les plus strictes en matière de sécurité et de respect de la vie privée.
                    </p>

                    <h2 class="h3 fw-bold mt-5 mb-4" style="font-family: var(--font-heading);">Engagement Qualité</h2>
                    <div class="row g-4 mt-2">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-universal-access fs-3 text-bf-green me-3 mt-1"></i>
                                <div>
                                    <h4 class="h5 fw-bold">Accessibilité inclusive</h4>
                                    <p class="text-muted small mb-0">Un design pensé pour être utilisable par tout citoyen, quel que soit l'appareil (mobile-first) ou le degré de littéracie numérique.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-shield-alt fs-3 text-bf-green me-3 mt-1"></i>
                                <div>
                                    <h4 class="h5 fw-bold">Fiabilité Officielle</h4>
                                    <p class="text-muted small mb-0">L'exhaustivité des informations juridiques, documentaires et tarifaires est mise à jour directement par les agents de l'État.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
