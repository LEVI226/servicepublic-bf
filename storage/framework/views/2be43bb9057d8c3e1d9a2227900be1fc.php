<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['procedure']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['procedure']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<a href="<?php echo e(route('fiches.show', ['themeSlug' => $procedure->category?->slug ?? 'general', 'ficheSlug' => $procedure->slug])); ?>" class="card-premium h-100 text-decoration-none">
    <div class="d-flex flex-column h-100">
        <div class="mb-3">
            <span class="badge bg-soft text-bf-green border rounded-pill px-2 py-1 badge-category">
                <?php echo e($procedure->category?->name ?? 'Général'); ?>

            </span>
        </div>
        <h3 class="h5 mb-2 fw-bold text-dark">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($procedure->icon)): ?>
                <i class="<?php echo e($procedure->icon); ?> text-bf-green me-2"></i>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php echo e($procedure->title); ?>

        </h3>
        <p class="text-muted small mb-0 card-description">
            <?php echo e(Str::limit($procedure->description, 100)); ?>

        </p>
        <div class="mt-auto pt-3">
            <span class="text-bf-green fw-bold small">Lire la fiche <i class="bi bi-arrow-right ms-1"></i></span>
        </div>
    </div>
</a>
<?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/components/cards/procedure.blade.php ENDPATH**/ ?>