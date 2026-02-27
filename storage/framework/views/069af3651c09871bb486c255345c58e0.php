<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['service']));

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

foreach (array_filter((['service']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    // Variate colors by ID to distinguish services
    $colors = ['text-primary', 'text-success', 'text-danger', 'text-warning', 'text-info', 'text-secondary'];
    $colorClass = $colors[$service->id % count($colors)] ?? 'text-secondary';
    $bgClass = str_replace('text-', 'bg-', $colorClass);
?>

<div class="card-eservice h-100 d-flex flex-column border-0 shadow-sm p-4 bg-white rounded-4 transition-all">
    <div class="d-flex align-items-center mb-3">
        <div class="icon-wrapper flex-shrink-0 me-3 <?php echo e($bgClass); ?> bg-opacity-10 <?php echo e($colorClass); ?> p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
            <i class="<?php echo e($service->icon ?? 'bi bi-laptop'); ?> fs-4"></i>
        </div>
        <div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->category): ?>
                <span class="badge bg-light text-secondary border mb-1" style="font-size: 0.65rem;"><i class="bi bi-folder me-1"></i><?php echo e($service->category->name); ?></span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <h3 class="h6 fw-bold mb-0 text-dark lh-sm"><?php echo e($service->title); ?></h3>
        </div>
    </div>
    
    <p class="text-muted small mb-4 flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
        <?php echo e(strip_tags($service->description) ?: 'Aucune description disponible.'); ?>

    </p>

    <a href="<?php echo e($service->url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-dark w-100 justify-content-center fw-bold rounded-pill gap-2 mt-auto">
        <span>Accéder au service</span>
        <i class="bi bi-box-arrow-up-right ms-2"></i>
    </a>
</div>
<?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/components/cards/eservice.blade.php ENDPATH**/ ?>