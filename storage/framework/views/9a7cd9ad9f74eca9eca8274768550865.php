<?php $__env->startSection('content'); ?>
    <!-- 🌟 Hero Section -->
    <section class="hero text-center" style="background: white; padding: 100px 0 80px; position: relative; overflow: hidden;">
        <div class="container d-flex flex-column align-items-center">
            <span class="badge bg-soft text-bf-green mb-3 px-3 py-2 rounded-pill fw-bold">Site Officiel de l'Administration</span>
            <h1 class="mx-auto" style="max-width: 800px; font-size: 3.5rem; line-height: 1.15; margin-bottom: 24px; color: #111827;">Simplifiez votre quotidien administratif</h1>
            <p class="mx-auto" style="font-size: 1.25rem; color: #4B5563; margin-bottom: 40px; max-width: 600px;">Découvrez un accès centralisé à toutes les informations, démarches et services de l'administration burkinabè.</p>
            
            <form action="<?php echo e(route('recherche')); ?>" method="GET" class="search-wrapper mx-auto" style="width: 100%; max-width: 600px;">
                <input type="text" name="q" placeholder="Rechercher une démarche, un service, un organisme..." aria-label="Recherche">
                <button type="submit">Rechercher</button>
            </form>
            
            <div class="mt-4 gap-2 d-flex flex-wrap justify-content-center align-items-center">
                <small class="text-muted fw-bold me-2">Suggestions :</small>
                <a href="<?php echo e(route('recherche', ['q' => 'passeport'])); ?>" class="badge bg-light border text-muted rounded-pill text-decoration-none px-3 py-2">Passeport</a>
                <a href="<?php echo e(route('recherche', ['q' => 'CNIB'])); ?>" class="badge bg-light border text-muted rounded-pill text-decoration-none px-3 py-2">CNIB</a>
                <a href="<?php echo e(route('recherche', ['q' => 'casier judiciaire'])); ?>" class="badge bg-light border text-muted rounded-pill text-decoration-none px-3 py-2">Casier judiciaire</a>
            </div>
        </div>
    </section>

    <!-- 📊 Stats Bar -->
    <?php if (isset($component)) { $__componentOriginal26d8167bfd0102480b56a1c422dedd1d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26d8167bfd0102480b56a1c422dedd1d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stats-bar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stats-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal26d8167bfd0102480b56a1c422dedd1d)): ?>
<?php $attributes = $__attributesOriginal26d8167bfd0102480b56a1c422dedd1d; ?>
<?php unset($__attributesOriginal26d8167bfd0102480b56a1c422dedd1d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal26d8167bfd0102480b56a1c422dedd1d)): ?>
<?php $component = $__componentOriginal26d8167bfd0102480b56a1c422dedd1d; ?>
<?php unset($__componentOriginal26d8167bfd0102480b56a1c422dedd1d); ?>
<?php endif; ?>

    <!-- 📂 Catégories (Navigation Principale) -->
    <section class="section-padding bg-soft">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-md-8">
                    <h2 class="mb-2">Explorez par thématique</h2>
                    <p class="text-muted mb-0">Retrouvez toutes les fiches pratiques classées par grande catégorie</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="<?php echo e(route('thematiques.index')); ?>" class="btn btn-outline-dark rounded-pill px-4 fw-bold">Tout explorer</a>
                </div>
            </div>

            <!-- Grille de 4 colonnes (col-lg-3 = 12/4) -->
            <div class="row g-4 d-flex justify-content-center">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-6 col-lg-3">
                        <?php if (isset($component)) { $__componentOriginal3742e84c67cd904d7a957f8f0610863e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3742e84c67cd904d7a957f8f0610863e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cards.category','data' => ['category' => $category]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cards.category'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category)]); ?>
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
                    <p class="text-muted">Aucune catégorie.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>

    <!-- 👋 Événements de vie (Navigation secondaire) -->
    <section class="section-padding">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Comment faire si...</h2>
                <p class="text-muted">Des guides complets étape par étape pour vos événements de vie majeurs</p>
            </div>
            
            <div class="grid-events">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $lifeEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-center text-muted">Bientôt disponible.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            
            <div class="text-center mt-5">
                <a href="<?php echo e(route('evenements.index')); ?>" class="btn btn-outline-dark rounded-pill px-4 fw-bold">Voir tous les guides</a>
            </div>
        </div>
    </section>

    <!-- ⭐ Services Rapides -->
    <section class="section-padding section-alt bg-soft">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <h2 class="mb-2">Services les plus consultés</h2>
                    <p class="text-muted mb-0">Les démarches préférées par les usagers cette semaine</p>
                </div>
            </div>
            <div class="row g-4 d-flex justify-content-center">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $procedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <!-- Adapté à 3 colonnes pour les cards populaires -->
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
                    <p class="text-muted">Aucun service populaire.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>

    <!-- 📰 Actualités -->
    <section class="section-padding">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2>Actualités Gouvernementales</h2>
                <a href="<?php echo e(route('actualites.index')); ?>" class="fw-bold text-dark text-decoration-none border-bottom border-dark border-2 pb-1">Toutes les actualités</a>
            </div>
            <div class="row g-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-4">
                        <?php if (isset($component)) { $__componentOriginal82f29825bcd86685f3278e5ff7d97609 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal82f29825bcd86685f3278e5ff7d97609 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cards.article','data' => ['article' => $article]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cards.article'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['article' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($article)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal82f29825bcd86685f3278e5ff7d97609)): ?>
<?php $attributes = $__attributesOriginal82f29825bcd86685f3278e5ff7d97609; ?>
<?php unset($__attributesOriginal82f29825bcd86685f3278e5ff7d97609); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal82f29825bcd86685f3278e5ff7d97609)): ?>
<?php $component = $__componentOriginal82f29825bcd86685f3278e5ff7d97609; ?>
<?php unset($__componentOriginal82f29825bcd86685f3278e5ff7d97609); ?>
<?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-muted">Aucune actualité.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            
            <!-- Bannière Annuaire (Appel à l'action final) -->
            <?php if (isset($component)) { $__componentOriginal406633d5e46e6abbf5608e42f2a08ad5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal406633d5e46e6abbf5608e42f2a08ad5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.annuaire-banner','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('annuaire-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal406633d5e46e6abbf5608e42f2a08ad5)): ?>
<?php $attributes = $__attributesOriginal406633d5e46e6abbf5608e42f2a08ad5; ?>
<?php unset($__attributesOriginal406633d5e46e6abbf5608e42f2a08ad5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal406633d5e46e6abbf5608e42f2a08ad5)): ?>
<?php $component = $__componentOriginal406633d5e46e6abbf5608e42f2a08ad5; ?>
<?php unset($__componentOriginal406633d5e46e6abbf5608e42f2a08ad5); ?>
<?php endif; ?>
            
        </div>
    </section>

    <!-- 💌 Newsletter -->
    <div class="container mb-5">
        <div class="newsletter-section bg-dark text-white rounded-4 overflow-hidden position-relative">
            <!-- Ajout d'une superposition sombre pour un effet plus pro -->
            <div class="newsletter-inner position-relative z-1 p-5 text-center">
                <h2 class="h2 text-white mb-3" style="font-family: var(--font-heading);">Ne manquez aucune info officielle !</h2>
                <p class="text-white-50 mb-4 mx-auto" style="max-width: 600px;">Recevez l'essentiel des actualités et des nouvelles procédures de l'administration burkinabè chaque mois directement dans votre boîte mail.</p>
                <form class="d-flex gap-2 justify-content-center flex-wrap" action="#" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="email" name="email" class="form-control w-auto px-4 py-3 rounded-pill border-0 newsletter-input shadow-sm" placeholder="Votre adresse email" required>
                    <!-- Bouton en style dark/institutional au lieu de warning flash -->
                    <button class="btn btn-secondary px-4 py-3 rounded-pill fw-bold bg-white text-dark shadow-sm">Je m'abonne</button>
                </form>
                <div class="mt-3 text-white-50 small">Votre email ne sera pas partagé avec des tiers.</div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/pages/home/index.blade.php ENDPATH**/ ?>