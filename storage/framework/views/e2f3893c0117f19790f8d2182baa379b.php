<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['event']));

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

foreach (array_filter((['event']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $colors = ['text-primary', 'text-success', 'text-danger', 'text-warning', 'text-info', 'text-secondary'];
    $colorClass = $colors[$event->id % count($colors)];
    $bgClass = str_replace('text-', 'bg-', $colorClass) . ' bg-opacity-10';
?>

<a href="<?php echo e(route('evenements.show', $event->slug)); ?>" class="card-premium h-100 text-center d-flex flex-column">
    <div class="icon-wrapper mx-auto mb-3 <?php echo e($bgClass); ?> <?php echo e($colorClass); ?>" style="width: 64px; height: 64px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 1.75rem;">
        <i class="<?php echo e($event->icon ?? 'bi bi-question-circle'); ?>"></i>
    </div>
    <h3 class="h6 mb-2 fw-bold text-dark"><?php echo e($event->title); ?></h3>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($event->procedures_count)): ?>
        <p class="text-muted small mt-auto mb-0"><?php echo e($event->procedures_count); ?> démarches associées</p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</a>
<?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/components/cards/event.blade.php ENDPATH**/ ?>