<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe - SecureGuard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #1e3c72;
            --primary-light: #2a5298;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            min-height: 100vh;
        }

        .reset-container {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 40px 20px;
        }

        .reset-container::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(30deg, rgba(255,255,255,.02) 12%, transparent 12.5%, transparent 87%, rgba(255,255,255,.02) 87.5%),
                linear-gradient(150deg, rgba(255,255,255,.02) 12%, transparent 12.5%, transparent 87%, rgba(255,255,255,.02) 87.5%);
            background-size: 80px 140px;
        }

        .reset-card {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 45px 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 460px;
            width: 100%;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #fff;
            box-shadow: 0 10px 30px rgba(30, 60, 114, 0.4);
        }

        .logo-container h1 {
            color: #1e3c72;
            font-size: 28px;
            font-weight: 800;
            margin: 0 0 8px 0;
        }

        .logo-container p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            font-weight: 500;
        }

        .form-label {
            color: #334155;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
            display: block;
        }

        .form-control {
            width: 100%;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 20px 14px 50px;
            color: #1e293b;
            font-size: 15px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-control:focus {
            background: #fff;
            border-color: #1e3c72;
            box-shadow: 0 0 0 4px rgba(30, 60, 114, 0.1);
            outline: none;
        }

        .input-group {
            position: relative;
            margin-bottom: 18px;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 16px;
            z-index: 10;
        }

        .input-group:focus-within .input-icon {
            color: #1e3c72;
        }

        .toggle-password {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .toggle-password:hover {
            color: #1e3c72;
        }

        .btn-reset {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(30, 60, 114, 0.4);
            margin-top: 10px;
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 60, 114, 0.5);
        }

        .btn-reset i {
            margin-right: 8px;
        }

        .alert {
            background: #fee2e2;
            border: 2px solid #fecaca;
            border-radius: 10px;
            color: #991b1b;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 500;
        }

        @media (max-width: 576px) {
            .reset-card {
                padding: 35px 28px;
            }
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="reset-card">
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-lock-open"></i>
                </div>
                <h1>Nouveau mot de passe</h1>
                <p>Créez un mot de passe sécurisé</p>
            </div>

            @if ($errors->any())
                <div class="alert">
                    Veuillez corriger les erreurs dans le formulaire
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <label class="form-label">Adresse email</label>
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control" 
                            placeholder="nom@exemple.com"
                            value="{{ old('email', $request->email) }}"
                            required 
                            autofocus
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nouveau mot de passe</label>
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            name="password" 
                            id="password"
                            class="form-control" 
                            placeholder="Minimum 8 caractères"
                            required
                        >
                        <i class="fas fa-eye toggle-password" onclick="togglePassword('password')"></i>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation"
                            class="form-control" 
                            placeholder="Confirmez votre mot de passe"
                            required
                        >
                        <i class="fas fa-eye toggle-password" onclick="togglePassword('password_confirmation')"></i>
                    </div>
                </div>

                <button type="submit" class="btn-reset">
                    <i class="fas fa-check-circle"></i>
                    Réinitialiser le mot de passe
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.parentElement.querySelector('.toggle-password');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>