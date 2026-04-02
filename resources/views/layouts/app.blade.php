<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BPBD Kab. Jember - @yield('title')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #2c7da0;
            --primary-light: #61a5c2;
            --primary-dark: #1e5a77;
            --secondary: #2ecc71;
            --success: #27ae60;
            --danger: #e74c3c;
            --warning: #f39c12;
            --info: #3498db;
            --dark: #2c3e50;
            --light: #ecf0f1;
            --bg-light: #f8f9fa;
            --bg-white: #ffffff;
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.05);
            --border-radius: 12px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f0f4f8;
            min-height: 100vh;
            color: var(--text-dark);
            line-height: 1.6;
        }
        
        /* Top Bar / Header */
        .top-bar {
            background: linear-gradient(135deg, #2c7da0 0%, #1e5a77 100%);
            padding: 0 25px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-md);
        }
        
        .top-bar .navbar-brand {
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            padding: 15px 0;
            display: inline-block;
        }
        
        .top-bar .navbar-brand i {
            font-size: 1.4rem;
            margin-right: 10px;
        }
        
        /* User Dropdown */
        .user-dropdown {
            cursor: pointer;
        }
        
        .user-dropdown .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 12px;
            border-radius: 40px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .user-dropdown .user-info:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .user-dropdown .user-info img {
            width: 36px;
            height: 36px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .user-dropdown .user-info span {
            color: white;
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .user-dropdown .user-info i {
            color: white;
            font-size: 0.8rem;
        }
        
        .dropdown-menu {
            border-radius: 12px;
            border: none;
            box-shadow: var(--shadow-lg);
            margin-top: 10px;
        }
        
        .dropdown-item {
            padding: 10px 20px;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background: rgba(44, 125, 160, 0.1);
            color: var(--primary);
        }
        
        .dropdown-item i {
            width: 20px;
            margin-right: 10px;
            color: var(--text-light);
        }
        
        .top-bar .date-time {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.85rem;
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 12px;
            border-radius: 20px;
        }
        
        /* Sidebar */
        .sidebar {
            min-height: calc(100vh - 60px);
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            border-right: 1px solid rgba(44, 62, 80, 0.08);
            transition: all 0.3s ease;
            position: sticky;
            top: 60px;
            box-shadow: var(--shadow-sm);
        }
        
        .sidebar .logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(44, 62, 80, 0.08);
            margin-bottom: 20px;
        }
        
        .sidebar .logo h4 {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary);
            margin: 0;
        }
        
        .sidebar .logo p {
            color: var(--text-light);
            font-size: 0.7rem;
            margin: 5px 0 0;
        }
        
        .sidebar a {
            color: var(--text-dark);
            text-decoration: none;
            padding: 10px 20px;
            margin: 3px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            border-radius: var(--border-radius);
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .sidebar a i {
            font-size: 1.1rem;
            width: 24px;
            color: var(--text-light);
        }
        
        .sidebar a:hover {
            background: rgba(44, 125, 160, 0.08);
            color: var(--primary);
            transform: translateX(5px);
        }
        
        .sidebar a:hover i {
            color: var(--primary);
        }
        
        .sidebar a.active {
            background: rgba(44, 125, 160, 0.12);
            color: var(--primary);
        }
        
        .sidebar a.active i {
            color: var(--primary);
        }
        
        /* Main Content */
        .content {
            padding: 25px;
            min-height: calc(100vh - 60px);
        }
        
        /* Card */
        .card {
            border: none;
            border-radius: 20px;
            background: var(--bg-white);
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(44, 62, 80, 0.08);
        }
        
        .card:hover {
            box-shadow: var(--shadow-md);
        }
        
        .card-header {
            background: var(--bg-white);
            border-bottom: 1px solid rgba(44, 62, 80, 0.08);
            padding: 15px 20px;
            font-weight: 600;
        }
        
        .card-header h3, .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 1.1rem;
        }
        
        .card-body {
            padding: 20px;
        }
        
        /* Buttons */
        .btn {
            border-radius: 8px;
            padding: 6px 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.85rem;
        }
        
        .btn-primary {
            background: var(--primary);
            border: none;
        }
        
        .btn-primary:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(44, 125, 160, 0.2);
        }
        
        .btn-success {
            background: var(--success);
            border: none;
        }
        
        .btn-danger {
            background: var(--danger);
            border: none;
        }
        
        /* Table */
        .table {
            border-radius: 12px;
            overflow: hidden;
        }
        
        .table thead th {
            background: #f8fafc;
            color: var(--primary-dark);
            font-weight: 600;
            border-bottom: 2px solid rgba(44, 62, 80, 0.08);
            padding: 12px;
            font-size: 0.85rem;
        }
        
        .table tbody tr {
            transition: all 0.2s ease;
        }
        
        .table tbody tr:hover {
            background: rgba(44, 125, 160, 0.03);
        }
        
        .table tbody td {
            padding: 10px 12px;
            vertical-align: middle;
            font-size: 0.85rem;
        }
        
        /* Badge */
        .badge {
            padding: 4px 8px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.7rem;
        }
        
        .badge-success {
            background: rgba(46, 204, 113, 0.15);
            color: #27ae60;
        }
        
        /* Form */
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid rgba(44, 62, 80, 0.15);
            padding: 8px 12px;
            font-size: 0.85rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(44, 125, 160, 0.1);
        }
        
        label {
            font-weight: 500;
            color: var(--primary-dark);
            margin-bottom: 5px;
            font-size: 0.8rem;
        }
        
        /* Alert */
        .alert {
            border-radius: 10px;
            border: none;
            padding: 12px 18px;
            margin-bottom: 20px;
            font-size: 0.85rem;
        }
        
        .alert-success {
            background: rgba(46, 204, 113, 0.1);
            color: #27ae60;
            border-left: 3px solid #27ae60;
        }
        
        .alert-danger {
            background: rgba(231, 76, 60, 0.1);
            color: #c0392b;
            border-left: 3px solid #e74c3c;
        }
        
        /* Tabs */
        .nav-tabs {
            border-bottom: 1px solid rgba(44, 62, 80, 0.1);
        }
        
        .nav-tabs .nav-link {
            border: none;
            color: var(--text-light);
            font-weight: 500;
            padding: 8px 16px;
            font-size: 0.85rem;
        }
        
        .nav-tabs .nav-link.active {
            color: var(--primary);
            border-bottom: 2px solid var(--primary);
        }
        
        /* Pagination */
        .pagination .page-link {
            border-radius: 6px;
            margin: 0 2px;
            color: var(--primary);
            border: 1px solid rgba(44, 62, 80, 0.1);
            padding: 6px 10px;
            font-size: 0.8rem;
        }
        
        .pagination .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
        }
        
        /* Loading */
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: none;
        }
        
        .loader {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(44, 125, 160, 0.2);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .top-bar .date-time {
                display: none;
            }
            
            .content {
                padding: 15px;
            }
            
            .sidebar {
                position: fixed;
                transform: translateX(-100%);
                z-index: 1050;
                top: 0;
                min-height: 100vh;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .menu-toggle {
                position: fixed;
                bottom: 20px;
                right: 20px;
                width: 45px;
                height: 45px;
                background: var(--primary);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                z-index: 1060;
                box-shadow: var(--shadow-md);
                display: flex;
            }
            
            .menu-toggle i {
                color: white;
                font-size: 1.2rem;
            }
        }
        
        @media (min-width: 769px) {
            .menu-toggle {
                display: none;
            }
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }
        
        /* Print */
        @media print {
            .top-bar, .sidebar, .menu-toggle, .btn, .no-print {
                display: none !important;
            }
            .content {
                padding: 0;
            }
            .card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>
<body>
    <div class="loading">
        <div class="loader"></div>
    </div>
    
    <div class="menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </div>
    
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="navbar-brand">
                        <i class="fas fa-shield-alt"></i>
                        BPBD Kabupaten Jember
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end align-items-center gap-3">
                        <div class="date-time" id="current-time">
                            <i class="far fa-calendar-alt me-1"></i>
                            Memuat...
                        </div>
                        
                        @auth
                        <div class="dropdown user-dropdown">
                            <div class="user-info" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->foto_url }}" alt="Avatar">
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end">
                                
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0 sidebar" id="sidebar">
                <div class="logo">
                    <h4>
                        <i class="fas fa-chart-line me-2"></i>Menu
                    </h4>
                    <p>Sistem Kepegawaian</p>
                </div>
                
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('pegawai.index') }}" class="{{ request()->routeIs('pegawai.index') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Data Pegawai</span>
                </a>
                <a href="{{ route('pegawai.create') }}" class="{{ request()->routeIs('pegawai.create') ? 'active' : '' }}">
                    <i class="fas fa-user-plus"></i>
                    <span>Tambah Pegawai</span>
                </a>
                <a href="{{ route('kenaikan-gaji.index') }}" class="{{ request()->routeIs('kenaikan-gaji*') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Kenaikan Gaji</span>
                </a>
                
                
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 content">
                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Terjadi kesalahan!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <!-- Yield Content -->
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Hide loading
            $('.loading').fadeOut(300);
            
            // Auto hide alerts after 4 seconds
            setTimeout(function() {
                $('.alert').fadeOut(300);
            }, 4000);
            
            // Update time
            updateTime();
            setInterval(updateTime, 1000);
        });
        
        function updateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                day: 'numeric', 
                month: 'long', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('current-time').innerHTML = '<i class="far fa-calendar-alt me-1"></i> ' + now.toLocaleDateString('id-ID', options);
        }
        
        // Show loading on form submit
        $('form').not('#logout-form').submit(function() {
            $('.loading').fadeIn();
        });
        
        // Toggle sidebar mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.querySelector('.menu-toggle');
            if (window.innerWidth <= 768) {
                if (sidebar && !sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
        
        // Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // DataTable initialization
        if ($.fn.DataTable) {
            $('.datatable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
                },
                pageLength: 10,
                responsive: true
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>