

<?php $__env->startSection('title', 'Manage Notices'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Notices</h2>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e($editNotice ? 'Edit Notice' : 'Post New Notice'); ?></h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo e($editNotice ? route('admin.notices.update', $editNotice->id) : route('admin.notices.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php if($editNotice): ?>
                        <?php echo method_field('PUT'); ?>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $editNotice->title ?? '')); ?>" required>
                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="5" required><?php echo e(old('content', $editNotice->content ?? '')); ?></textarea>
                        <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo e($editNotice ? 'Update' : 'Post'); ?> Notice</button>
                    <?php if($editNotice): ?>
                        <a href="<?php echo e(route('admin.notices.index')); ?>" class="btn btn-secondary">Cancel</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Notices List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Posted At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($notice->id); ?></td>
                                    <td><?php echo e($notice->title); ?></td>
                                    <td><?php echo e(Str::limit($notice->content, 50)); ?></td>
                                    <td><?php echo e($notice->created_at->format('Y-m-d')); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.notices.index', ['edit' => $notice->id])); ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="<?php echo e(route('admin.notices.destroy', $notice->id)); ?>" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="5" class="text-center">No notices found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-education-erp\resources\views/admin/notices/index.blade.php ENDPATH**/ ?>