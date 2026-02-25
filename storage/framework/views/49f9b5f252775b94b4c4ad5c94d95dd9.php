
<?php $__env->startSection('title', "Annuaire de l'administration"); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginala8902021db87385247be9a842af50129 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8902021db87385247be9a842af50129 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.hero-banner','data' => ['title' => 'Annuaire de l\'administration','subtitle' => 'Retrouvez les coordonnées de tous les services publics de l\'État.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.hero-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Annuaire de l\'administration','subtitle' => 'Retrouvez les coordonnées de tous les services publics de l\'État.']); ?>
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
        <!-- 🔍 Search & Filters -->
        <div class="card-premium mb-5 border-0 shadow-sm bg-soft">
            <form action="<?php echo e(route('annuaire.index')); ?>" method="GET" class="row g-3 align-items-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="q" class="form-control border-start-0 ps-0 py-3" placeholder="Rechercher un organisme..." value="<?php echo e($recherche ?? ''); ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn-sp btn-sp-primary w-100 py-3">Rechercher</button>
                </div>
            </form>

            <div class="mt-3 pt-3 border-top d-flex flex-wrap gap-1 justify-content-center">
                <a href="<?php echo e(route('annuaire.index')); ?>" class="btn btn-sm btn-link text-decoration-none <?php echo e(!isset($lettre) || !$lettre ? 'fw-bold text-bf-green' : 'text-muted'); ?>">Tous</a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $lettres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('annuaire.index', ['lettre' => $l])); ?>" class="btn btn-sm btn-link text-decoration-none <?php echo e(($lettre ?? '') === $l ? 'fw-bold text-bf-green' : 'text-muted'); ?>"><?php echo e($l); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <!-- 🏢 Organismes Grid -->
        <div class="row g-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $organismes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $organisme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card-theme h-100 position-relative transition-all hover-shadow">
                        <div class="d-flex w-100 flex-column h-100">
                            <div class="mb-3">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($organisme->type): ?>
                                    <span class="badge bg-soft text-dark border"><?php echo e($organisme->type); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            
                            <h3 class="h5 fw-bold mb-1">
                                <a href="<?php echo e(route('annuaire.show', $organisme->slug)); ?>" class="text-dark text-decoration-none stretched-link"><?php echo e($organisme->name); ?></a>
                            </h3>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($organisme->acronym): ?>
                                <p class="text-muted small mb-3">(<?php echo e($organisme->acronym); ?>)</p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <div class="mt-auto pt-3 border-top text-sm position-relative z-index-1">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($organisme->phone): ?>
                                    <div class="mb-1"><a href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $organisme->phone)); ?>" class="text-decoration-none text-dark"><i class="bi bi-telephone text-bf-green me-2"></i> <?php echo e($organisme->phone); ?></a></div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($organisme->email): ?>
                                    <div><a href="mailto:<?php echo e($organisme->email); ?>" class="text-decoration-none text-dark"><i class="bi bi-envelope text-bf-green me-2"></i> <?php echo e($organisme->email); ?></a></div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 py-5 text-center">
                    <div class="display-1 text-muted opacity-25 mb-3"><i class="bi bi-building-slash"></i></div>
                    <p class="lead text-muted">Aucun organisme ne correspond à votre recherche.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="mt-5 d-flex justify-content-center">
            <?php echo e($organismes->appends(request()->query())->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/pages/annuaire/index.blade.php ENDPATH**/ ?>