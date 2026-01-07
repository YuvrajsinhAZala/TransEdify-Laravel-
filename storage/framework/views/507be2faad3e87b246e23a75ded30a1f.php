

<?php $__env->startSection('title', 'Reports'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Reports & Statistics</h2>
</div>

<div class="row g-4">
    <!-- Statistics Cards -->
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="display-4 mb-2">👥</div>
                <h3><?php echo e($totalStudents); ?></h3>
                <p class="text-muted mb-0">Total Students</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="display-4 mb-2">📚</div>
                <h3><?php echo e($totalCourses); ?></h3>
                <p class="text-muted mb-0">Total Courses</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="display-4 mb-2">💰</div>
                <h3>$<?php echo e(number_format($totalFees, 2)); ?></h3>
                <p class="text-muted mb-0">Total Fees</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="display-4 mb-2">✅</div>
                <h3>$<?php echo e(number_format($paidFees, 2)); ?></h3>
                <p class="text-muted mb-0">Paid Fees</p>
            </div>
        </div>
    </div>

    <!-- Recent Students -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Recent Students</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($student->id); ?></td>
                                    <td><?php echo e($student->name); ?></td>
                                    <td><?php echo e($student->username); ?></td>
                                    <td><?php echo e($student->email); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="4" class="text-center">No students found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Courses -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Recent Courses</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($course->id); ?></td>
                                    <td><?php echo e($course->course_code); ?></td>
                                    <td><?php echo e($course->course_name); ?></td>
                                    <td><?php echo e(Str::limit($course->description, 30)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="4" class="text-center">No courses found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Fee Summary -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Fee Summary</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="alert alert-success">
                            <strong>Paid Fees:</strong> $<?php echo e(number_format($paidFees, 2)); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-warning">
                            <strong>Unpaid Fees:</strong> $<?php echo e(number_format($unpaidFees, 2)); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-info">
                            <strong>Total Fees:</strong> $<?php echo e(number_format($totalFees, 2)); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-education-erp\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>