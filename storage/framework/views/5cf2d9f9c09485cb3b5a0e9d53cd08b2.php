

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Dashboard Overview</h2>
    </div>
</div>

<div class="row g-4">
    <!-- Students Card -->
    <div class="col-md-3">
        <div class="card text-center p-4">
            <div class="card-body">
                <div class="display-4 mb-3">👥</div>
                <h5 class="card-title">Students</h5>
                <p class="card-text">
                    <a href="<?php echo e(route('admin.students.index')); ?>" class="btn btn-primary btn-sm">Manage Students</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Courses Card -->
    <div class="col-md-3">
        <div class="card text-center p-4">
            <div class="card-body">
                <div class="display-4 mb-3">📚</div>
                <h5 class="card-title">Courses</h5>
                <p class="card-text">
                    <a href="<?php echo e(route('admin.courses.index')); ?>" class="btn btn-primary btn-sm">Manage Courses</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Faculty Card -->
    <div class="col-md-3">
        <div class="card text-center p-4">
            <div class="card-body">
                <div class="display-4 mb-3">👨‍🏫</div>
                <h5 class="card-title">Faculty</h5>
                <p class="card-text">
                    <a href="<?php echo e(route('admin.faculty.index')); ?>" class="btn btn-primary btn-sm">Manage Faculty</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Enrollments Card -->
    <div class="col-md-3">
        <div class="card text-center p-4">
            <div class="card-body">
                <div class="display-4 mb-3">📝</div>
                <h5 class="card-title">Enrollments</h5>
                <p class="card-text">
                    <a href="<?php echo e(route('admin.enrollments.index')); ?>" class="btn btn-primary btn-sm">Manage Enrollments</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Attendance Card -->
    <div class="col-md-3">
        <div class="card text-center p-4">
            <div class="card-body">
                <div class="display-4 mb-3">✅</div>
                <h5 class="card-title">Attendance</h5>
                <p class="card-text">
                    <a href="<?php echo e(route('admin.attendance.index')); ?>" class="btn btn-primary btn-sm">Mark Attendance</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Results Card -->
    <div class="col-md-3">
        <div class="card text-center p-4">
            <div class="card-body">
                <div class="display-4 mb-3">📊</div>
                <h5 class="card-title">Results</h5>
                <p class="card-text">
                    <a href="<?php echo e(route('admin.results.index')); ?>" class="btn btn-primary btn-sm">Enter Results</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Notices Card -->
    <div class="col-md-3">
        <div class="card text-center p-4">
            <div class="card-body">
                <div class="display-4 mb-3">📢</div>
                <h5 class="card-title">Notices</h5>
                <p class="card-text">
                    <a href="<?php echo e(route('admin.notices.index')); ?>" class="btn btn-primary btn-sm">Post Notices</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Fees Card -->
    <div class="col-md-3">
        <div class="card text-center p-4">
            <div class="card-body">
                <div class="display-4 mb-3">💰</div>
                <h5 class="card-title">Fees</h5>
                <p class="card-text">
                    <a href="<?php echo e(route('admin.fees.index')); ?>" class="btn btn-primary btn-sm">Manage Fees</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Reports Card -->
    <div class="col-md-3">
        <div class="card text-center p-4">
            <div class="card-body">
                <div class="display-4 mb-3">📈</div>
                <h5 class="card-title">Reports</h5>
                <p class="card-text">
                    <a href="<?php echo e(route('admin.reports.index')); ?>" class="btn btn-primary btn-sm">View Reports</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Quick Actions</h5>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="<?php echo e(route('admin.students.create')); ?>" class="btn btn-success">Add New Student</a>
                    <a href="<?php echo e(route('admin.courses.create')); ?>" class="btn btn-success">Add New Course</a>
                    <a href="<?php echo e(route('admin.faculty.create')); ?>" class="btn btn-success">Add New Faculty</a>
                    <a href="<?php echo e(route('admin.notices.create')); ?>" class="btn btn-info">Post New Notice</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-education-erp\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>