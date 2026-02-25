<?php $__env->startSection('title', 'Contact'); ?>
<?php $__env->startSection('meta_description', 'Contactez le service public du Burkina Faso pour toute question relative à vos démarches administratives.'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginala8902021db87385247be9a842af50129 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8902021db87385247be9a842af50129 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.hero-banner','data' => ['title' => 'Nous contacter','subtitle' => 'Une question sur vos démarches ? Contactez-nous.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.hero-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nous contacter','subtitle' => 'Une question sur vos démarches ? Contactez-nous.']); ?>
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
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="card-premium">
                    <h2 class="h3 fw-bold mb-4" style="font-family: var(--font-heading);">Envoyez-nous un message</h2>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                        <div class="alert-success-sp mb-4">
                            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                        <div class="alert alert-danger rounded-3 mb-4">
                            <ul class="mb-0">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <form action="<?php echo e(route('contact.envoyer')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="nom" class="form-label fw-semibold">Nom complet</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="nom" name="nom" value="<?php echo e(old('nom')); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" value="<?php echo e(old('email')); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="sujet" class="form-label fw-semibold">Sujet</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['sujet'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="sujet" name="sujet" value="<?php echo e(old('sujet')); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label fw-semibold">Message</label>
                            <textarea class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="message" name="message" rows="6" required><?php echo e(old('message')); ?></textarea>
                        </div>
                        <button type="submit" class="btn-sp btn-sp-primary">
                            <i class="fas fa-paper-plane me-1"></i> Envoyer
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="fiche-sidebar-card">
                    <h2 class="h3 fw-bold mb-4" style="font-family: var(--font-heading);">Nos coordonnées</h2>
                    <div class="mb-3">
                        <i class="fas fa-phone text-bf-green me-2"></i>
                        <a href="tel:+22625306630" class="text-decoration-none text-dark">(+226) 25 30 66 30</a>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-phone text-bf-green me-2"></i>
                        <a href="tel:+22625304110" class="text-decoration-none text-dark">(+226) 25 30 41 10</a>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-envelope text-bf-green me-2"></i>
                        <a href="mailto:contact@servicepublic.gov.bf" class="text-decoration-none text-dark">contact@servicepublic.gov.bf</a>
                    </div>
                    <hr class="my-4">
                    <div class="mb-3">
                        <i class="fas fa-map-marker-alt text-bf-green me-2"></i>
                        <span>Ouagadougou, Burkina Faso</span>
                    </div>
                    <div>
                        <i class="fas fa-clock text-bf-green me-2"></i>
                        <span>Lun – Ven : 07h30 – 12h30, 15h – 17h30</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/pages/contact/index.blade.php ENDPATH**/ ?>