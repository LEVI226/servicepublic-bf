<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['article']));

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

foreach (array_filter((['article']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $hasImage = !empty($article->image);
    $colors = ['text-primary', 'text-success', 'text-danger', 'text-warning', 'text-info', 'text-secondary'];
    $colorClass = $colors[$article->id % count($colors)];
    $bgClass = str_replace('text-', 'bg-', $colorClass);
?>

<a href="<?php echo e(route('actualites.show', $article->slug)); ?>" class="card-premium h-100 p-0 overflow-hidden d-flex flex-column text-decoration-none">
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasImage): ?>
        <div class="ratio ratio-16x9 position-relative">
            <img src="<?php echo e(asset('storage/' . $article->image)); ?>" alt="<?php echo e($article->title); ?>" class="object-fit-cover">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->category): ?>
                <span class="position-absolute top-0 end-0 m-3 badge bg-white text-dark shadow-sm"><?php echo e($article->category->name); ?></span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="p-4 d-flex flex-column flex-grow-1">
        
        <div class="d-flex justify-content-between align-items-start mb-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$hasImage && $article->category): ?>
                <span class="badge <?php echo e($bgClass); ?> bg-opacity-10 <?php echo e($colorClass); ?> border-0 px-2 py-1"><?php echo e($article->category->name); ?></span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->published_at): ?>
                <span class="text-xs text-muted <?php echo e($hasImage || !$article->category ? 'ms-auto' : ''); ?>"><i class="bi bi-calendar3 me-1"></i> <?php echo e($article->published_at->format('d/m/Y')); ?></span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <h3 class="h6 fw-bold text-dark mt-2 mb-3 lh-base">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$hasImage): ?>
                <i class="bi bi-newspaper <?php echo e($colorClass); ?> me-2"></i>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php echo e($article->title); ?>

        </h3>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->excerpt): ?>
            <p class="text-muted small mb-0 mt-auto" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                <?php echo e($article->excerpt); ?>

            </p>
        <?php else: ?>
            <p class="text-muted small mb-0 mt-auto" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                <?php echo e(Str::limit(strip_tags($article->content), 100)); ?>

            </p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</a>
<?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/components/cards/article.blade.php ENDPATH**/ ?>