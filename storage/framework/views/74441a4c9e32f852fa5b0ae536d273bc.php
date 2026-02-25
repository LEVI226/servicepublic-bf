
<?php $__env->startSection('title', 'Plan du site'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginala8902021db87385247be9a842af50129 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8902021db87385247be9a842af50129 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.hero-banner','data' => ['title' => 'Plan du site','subtitle' => 'Vue d\'ensemble de l\'architecture du portail Service Public BF']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.hero-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Plan du site','subtitle' => 'Vue d\'ensemble de l\'architecture du portail Service Public BF']); ?>
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

    <div class="container section-padding pt-5">
        <div class="row g-5">
            
            <div class="col-md-6">
                <h2 class="h4 text-bf-green mb-4 border-bottom pb-2">Rubriques principales</h2>
                <ul class="list-unstyled ms-3">
                    <li class="mb-3"><a href="<?php echo e(route('home')); ?>" class="fw-bold text-dark text-decoration-none">Accueil</a></li>
                    <li class="mb-3"><a href="<?php echo e(route('actualites.index')); ?>" class="fw-bold text-dark text-decoration-none">Actualités</a></li>
                    <li class="mb-3"><a href="<?php echo e(route('demarches.formulaires')); ?>" class="fw-bold text-dark text-decoration-none">Formulaires administratifs</a></li>
                    <li class="mb-3"><a href="<?php echo e(route('eservices.index')); ?>" class="fw-bold text-dark text-decoration-none">Services en ligne (E-services)</a></li>
                    <li class="mb-3"><a href="<?php echo e(route('annuaire.index')); ?>" class="fw-bold text-dark text-decoration-none">Annuaire de l'administration</a></li>
                    <li class="mb-3"><a href="<?php echo e(route('faq')); ?>" class="fw-bold text-dark text-decoration-none">Foire aux questions (FAQ)</a></li>
                    <li class="mb-3"><a href="<?php echo e(route('contact')); ?>" class="fw-bold text-dark text-decoration-none">Contact / Assistance</a></li>
                </ul>

                <h2 class="h4 text-bf-green mb-4 mt-5 border-bottom pb-2">Comment faire si...</h2>
                <ul class="list-unstyled ms-3">
                    <li class="mb-3"><a href="<?php echo e(route('evenements.index')); ?>" class="fw-bold text-dark text-decoration-none">Tous les thèmes de vie</a></li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $lifeEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="mb-2 ms-4 d-flex align-items-center gap-2">
                            <i class="<?php echo e($event->icon ?? 'bi bi-dash'); ?> text-muted small"></i>
                            <a href="<?php echo e(route('evenements.show', $event->slug)); ?>" class="text-muted text-decoration-none hover-text-primary"><?php echo e($event->title); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

            <div class="col-md-6">
                <h2 class="h4 text-bf-green mb-4 border-bottom pb-2">Fiches Pratiques par Thématique</h2>
                <ul class="list-unstyled ms-3">
                    <li class="mb-3"><a href="<?php echo e(route('thematiques.index')); ?>" class="fw-bold text-dark text-decoration-none">Toutes les thématiques</a></li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="mb-4">
                            <a href="<?php echo e(route('thematiques.show', $category->slug)); ?>" class="fw-bold text-dark text-decoration-none mb-2 d-block">
                                <?php echo e($category->name); ?>

                            </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category->subcategories && $category->subcategories->count() > 0): ?>
                                <ul class="list-unstyled ms-4">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="mb-1 text-muted small">
                                            <i class="bi bi-chevron-right me-1 text-light"></i> <?php echo e($subcat->name); ?>

                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </ul>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/pages/plan-du-site.blade.php ENDPATH**/ ?>