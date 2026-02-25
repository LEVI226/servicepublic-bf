<?php $__env->startSection('title', $category->name); ?>

<?php $__env->startPush('jsonld'); ?>
    <?php if (isset($component)) { $__componentOriginal424c45c7368ee2fe0f04ce396d5d2eef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal424c45c7368ee2fe0f04ce396d5d2eef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb-jsonld','data' => ['items' => $breadcrumb]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb-jsonld'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($breadcrumb)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal424c45c7368ee2fe0f04ce396d5d2eef)): ?>
<?php $attributes = $__attributesOriginal424c45c7368ee2fe0f04ce396d5d2eef; ?>
<?php unset($__attributesOriginal424c45c7368ee2fe0f04ce396d5d2eef); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal424c45c7368ee2fe0f04ce396d5d2eef)): ?>
<?php $component = $__componentOriginal424c45c7368ee2fe0f04ce396d5d2eef; ?>
<?php unset($__componentOriginal424c45c7368ee2fe0f04ce396d5d2eef); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginala8902021db87385247be9a842af50129 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8902021db87385247be9a842af50129 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.hero-banner','data' => ['title' => $category->name,'subtitle' => $category->description]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.hero-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category->name),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category->description)]); ?>
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
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subcategories->isNotEmpty()): ?>
            <div class="mb-5">
                <h2 class="h4 fw-bold mb-4">Sous-catégories</h2>
                <div class="row g-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card-premium d-flex flex-row align-items-start gap-3">
                                <div class="flex-grow-1">
                                    <h3 class="h6 mb-1"><?php echo e($sub->name); ?></h3>
                                    <div class="text-xs text-secondary fw-bold">
                                        <?php echo e($sub->procedures_count ?? 0); ?> fiches pratiques
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div>
            <h2 class="h4 fw-bold mb-4">Fiches pratiques</h2>
            <div class="row g-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $procedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-6">
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
                    <div class="col-12">
                        <p class="text-muted">Aucune fiche disponible pour le moment.</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            
            <div class="mt-5 d-flex justify-content-center">
                <?php echo e($procedures->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/pages/thematiques/show.blade.php ENDPATH**/ ?>