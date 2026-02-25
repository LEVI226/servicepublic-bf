

<?php $__env->startSection('title', 'Mentions légales'); ?>
<?php $__env->startSection('meta_description', 'Mentions légales du portail Service Public du Burkina Faso.'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginala8902021db87385247be9a842af50129 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8902021db87385247be9a842af50129 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.hero-banner','data' => ['title' => 'Mentions légales','subtitle' => 'Informations légales relatives au portail Service Public du Burkina Faso.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.hero-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Mentions légales','subtitle' => 'Informations légales relatives au portail Service Public du Burkina Faso.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8902021db87385247be9a842af50129)): ?>
<?php $attributes = $__attributesOriginala8902021db87385247be9a842af50129; ?>
<?php unset($__attributesOriginala8902021db87385247be9a842af50129); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8902021db87385247be9a842af50129)): ?>
<?php $component = $__componentOriginala8902021db87385247be9a842af50129; ?>
<?php unset($__componentOriginala8902021db87385247be9a842af50129); ?>
<?php endif; ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/pages/mentions-legales.blade.php ENDPATH**/ ?>