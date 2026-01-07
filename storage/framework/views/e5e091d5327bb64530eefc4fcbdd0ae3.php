

<?php $__env->startSection('title', 'Student Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Welcome, <?php echo e(Auth::user()->name ?? Auth::user()->username); ?>!</h2>
    </div>
</div>

<div class="row g-4">
    <!-- Profile Card -->
    <div class="col-md-3">
        <div class="card text-center p-4">
            <div class="card-body">
                <div class="display-4 mb-3">👤</div>
                <h5 class="card-title">My Profile</h5>
                <p class="card-text">
                    <a href="<?php echo e(route('student.profile.index')); ?>" class="btn btn-primary btn-sm">View Profile</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Courses Card -->
    <div class="col-md-3">
        <div class="card text-center p-4">
            <div class="card-body">
                <div class="display-4 mb-3">📚</div>
                <h5 class="card-title">My Courses</h5>
                <p class="card-text">
                    <a href="<?php echo e(route('student.courses.index')); ?>" class="btn btn-primary btn-sm">View Courses</a>
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
                    <a href="<?php echo e(route('student.attendance.index')); ?>" class="btn btn-primary btn-sm">View Attendance</a>
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
                    <a href="<?php echo e(route('student.results.index')); ?>" class="btn btn-primary btn-sm">View Results</a>
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
                    <a href="<?php echo e(route('student.fees.index')); ?>" class="btn btn-primary btn-sm">View Fees</a>
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
                    <a href="<?php echo e(route('student.notices.index')); ?>" class="btn btn-primary btn-sm">View Notices</a>
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
                    <a href="<?php echo e(route('student.reports.index')); ?>" class="btn btn-primary btn-sm">View Reports</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.student', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-education-erp\resources\views/student/dashboard.blade.php ENDPATH**/ ?>