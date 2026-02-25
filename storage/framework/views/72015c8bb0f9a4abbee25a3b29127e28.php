

<?php $__env->startSection('title', 'Accessibilité'); ?>
<?php $__env->startSection('meta_description', 'Déclaration d\'accessibilité du portail Service Public du Burkina Faso.'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginala8902021db87385247be9a842af50129 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8902021db87385247be9a842af50129 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.hero-banner','data' => ['title' => 'Accessibilité','subtitle' => 'Notre engagement pour un accès numérique inclusif.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.hero-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Accessibilité','subtitle' => 'Notre engagement pour un accès numérique inclusif.']); ?>
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
                        <h2 class="h4 text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);"><i class="fas fa-universal-access text-muted me-2"></i> Notre engagement</h2>
                        <p>Le Gouvernement du Burkina Faso s'engage à rendre le portail <strong>servicepublic.gov.bf</strong> accessible à tous les citoyens, y compris les personnes en situation de handicap.</p>
                        <p>Nous nous efforçons de respecter les normes d'accessibilité web (WCAG 2.1 niveau AA) afin de garantir une expérience utilisateur optimale pour tous.</p>
                    </div>

                    <div class="fiche-section">
                        <h2 class="h4 text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);"><i class="fas fa-check-circle text-muted me-2"></i> Mesures mises en place</h2>
                        <ul>
                            <li>Navigation possible au clavier</li>
                            <li>Lien « Aller au contenu principal » pour les lecteurs d'écran</li>
                            <li>Contrastes de couleurs conformes aux recommandations</li>
                            <li>Textes alternatifs sur les images</li>
                            <li>Structure sémantique des pages (landmarks, titres hiérarchiques)</li>
                            <li>Formulaires avec labels explicites</li>
                        </ul>
                    </div>

                    <div class="fiche-section">
                        <h2 class="h4 text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);"><i class="fas fa-tools text-muted me-2"></i> Améliorations continues</h2>
                        <p>L'accessibilité est un processus continu. Nous travaillons régulièrement à améliorer l'accessibilité de ce portail. Si vous rencontrez des difficultés d'accès, n'hésitez pas à nous contacter :</p>
                        <div class="bg-soft p-4 rounded-3 mt-3">
                            <p class="mb-2"><i class="fas fa-envelope text-bf-green me-2"></i><a href="mailto:contact@servicepublic.gov.bf">contact@servicepublic.gov.bf</a></p>
                            <p class="mb-0"><i class="fas fa-phone text-bf-green me-2"></i>(+226) 25 30 66 30</p>
                        </div>
                    </div>

                    <div class="fiche-section">
                        <h2 class="h4 text-dark border-bottom pb-2 mb-3" style="font-family: var(--font-heading);"><i class="fab fa-chrome text-muted me-2"></i> Technologies compatibles</h2>
                        <p>Ce site est optimisé pour les navigateurs modernes suivants :</p>
                        <ul>
                            <li>Google Chrome (dernière version)</li>
                            <li>Mozilla Firefox (dernière version)</li>
                            <li>Microsoft Edge (dernière version)</li>
                            <li>Safari (dernière version)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/pages/accessibilite.blade.php ENDPATH**/ ?>