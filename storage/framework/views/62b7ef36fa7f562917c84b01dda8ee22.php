<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?> - Educational ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600,700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', 'Segoe UI', Arial, sans-serif; background: #f8f9fa; }
        .sidebar { 
            min-height: 100vh; 
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.9);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: #fff;
            transform: translateX(5px);
        }
        .main-content { padding: 20px; }
        .card { border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-radius: 10px; }
        .navbar-brand { font-weight: 700; color: #2563eb !important; }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-4">
                    <h4 class="text-white mb-4">🎓 Admin Panel</h4>
                    <nav class="nav flex-column">
                        <a class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                            📊 Dashboard
                        </a>
                        <a class="nav-link <?php echo e(request()->routeIs('admin.students.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.students.index')); ?>">
                            👥 Students
                        </a>
                        <a class="nav-link <?php echo e(request()->routeIs('admin.courses.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.courses.index')); ?>">
                            📚 Courses
                        </a>
                        <a class="nav-link <?php echo e(request()->routeIs('admin.faculty.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.faculty.index')); ?>">
                            👨‍🏫 Faculty
                        </a>
                        <a class="nav-link <?php echo e(request()->routeIs('admin.enrollments.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.enrollments.index')); ?>">
                            📝 Enrollments
                        </a>
                        <a class="nav-link <?php echo e(request()->routeIs('admin.attendance.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.attendance.index')); ?>">
                            ✅ Attendance
                        </a>
                        <a class="nav-link <?php echo e(request()->routeIs('admin.results.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.results.index')); ?>">
                            📊 Results
                        </a>
                        <a class="nav-link <?php echo e(request()->routeIs('admin.notices.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.notices.index')); ?>">
                            📢 Notices
                        </a>
                        <a class="nav-link <?php echo e(request()->routeIs('admin.fees.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.fees.index')); ?>">
                            💰 Fees
                        </a>
                        <a class="nav-link <?php echo e(request()->routeIs('admin.reports.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.reports.index')); ?>">
                            📈 Reports
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <!-- Top Navbar -->
                <nav class="navbar navbar-light bg-white mb-4 rounded shadow-sm">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></span>
                        <div class="d-flex align-items-center">
                            <span class="me-3">Welcome, <?php echo e(Auth::user()->name ?? Auth::user()->username); ?></span>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                            </form>
                        </div>
                    </div>
                </nav>

                <!-- Flash Messages -->
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Page Content -->
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>

<?php /**PATH C:\laragon\www\laravel-education-erp\resources\views/layouts/admin.blade.php ENDPATH**/ ?>