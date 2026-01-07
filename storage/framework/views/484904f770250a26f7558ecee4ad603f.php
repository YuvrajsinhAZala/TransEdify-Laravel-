

<?php $__env->startSection('title', 'Notices'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Notices</h2>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php if($notices->count() > 0): ?>
            <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><?php echo e($notice->title); ?></h5>
                        <small class="text-muted"><?php echo e($notice->created_at->format('M d, Y')); ?></small>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><?php echo e($notice->content); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="alert alert-info">
                <p class="mb-0">No notices available.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.student', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-education-erp\resources\views/student/notices/index.blade.php ENDPATH**/ ?>