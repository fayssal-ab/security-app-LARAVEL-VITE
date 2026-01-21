<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - SecureGuard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #1e3c72;
            --primary-light: #2a5298;
            --success: #10b981;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        .forgot-container {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            overflow: hidden;
        }

        .forgot-container::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(30deg, rgba(255,255,255,.02) 12%, transparent 12.5%, transparent 87%, rgba(255,255,255,.02) 87.5%),
                linear-gradient(150deg, rgba(255,255,255,.02) 12%, transparent 12.5%, transparent 87%, rgba(255,255,255,.02) 87.5%);
            background-size: 80px 140px;
        }

        .forgot-card {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 50px 45px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 450px;
            width: 90%;
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
            margin: 0 0 10px 0;
        }

        .logo-container p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
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
            margin-bottom: 25px;
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
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 60, 114, 0.5);
        }

        .btn-reset i {
            margin-right: 8px;
        }

        .back-login {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid #f1f5f9;
        }

        .back-login a {
            color: #1e3c72;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-login a:hover {
            color: #2a5298;
        }

        .alert {
            background: #d1fae5;
            border: 2px solid #a7f3d0;
            border-radius: 10px;
            color: #065f46;
            padding: 14px 18px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            font-size: 14px;
        }

        .alert i {
            font-size: 16px;
        }

        @media (max-width: 576px) {
            .forgot-card {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <div class="forgot-card">
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-key"></i>
                </div>
                <h1>Mot de passe oublié ?</h1>
                <p>Entrez votre email pour recevoir un lien de réinitialisation</p>
            </div>

            @if (session('status'))
                <div class="alert">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Adresse email</label>
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control" 
                            placeholder="nom@exemple.com"
                            value="{{ old('email') }}"
                            required 
                            autofocus
                        >
                    </div>
                </div>

                <button type="submit" class="btn-reset">
                    <i class="fas fa-paper-plane"></i>
                    Envoyer le lien
                </button>

                <div class="back-login">
                    <a href="{{ route('login') }}">
                        <i class="fas fa-arrow-left"></i>
                        Retour à la connexion
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>