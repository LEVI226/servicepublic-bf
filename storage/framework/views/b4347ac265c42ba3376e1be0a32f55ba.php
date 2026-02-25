<?php $__env->startSection('title', $lifeEvent->title); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginala8902021db87385247be9a842af50129 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8902021db87385247be9a842af50129 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.hero-banner','data' => ['title' => $lifeEvent->title,'subtitle' => $lifeEvent->description]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.hero-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($lifeEvent->title),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($lifeEvent->description)]); ?>
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
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lifeEvent->content): ?>
                    <div class="mb-5">
                        <div class="lead text-muted"><?php echo nl2br(e($lifeEvent->content)); ?></div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($procedures->isNotEmpty()): ?>
                    <h2 class="h4 fw-bold mb-4">Procédures associées</h2>
                    <div class="d-flex flex-column gap-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $procedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card-premium flex-row align-items-center gap-4 p-4">
                                <div class="step-counter bg-soft text-bf-green rounded-circle flex-shrink-0">
                                    <?php echo e($loop->iteration); ?>

                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="h5 fw-bold mb-1"><?php echo e($procedure->title); ?></h3>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($procedure->description): ?>
                                        <p class="text-muted mb-2"><?php echo e(Str::limit($procedure->description, 150)); ?></p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    
                                    <div class="mt-2">
                                        <a href="<?php echo e(route('fiches.show', [$procedure->category?->slug ?? 'general', $procedure->slug])); ?>" class="btn-sp btn-sp-outline btn-sp-sm py-1 px-3">
                                            Voir la fiche <i class="bi bi-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php else: ?>
                    <p class="text-center text-muted">Aucune procédure associée pour le moment.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/pages/evenements/show.blade.php ENDPATH**/ ?>