<?php
include '../config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
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
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin ERP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="manage_students.php">Students</a></li>
        <li class="nav-item"><a class="nav-link" href="manage_courses.php">Courses</a></li>
        <li class="nav-item"><a class="nav-link" href="manage_faculty.php">Faculty</a></li>
        <li class="nav-item"><a class="nav-link" href="assign_courses.php">Assign Courses</a></li>
        <li class="nav-item"><a class="nav-link" href="attendance.php">Attendance</a></li>
        <li class="nav-item"><a class="nav-link" href="results.php">Results</a></li>
        <li class="nav-item"><a class="nav-link" href="notices.php">Notices</a></li>
        <li class="nav-item"><a class="nav-link" href="fees.php">Fees</a></li>
        <li class="nav-item"><a class="nav-link" href="reports.php">Reports</a></li>
        <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
    <div class="glass-card w-100" style="max-width: 900px;">
        <div class="text-center mb-4">
            <span class="hero-emoji">🛡️</span>
            <h1 class="fw-bold mt-3 mb-2" style="background:linear-gradient(135deg,#2563eb,#f59e42);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Admin Dashboard</h1>
            <p class="lead text-secondary">Welcome, Admin! Manage your university with powerful tools and analytics.<br>Access all features below.</p>
        </div>
        <div class="row g-4 mb-4">
            <div class="col-12 col-sm-6 col-md-4">
                <a href="manage_students.php" class="text-decoration-none">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">👨‍🎓</div>
                        <h5 class="fw-bold mb-2">Manage Students</h5>
                        <p class="text-muted mb-0">Add, edit, and organize student records efficiently.</p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="manage_courses.php" class="text-decoration-none">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">📚</div>
                        <h5 class="fw-bold mb-2">Manage Courses</h5>
                        <p class="text-muted mb-0">Create and update courses, descriptions, and codes.</p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="manage_faculty.php" class="text-decoration-none">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">👩‍🏫</div>
                        <h5 class="fw-bold mb-2">Manage Faculty</h5>
                        <p class="text-muted mb-0">Add, edit, and manage faculty members and assignments.</p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="assign_courses.php" class="text-decoration-none">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">🔗</div>
                        <h5 class="fw-bold mb-2">Assign Courses</h5>
                        <p class="text-muted mb-0">Assign students and faculty to courses with ease.</p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="attendance.php" class="text-decoration-none">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">🗓️</div>
                        <h5 class="fw-bold mb-2">Attendance</h5>
                        <p class="text-muted mb-0">Mark, edit, and review student attendance records.</p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="results.php" class="text-decoration-none">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">📈</div>
                        <h5 class="fw-bold mb-2">Results</h5>
                        <p class="text-muted mb-0">Enter, edit, and analyze student results and grades.</p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="notices.php" class="text-decoration-none">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">📢</div>
                        <h5 class="fw-bold mb-2">Notices</h5>
                        <p class="text-muted mb-0">Post and manage important university notices.</p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="fees.php" class="text-decoration-none">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">💳</div>
                        <h5 class="fw-bold mb-2">Fees</h5>
                        <p class="text-muted mb-0">Assign and update student fee records and status.</p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="reports.php" class="text-decoration-none">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">📊</div>
                        <h5 class="fw-bold mb-2">Reports</h5>
                        <p class="text-muted mb-0">View and export analytics and performance reports.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<footer class="footer mt-5">
    <div class="container text-center">
        <div class="mb-2">
            <a href="#" class="me-3">About</a>
            <a href="#" class="me-3">Contact</a>
            <a href="#">Help</a>
        </div>
        <div class="mb-2">
            <span class="me-2">Follow us:</span>
            <a href="#" class="me-2">🐦</a>
            <a href="#" class="me-2">📘</a>
            <a href="#">📸</a>
        </div>
        <div class="small">&copy; <?= date('Y') ?> Educational ERP. All rights reserved.</div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
