<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AtlasMaint</title>
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Google Fonts: Roboto & Material Icons Rounded -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            background-color: #F5F5F5;
        }
        main {
            flex: 1 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(227,30,36,0.15); /* Sombra brand */
            border: 1px solid #FEE2E2;
        }
        .brand-logo-text {
            color: #E31E24; /* Rojo Tequendama */
            font-weight: 900;
            font-size: 2.2rem;
            text-align: center;
            margin-bottom: 5px;
        }
        .brand-subtitle {
            color: #808080;
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.1rem;
            font-weight: 500;
        }
        /* Estilos Design System CT */
        .btn-ct-primary {
            background-color: #E31E24 !important;
            color: #FFFFFF !important;
            border-radius: 4px;
            font-weight: 700;
            text-transform: uppercase;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            transition: all 150ms cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-ct-primary:hover {
            background-color: #C41E3A !important;
            transform: translateY(-1px);
            box-shadow: 0 8px 32px rgba(227,30,36,0.15);
        }
        .input-field input:focus + label { color: #E31E24 !important; }
        .input-field input:focus { border-bottom: 1px solid #E31E24 !important; box-shadow: 0 1px 0 0 #E31E24 !important; }
        .input-field .prefix.active { color: #E31E24; }
        .material-icons-round { color: #E31E24; }
        .input-field .prefix { color: #808080; }
    </style>
</head>
<body>

<main>
    <div class="card login-card">
        <div class="card-content" style="padding: 0;">
            <div class="center-align" style="margin-bottom: 20px;">
                <img src="assets/img/logo_color.png" alt="Logo Tequendama" style="max-width: 220px; height: auto;">
            </div>
            <div class="brand-logo-text" style="font-size: 1.8rem; margin-top: 10px;">
                <i class="material-icons-round" style="font-size: 2.2rem; vertical-align: middle; color: #E31E24;">engineering</i>
                AtlasMaint
            </div>
            <div class="brand-subtitle">Gestión de Mantenimiento</div>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="card-panel red lighten-4 red-text text-darken-4" style="padding: 10px; border-radius: 4px; display: flex; align-items: center;">
                    <i class="material-icons-round left" style="color: #C41E3A;">error_outline</i>
                    <span><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></span>
                </div>
            <?php endif; ?>

            <form action="controllers/AuthController.php" method="POST">
                <input type="hidden" name="action" value="login">
                
                <div class="input-field" style="margin-top: 32px;">
                    <i class="material-icons-round prefix">email</i>
                    <input id="email" type="email" name="email" required>
                    <label for="email">Correo Electrónico</label>
                </div>

                <div class="input-field">
                    <i class="material-icons-round prefix">lock</i>
                    <input id="password" type="password" name="password" required>
                    <label for="password">Contraseña</label>
                </div>

                <div class="center-align" style="margin-top: 32px;">
                    <button class="btn btn-large waves-effect waves-light btn-ct-primary" type="submit" style="width: 100%;">
                        Iniciar Sesión
                        <i class="material-icons-round right" style="color: white;">login</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- Materialize JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
