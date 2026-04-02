<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BPBD Kab. Jember</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #2c7da0;
            --primary-dark: #1e5a77;
            --primary-light: #61a5c2;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;\\\\\\\\\\\\\\\\\\\\\\\\\\
            position: relative;
            overflow-x: hidden;
        }
        
        /* Background Animation */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        
        .bg-animation .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite;
        }
        
        .bg-animation .circle:nth-child(1) {
            width: 300px;
            height: 300px;
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }
        
        .bg-animation .circle:nth-child(2) {
            width: 200px;
            height: 200px;
            bottom: -50px;
            right: -50px;
            animation-delay: -5s;
        }
        
        .bg-animation .circle:nth-child(3) {
            width: 150px;
            height: 150px;
            top: 50%;
            left: 50%;
            animation-delay: -10s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-50px) rotate(180deg);
            }
        }
        
        /* Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            margin: 20px;
            position: relative;
            z-index: 1;
            animation: slideUp 0.5s ease;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 40px;
            text-align: center;
            color: white;
        }
        
        .login-header i {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        
        .login-header h3 {
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .login-header p {
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .login-body {
            padding: 40px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            font-weight: 500;
            color: var(--primary-dark);
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control {
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(44, 125, 160, 0.1);
        }
        
        .input-group-text {
            border-radius: 12px 0 0 12px;
            background: white;
            border: 2px solid #e2e8f0;
            border-right: none;
            color: var(--text-light);
        }
        
        .input-group .form-control {
            border-radius: 0 12px 12px 0;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(44, 125, 160, 0.3);
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            padding: 12px 15px;
            margin-bottom: 20px;
        }
        
        .alert-danger {
            background: rgba(231, 76, 60, 0.1);
            color: #c0392b;
            border-left: 3px solid #e74c3c;
        }
        
        .alert-success {
            background: rgba(46, 204, 113, 0.1);
            color: #27ae60;
            border-left: 3px solid #27ae60;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            color: var(--text-light);
            font-size: 0.85rem;
        }
        
        .footer a {
            color: var(--primary);
            text-decoration: none;
        }
        
        .footer a:hover {
            text-decoration: underline;
        }
        
        /* Loading */
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            display: none;
        }
        
        .loader {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        @media (max-width: 768px) {
            .login-header {
                padding: 30px;
            }
            .login-body {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="loading">
        <div class="loader"></div>
    </div>
    
    <div class="bg-animation">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    
    <div class="login-card">
        <div class="login-header">
            <i class="fas fa-shield-alt"></i>
            <h3>BPBD Kab. Jember</h3>
            <p>Sistem Informasi Kepegawaian</p>
        </div>
        
        <div class="login-body">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif
            
            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf
                
                <div class="form-group">
                    <label>
                        <i class="fas fa-user me-2"></i>Username
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
                               placeholder="Masukkan username" value="{{ old('username') }}" required autofocus>
                    </div>
                    @error('username')
                        <small class="text-danger mt-1">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-key"></i>
                        </span>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Masukkan password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password" style="border-radius: 0 12px 12px 0;">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <small class="text-danger mt-1">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-login text-white">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                </button>
            </form>
            
            <div class="footer">
                <p>BPBD Kabupaten Jember © {{ date('Y') }}</p>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle password visibility
            $('.toggle-password').click(function() {
                const input = $(this).closest('.input-group').find('input');
                const icon = $(this).find('i');
                
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
            
            // Show loading on submit
            $('#loginForm').submit(function() {
                $('.loading').fadeIn();
            });
        });
    </script>
</body>
</html>