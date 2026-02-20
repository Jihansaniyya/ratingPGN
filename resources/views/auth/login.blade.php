<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rating Customer Gasnet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('images/backgound-loginGASNET.png') }}') center center;
            background-size: cover;
            filter: blur(10px);
            z-index: -1;
        }
        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.2);
            padding: 40px;
            backdrop-filter: blur(5px);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-logo img {
            max-width: 180px;
            height: auto;
        }
        .login-logo h4 {
            color: #2c5282;
            margin-top: 15px;
            font-weight: 600;
        }
        .login-logo small {
            color: #6c757d;
            font-size: 0.85rem;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .form-control {
            padding: 12px 15px;
            border: 1px solid #ced4da;
            border-radius: 6px;
        }
        .form-control:focus {
            border-color: #2c5282;
            box-shadow: 0 0 0 3px rgba(44, 82, 130, 0.15);
        }
        .btn-login {
            background: #2c5282;
            border: none;
            padding: 12px;
            font-weight: 500;
            width: 100%;
            border-radius: 6px;
        }
        .btn-login:hover {
            background: #234267;
        }
        .input-group-text {
            background: #f8f9fa;
            border-right: none;
        }
        .input-group .form-control {
            border-left: none;
        }
        .password-group {
            position: relative;
        }
        .password-group .form-control {
            padding-right: 40px;
            border-top-right-radius: 6px !important;
            border-bottom-right-radius: 6px !important;
        }
        .alert {
            border-radius: 6px;
            font-size: 0.9rem;
        }
        /* Hide browser default password reveal button */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-webkit-credentials-auto-fill-button {
            display: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-logo">
                <img src="{{ asset('images/logoGASNET.png') }}" alt="Gasnet Logo">
                <h4> On-Site Customer</h4>
                <small>PT Telemedia Dinamika Sarana</small>
            </div>

            @if($errors->any())
                <div class="alert alert-danger mb-3">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope text-muted"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group password-group">
                        <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
                        <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Masukkan password" required>
                        <button type="button" id="togglePassword" class="input-group-text" style="cursor: pointer; border: none; background: transparent; display: none; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); z-index: 10;">
                            <i class="fas fa-eye text-muted" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>
            </form>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('passwordInput');
        const togglePassword = document.getElementById('togglePassword');

        passwordInput.addEventListener('input', function() {
            togglePassword.style.display = this.value.length > 0 ? 'flex' : 'none';
        });

        togglePassword.addEventListener('click', function() {
            const icon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    </script>
</body>
</html>
