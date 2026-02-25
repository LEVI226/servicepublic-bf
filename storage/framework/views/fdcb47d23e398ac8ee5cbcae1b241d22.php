
<?php $__env->startSection('title', 'Portail Entreprises'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginala8902021db87385247be9a842af50129 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8902021db87385247be9a842af50129 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.hero-banner','data' => ['title' => 'Portail Entreprises','subtitle' => 'Toutes les démarches pour créer, gérer et développer votre entreprise au Burkina Faso.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.hero-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Portail Entreprises','subtitle' => 'Toutes les démarches pour créer, gérer et développer votre entreprise au Burkina Faso.']); ?>
        <div class="mt-4 pb-2">
            <span class="badge bg-white text-dark mb-3 px-3 py-2 rounded-pill fw-bold shadow-sm d-inline-flex align-items-center border"><i class="bi bi-briefcase-fill text-success me-2"></i>Espace Professionnels</span>
            <form action="<?php echo e(route('recherche')); ?>" method="GET" class="search-wrapper bg-white p-2 rounded-pill d-flex shadow-sm mx-auto" style="max-width: 600px; border: 1px solid #dee2e6;">
                <i class="bi bi-search text-muted ms-3 d-flex align-items-center"></i>
                <input type="text" name="q" class="form-control border-0 shadow-none px-3 bg-transparent" placeholder="Rechercher une démarche entreprise..." aria-label="Recherche">
                <button class="btn btn-dark rounded-pill px-4 fw-bold shadow-sm" type="submit">Rechercher</button>
            </form>
        </div>
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
    <!-- 🌟 Démarches Populaires B2B -->
    <section class="section-padding bg-soft">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h2 class="mb-2 fw-bold text-dark">Démarches les plus demandées</h2>
                    <p class="text-muted mb-0">Les procédures les plus consultées par les professionnels</p>
                </div>
            </div>
            
            <div class="row g-4 justify-content-center">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $popularProcedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-6 col-lg-4">
                        <?php if (isset($component)) { $__componentOriginale01c609a2786d87c68539a962edbc94a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale01c609a2786d87c68539a962edbc94a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cards.procedure','data' => ['procedure' => $procedure]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cards.procedure'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['procedure' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($procedure)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale01c609a2786d87c68539a962edbc94a)): ?>
<?php $attributes = $__attributesOriginale01c609a2786d87c68539a962edbc94a; ?>
<?php unset($__attributesOriginale01c609a2786d87c68539a962edbc94a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale01c609a2786d87c68539a962edbc94a)): ?>
<?php $component = $__componentOriginale01c609a2786d87c68539a962edbc94a; ?>
<?php unset($__componentOriginale01c609a2786d87c68539a962edbc94a); ?>
<?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-muted">Aucune démarche populaire.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>

    <!-- 📂 Catégories B2B -->
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-md-8">
                    <h2 class="mb-2 fw-bold text-dark">Thématiques Professionnelles</h2>
                    <p class="text-muted mb-0">Découvrez les secteurs et procédures dédiées au monde des affaires</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="<?php echo e(route('entreprises.thematiques')); ?>" class="btn btn-outline-dark rounded-pill px-4 fw-bold">Tout explorer</a>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-6 col-lg-4">
                        <?php if (isset($component)) { $__componentOriginal3742e84c67cd904d7a957f8f0610863e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3742e84c67cd904d7a957f8f0610863e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cards.category','data' => ['category' => $category,'routeName' => 'entreprises.thematiques.show']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cards.category'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category),'routeName' => 'entreprises.thematiques.show']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3742e84c67cd904d7a957f8f0610863e)): ?>
<?php $attributes = $__attributesOriginal3742e84c67cd904d7a957f8f0610863e; ?>
<?php unset($__attributesOriginal3742e84c67cd904d7a957f8f0610863e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3742e84c67cd904d7a957f8f0610863e)): ?>
<?php $component = $__componentOriginal3742e84c67cd904d7a957f8f0610863e; ?>
<?php unset($__componentOriginal3742e84c67cd904d7a957f8f0610863e); ?>
<?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-briefcase text-muted fs-1 mb-3 d-block"></i>
                        <p class="text-muted">Les thématiques dédiées aux entreprises sont en cours de mise à jour.</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>

    <!-- 👋 Événements de vie B2B -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lifeEvents->isNotEmpty()): ?>
    <section class="section-padding bg-soft">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold text-dark">Événements de vie entreprise</h2>
                <p class="text-muted">Des guides complets étape par étape pour le cycle de vie de votre société</p>
            </div>
            
            <div class="grid-events">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $lifeEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginalc6459500309cb76341c0ae95514aa72f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc6459500309cb76341c0ae95514aa72f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cards.event','data' => ['event' => $event]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cards.event'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['event' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($event)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc6459500309cb76341c0ae95514aa72f)): ?>
<?php $attributes = $__attributesOriginalc6459500309cb76341c0ae95514aa72f; ?>
<?php unset($__attributesOriginalc6459500309cb76341c0ae95514aa72f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6459500309cb76341c0ae95514aa72f)): ?>
<?php $component = $__componentOriginalc6459500309cb76341c0ae95514aa72f; ?>
<?php unset($__componentOriginalc6459500309cb76341c0ae95514aa72f); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- 💻 E-services B2B -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($eservices->isNotEmpty()): ?>
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-md-8">
                    <h2 class="mb-2 fw-bold text-dark">E-services pour les professionnels</h2>
                    <p class="text-muted mb-0">Accédez directement aux plateformes (CEFORE, eSINTAX, etc.)</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="<?php echo e(route('eservices.index')); ?>" class="btn btn-outline-dark rounded-pill px-4 fw-bold">Tous les services en ligne</a>
                </div>
            </div>

            <div class="row g-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $eservices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-lg-4">
                        <?php if (isset($component)) { $__componentOriginal542f28366db6a622d4b3bf5697161187 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal542f28366db6a622d4b3bf5697161187 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cards.eservice','data' => ['service' => $service]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cards.eservice'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['service' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($service)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal542f28366db6a622d4b3bf5697161187)): ?>
<?php $attributes = $__attributesOriginal542f28366db6a622d4b3bf5697161187; ?>
<?php unset($__attributesOriginal542f28366db6a622d4b3bf5697161187); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal542f28366db6a622d4b3bf5697161187)): ?>
<?php $component = $__componentOriginal542f28366db6a622d4b3bf5697161187; ?>
<?php unset($__componentOriginal542f28366db6a622d4b3bf5697161187); ?>
<?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- 🏢 Appui aux entreprises (Annuaire) -->
    <section class="section-padding bg-soft">
        <div class="container">
            <div class="card-premium bg-white border-0 shadow-sm overflow-hidden rounded-4">
                <div class="row g-0 align-items-center">
                    <div class="col-lg-8 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="bi bi-building fs-3"></i>
                        </div>
                        <h2 class="h3 fw-bold text-dark mb-3">Annuaire des structures d'appui</h2>
                        <p class="text-muted lead mb-4">Trouvez rapidement les coordonnées des Chambres de Commerce, CEFORE, ministères de tutelle et agences de promotion des investissements.</p>
                        <a href="<?php echo e(route('annuaire.index')); ?>" class="btn btn-primary rounded-pill px-4 py-3 fw-bold shadow-sm">Rechercher un organisme <i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                    <div class="col-lg-4 d-none d-lg-flex bg-light align-items-center justify-content-center h-100 p-5" style="min-height: 400px; border-left: 1px solid rgba(0,0,0,0.05);">
                        <i class="bi bi-map text-primary opacity-25" style="font-size: 10rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/pages/entreprises/index.blade.php ENDPATH**/ ?>