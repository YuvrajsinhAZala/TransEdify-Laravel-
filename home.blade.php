@extends('layouts.app')

@section('title', 'Educational ERP System')

@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
    <div class="glass-card w-100" style="max-width: 650px;">
        <div class="text-center mb-4">
            <span class="hero-emoji">🎓</span>
            <h1 class="fw-bold mt-3 mb-2" style="background:linear-gradient(135deg,#2563eb,#f59e42);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Welcome to Educational ERP</h1>
            <p class="lead text-secondary">A modern, intuitive platform for university management.<br>Empowering <b>Admins</b> and <b>Students</b> with seamless digital experiences.</p>
        </div>
        <div class="row g-4 mb-4">
            <div class="col-12 col-md-6">
                <a href="{{ route('login') }}" class="text-decoration-none">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">🛡️</div>
                        <h5 class="fw-bold mb-2">Admin Portal</h5>
                        <p class="text-muted mb-0">Manage students, courses, attendance, results, fees, and more with powerful tools and analytics.</p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6">
                <a href="{{ route('register') }}" class="text-decoration-none">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">🎒</div>
                        <h5 class="fw-bold mb-2">Student Portal</h5>
                        <p class="text-muted mb-0">Access courses, attendance, results, fees, and important notices in a user-friendly dashboard.</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-5">Student Register</a>
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
        <div class="small">&copy; {{ date('Y') }} Educational ERP. All rights reserved.</div>
    </div>
</footer>
@endsection

