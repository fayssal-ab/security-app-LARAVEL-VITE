<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification Email - SecureGuard</title>
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

        .verify-container {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }

        .verify-container::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(30deg, rgba(255,255,255,.02) 12%, transparent 12.5%, transparent 87%, rgba(255,255,255,.02) 87.5%),
                linear-gradient(150deg, rgba(255,255,255,.02) 12%, transparent 12.5%, transparent 87%, rgba(255,255,255,.02) 87.5%);
            background-size: 80px 140px;
        }

        .verify-card {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 50px 45px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 480px;
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
            margin: 0 0 15px 0;
        }

        .logo-container p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.7;
            font-weight: 500;
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

        .btn-container {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 25px;
        }

        .btn-verify {
            flex: 1;
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

        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 60, 114, 0.5);
        }

        .btn-verify i {
            margin-right: 8px;
        }

        .btn-logout {
            padding: 15px 20px;
            background: #f8fafc;
            color: #64748b;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: #e2e8f0;
            color: #334155;
        }

        @media (max-width: 576px) {
            .verify-card {
                padding: 40px 30px;
            }

            .btn-container {
                flex-direction: column;
            }

            .btn-logout {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="verify-container">
        <div class="verify-card">
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-envelope-circle-check"></i>
                </div>
                <h1>Vérifiez votre email</h1>
                <p>Merci de vous être inscrit ! Veuillez vérifier votre adresse email en cliquant sur le lien que nous vous avons envoyé.</p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert">
                    <i class="fas fa-check-circle"></i>
                    Un nouveau lien de vérification a été envoyé !
                </div>
            @endif

            <div class="btn-container">
                <form method="POST" action="{{ route('verification.send') }}" style="flex: 1;">
                    @csrf
                    <button type="submit" class="btn-verify">
                        <i class="fas fa-paper-plane"></i>
                        Renvoyer l'email
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>