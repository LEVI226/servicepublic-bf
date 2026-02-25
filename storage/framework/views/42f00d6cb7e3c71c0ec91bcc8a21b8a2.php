
<?php $__env->startSection('title', 'Foire Aux Questions (FAQ)'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginala8902021db87385247be9a842af50129 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8902021db87385247be9a842af50129 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.hero-banner','data' => ['title' => 'Foire Aux Questions (FAQ)','subtitle' => 'Trouvez rapidement les réponses à vos questions les plus fréquentes.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.hero-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Foire Aux Questions (FAQ)','subtitle' => 'Trouvez rapidement les réponses à vos questions les plus fréquentes.']); ?>
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
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($faqs->isEmpty()): ?>
                    <div class="alert alert-light border text-center p-5 rounded-4">
                        <i class="fas fa-question-circle text-muted fs-1 mb-3 d-block"></i>
                        <h3 class="h4 fw-bold text-dark mb-2" style="font-family: var(--font-heading);">Aucune question pour le moment</h3>
                        <p class="text-muted mb-0">La base de connaissances est en cours de création.</p>
                    </div>
                <?php else: ?>
                    <div class="accordion accordion-flush" id="faqAccordion">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="accordion-item border rounded-3 mb-3 overflow-hidden shadow-sm">
                                <h2 class="accordion-header" id="heading-<?php echo e($faq->id); ?>">
                                    <button class="accordion-button <?php echo e($index !== 0 ? 'collapsed' : ''); ?> bg-white fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo e($faq->id); ?>" aria-expanded="<?php echo e($index === 0 ? 'true' : 'false'); ?>" aria-controls="collapse-<?php echo e($faq->id); ?>">
                                        <?php echo e($faq->question); ?>

                                    </button>
                                </h2>
                                <div id="collapse-<?php echo e($faq->id); ?>" class="accordion-collapse collapse <?php echo e($index === 0 ? 'show' : ''); ?>" aria-labelledby="heading-<?php echo e($faq->id); ?>" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body text-muted bg-soft border-top">
                                        <?php echo e($faq->answer); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                <div class="mt-5 text-center p-4 bg-soft rounded-4 border border-light">
                    <i class="fas fa-headset text-bf-green fs-2 mb-3 d-block"></i>
                    <h3 class="h4 fw-bold text-dark mb-2" style="font-family: var(--font-heading);">Vous n'avez pas trouvé votre réponse ?</h3>
                    <p class="text-muted mb-4">Notre équipe d'assistance est là pour vous aider.</p>
                    <a href="<?php echo e(route('contact')); ?>" class="btn-sp btn-sp-primary">Contactez-nous</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/pages/faq.blade.php ENDPATH**/ ?>