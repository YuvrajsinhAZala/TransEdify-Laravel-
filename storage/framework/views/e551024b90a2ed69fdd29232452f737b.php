

<?php $__env->startSection('title', 'Manage Enrollments'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Course Enrollments</h2>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Assign Students to Courses</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="<?php echo e(route('admin.enrollments.index')); ?>" class="mb-4">
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

                <?php if($selectedCourseId): ?>
                <form method="POST" action="<?php echo e(route('admin.enrollments.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="course_id" value="<?php echo e($selectedCourseId); ?>">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="students[]" value="<?php echo e($student->id); ?>" 
                                                <?php echo e(in_array($student->id, $assigned) ? 'checked' : ''); ?>>
                                        </td>
                                        <td><?php echo e($student->id); ?></td>
                                        <td><?php echo e($student->name); ?></td>
                                        <td><?php echo e($student->email); ?></td>
                                        <td><?php echo e($student->username); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr><td colspan="5" class="text-center">No students found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if($students->count() > 0): ?>
                        <button type="submit" class="btn btn-primary mt-3">Save Enrollments</button>
                    <?php endif; ?>
                </form>
                <?php else: ?>
                    <div class="alert alert-info">Please select a course to manage enrollments.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('input[name="students[]"]');
    checkboxes.forEach(cb => cb.checked = this.checked);
});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-education-erp\resources\views/admin/enrollments/index.blade.php ENDPATH**/ ?>