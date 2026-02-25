<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['category', 'routeName' => 'thematiques.show']));

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

foreach (array_filter((['category', 'routeName' => 'thematiques.show']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<a href="<?php echo e(route($routeName, $category->slug)); ?>" class="card-premium d-flex flex-row align-items-start gap-3 text-decoration-none">
    <div class="icon-wrapper flex-shrink-0" <?php if($category->color): ?> style="color: <?php echo e($category->color); ?>;" <?php endif; ?>>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(empty($category->icon)): ?>
            <i class="bi bi-folder"></i>
        <?php elseif(str_contains($category->icon, ' ')): ?>
            <i class="<?php echo e($category->icon); ?>"></i>
        <?php else: ?>
            <i class="bi bi-<?php echo e(str_replace('bi-', '', $category->icon)); ?>"></i>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <div class="flex-grow-1">
        <h3 class="h6 mb-1"><?php echo e($category->name); ?></h3>
        <p class="text-sm text-muted mb-2"><?php echo e(Str::limit($category->description, 60)); ?></p>
        <div class="text-xs text-secondary fw-bold">
            <?php echo e($category->procedures_count ?? 0); ?> fiches pratiques
        </div>
    </div>
</a>
<?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/components/cards/category.blade.php ENDPATH**/ ?>