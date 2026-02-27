

<?php $__env->startSection('title', $page->title . ' — Service Public BF'); ?>
<?php $__env->startSection('meta_description', $page->meta_description ?? Str::limit(strip_tags($page->content), 160)); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header py-5 bg-light border-bottom">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-dark mb-0"><?php echo e($page->title); ?></h1>
        <div class="tricolor-line mx-auto mt-3"></div>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 p-md-5">
                <div class="content rtf-content">
                    <?php echo Str::markdown($page->content); ?>

                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="<?php echo e(route('home')); ?>" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-house-door me-2"></i>Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.tricolor-line {
    width: 60px;
    height: 4px;
    background: linear-gradient(to right, #ce1126 33.33%, #fcd116 33.33%, #fcd116 66.66%, #009e49 66.66%);
    border-radius: 2px;
}
.rtf-content h2 { margin-top: 2rem; font-weight: 700; color: var(--bs-dark); }
.rtf-content p { line-height: 1.8; color: #4b5563; }
.rtf-content ul { padding-left: 1.25rem; }
.rtf-content li { margin-bottom: 0.5rem; color: #4b5563; }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\resources\views/pages/show.blade.php ENDPATH**/ ?>