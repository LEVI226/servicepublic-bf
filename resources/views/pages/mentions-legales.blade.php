@extends('layouts.app')

@section('title', 'Mentions légales')
@section('meta_description', 'Mentions légales du portail Service Public du Burkina Faso.')

@section('content')
    <x-ui.hero-banner 
        title="Mentions légales" 
        subtitle="Informations légales relatives au portail Service Public du Burkina Faso." 
    />

    <div class="container section-padding pt-0">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card-premium p-4 p-lg-5">
                    <div class="fiche-section">
                        <h2 class="h4 text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);"><i class="fas fa-building text-muted me-2"></i> Éditeur du site</h2>
                        <p>Le portail <strong>servicepublic.gov.bf</strong> est édité par le Gouvernement du Burkina Faso, à travers le Ministère de la Transition Digitale, des Postes et des Communications Électroniques.</p>
                        <ul>
                            <li><strong>Adresse :</strong> Ouagadougou, Burkina Faso</li>
                            <li><strong>Téléphone :</strong> (+226) 25 30 66 30</li>
                            <li><strong>Email :</strong> <a href="mailto:contact@servicepublic.gov.bf">contact@servicepublic.gov.bf</a></li>
                        </ul>
                    </div>

                    <div class="fiche-section">
                        <h2 class="h4 text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);"><i class="fas fa-server text-muted me-2"></i> Hébergement</h2>
                        <p>Le site est hébergé par les services techniques du Gouvernement du Burkina Faso.</p>
                    </div>

                    <div class="fiche-section">
                        <h2 class="h4 text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);"><i class="fas fa-shield-alt text-muted me-2"></i> Protection des données personnelles</h2>
                        <p>Le portail Service Public respecte la vie privée de ses utilisateurs. Les données personnelles collectées via les formulaires de contact sont uniquement utilisées pour traiter les demandes et ne sont jamais transmises à des tiers.</p>
                        <p>Conformément à la loi applicable en matière de protection des données personnelles, vous disposez d'un droit d'accès, de rectification et de suppression de vos données. Pour exercer ces droits, adressez votre demande à <a href="mailto:contact@servicepublic.gov.bf">contact@servicepublic.gov.bf</a>.</p>
                    </div>

                    <div class="fiche-section">
                        <h2 class="h4 text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);"><i class="fas fa-copyright text-muted me-2"></i> Propriété intellectuelle</h2>
                        <p>L'ensemble du contenu du site (textes, images, logos, icônes) est la propriété du Gouvernement du Burkina Faso ou de ses partenaires. Toute reproduction, même partielle, est soumise à autorisation préalable.</p>
                    </div>

                    <div class="fiche-section">
                        <h2 class="h4 text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);"><i class="fas fa-link text-muted me-2"></i> Liens hypertextes</h2>
                        <p>Le portail peut contenir des liens vers des sites tiers. Le Gouvernement du Burkina Faso décline toute responsabilité quant au contenu de ces sites externes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
