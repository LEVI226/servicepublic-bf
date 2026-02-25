<?php $__env->startSection('title', 'Actualités'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginala8902021db87385247be9a842af50129 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8902021db87385247be9a842af50129 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.hero-banner','data' => ['title' => 'Actualités','subtitle' => 'Restez informé des dernières mises à jour de l\'administration et des services publics.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.hero-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Actualités','subtitle' => 'Restez informé des dernières mises à jour de l\'administration et des services publics.']); ?>
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
        <div class="row g-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-lg-4">
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
                <div class="col-12">
                    <p class="text-center text-muted">Aucune actualité disponible.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="mt-5 d-flex justify-content-center">
            <?php echo e($articles->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/pages/actualites/index.blade.php ENDPATH**/ ?>