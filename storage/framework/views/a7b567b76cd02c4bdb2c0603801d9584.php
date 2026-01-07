<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $__env->yieldContent('title', 'Educational ERP System'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600,700&display=swap" rel="stylesheet">
    <style>
    body { font-family: 'Inter', 'Segoe UI', Arial, sans-serif; background: linear-gradient(135deg, #2563eb 0%, #f59e42 100%); min-height: 100vh; }
    .glass-card {
        background: rgba(255,255,255,0.85);
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(30,41,59,0.18);
        backdrop-filter: blur(12px);
        border: 1.5px solid #e2e8f0;
        padding: 2.5rem 2rem 2rem 2rem;
        margin-top: 2rem;
        animation: floatIn 1.2s cubic-bezier(.4,0,.2,1);
    }
    @keyframes floatIn {
      from { opacity: 0; transform: translateY(40px) scale(0.98); }
      to { opacity: 1; transform: none; }
    }
    .hero-emoji {
        font-size: 3.5rem;
        animation: float 3s ease-in-out infinite alternate;
        display: inline-block;
    }
    @keyframes float {
      from { transform: translateY(0); }
      to { transform: translateY(-18px); }
    }
    .feature-card {
        border-radius: 1.2rem;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.10);
        transition: box-shadow 0.2s, transform 0.1s, background 0.3s;
        background: rgba(255,255,255,0.92);
        border: 1.5px solid #e2e8f0;
        backdrop-filter: blur(8px);
        min-height: 180px;
        cursor: pointer;
    }
    .feature-card:hover {
        box-shadow: 0 8px 32px 0 rgba(37,99,235,0.18);
        transform: translateY(-6px) scale(1.03);
        background: #f8fafc;
    }
    .feature-icon {
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
        animation: popIn 1s cubic-bezier(.4,0,.2,1);
    }
    @keyframes popIn {
      from { opacity: 0; transform: scale(0.7); }
      to { opacity: 1; transform: none; }
    }
    .footer {
        background: rgba(30,41,59,0.95);
        color: #fff;
        padding: 2rem 0 1rem 0;
        margin-top: 3rem;
        border-top-left-radius: 2rem;
        border-top-right-radius: 2rem;
        box-shadow: 0 -2px 16px 0 rgba(30,41,59,0.12);
        animation: floatIn 1.2s cubic-bezier(.4,0,.2,1);
    }
    .footer a { color: #f59e42; text-decoration: none; transition: color 0.2s; }
    .footer a:hover { color: #fff; text-decoration: underline; }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <?php echo $__env->yieldContent('content'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>

<?php /**PATH C:\laragon\www\laravel-education-erp\resources\views/layouts/app.blade.php ENDPATH**/ ?>