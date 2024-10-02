<!doctype html>
<html>

<head>
    <link rel="shortcut icon" href="#" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

    <link rel="stylesheet" type="text/css" href="fuentes/iconic/css/material-design-iconic-font.min.css">

</head>

<body>

    <div class="container-login">
        <div class="wrap-login">
            <!-- Formulario de login -->
            <form class="login-form validate-form" id="formLogin" action="" method="post">
                <span class="login-form-title">LOGIN</span>

                <div class="wrap-input100" data-validate="Usuario incorrecto">
                    <input class="input100" type="text" id="usuario" name="usuario" placeholder="Usuario">
                    <span class="focus-efecto"></span>
                </div>

                <div class="wrap-input100" data-validate="Password incorrecto">
                    <input class="input100" type="password" id="password" name="password" placeholder="Password">
                    <span class="focus-efecto"></span>
                </div>

                <div class="container-login-form-btn">
                    <div class="wrap-login-form-btn">
                        <div class="login-form-bgbtn"></div>
                        <button type="submit" name="submit" class="login-form-btn">CONECTAR</button>
                    </div>
                </div>
            </form>

            <!-- Botón de registro -->
            <div class="container-login-form-btn mt-4">
                <div class="wrap-login-form-btn">
                    <div class="login-form-bgbtn"></div>
                    <button type="button" class="login-form-btn"
                        onclick="window.location.href='registro.html'">REGISTRARSE</button>
                </div>
            </div>

            <!-- Opción de recuperar contraseña -->
            <!-- <div class="text-center mt-3">
            <a href="recuperar.html" class="txt1">
                ¿Olvidaste tu contraseña?
            </a>
        </div>
    </div>
</div>      -->


            <script src="jquery/jquery-3.3.1.min.js"></script>
            <script src="bootstrap/js/bootstrap.min.js"></script>
            <script src="popper/popper.min.js"></script>

            <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
            <script src="codigo.js"></script>
</body>

</html>