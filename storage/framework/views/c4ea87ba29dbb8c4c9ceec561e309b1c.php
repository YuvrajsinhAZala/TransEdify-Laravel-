

<?php $__env->startSection('title', 'Manage Results'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Results</h2>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Enter Results</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="<?php echo e(route('admin.results.index')); ?>" class="mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Select Course</label>
                            <select name="course_id" class="form-select" onchange="this.form.submit()">
                                <option value="">-- Select Course --</option>
                                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($course->id); ?>" <?php echo e($selectedCourseId == $course->id ? 'selected' : ''); ?>>
                                        <?php echo e($course->course_code); ?> - <?php echo e($course->course_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </form>

                <?php if($selectedCourseId && $students->count() > 0): ?>
                <form method="POST" action="<?php echo e(route('admin.results.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="course_id" value="<?php echo e($selectedCourseId); ?>">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Marks</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $result = $existingResults[$student->id] ?? null;
                                    ?>
                                    <tr>
                                        <td><?php echo e($student->id); ?></td>
                                        <td><?php echo e($student->name); ?></td>
                                        <td><?php echo e($student->username); ?></td>
                                        <td>
                                            <input type="number" name="marks[<?php echo e($student->id); ?>]" 
                                                class="form-control form-control-sm" 
                                                value="<?php echo e($result->marks ?? ''); ?>" 
                                                min="0" max="100" required>
                                        </td>
                                        <td>
                                            <input type="text" name="grades[<?php echo e($student->id); ?>]" 
                                                class="form-control form-control-sm" 
                                                value="<?php echo e($result->grade ?? ''); ?>" 
                                                maxlength="2" required>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Save Results</button>
                </form>
                <?php elseif($selectedCourseId): ?>
                    <div class="alert alert-warning">No students enrolled in this course.</div>
                <?php else: ?>
                    <div class="alert alert-info">Please select a course to enter results.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-education-erp\resources\views/admin/results/index.blade.php ENDPATH**/ ?>