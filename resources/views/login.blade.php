<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestor IT | Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center vh-100">

    <div class="container">
        <div class="col-md-5 mx-auto card border-0 shadow-lg rounded-4 p-4">

            <form action="/login" method="POST">

                <!-- Le mandamos el token CSRF , es como una clave de seguridad de un uso para los formularios que esconde un campo oculto
                 Esto es importante para evitar que los formularios sean enviados por un malicioso usuario
                 En el controlador, le pedimos al token CSRF y le devolvemos al formulario
                 El token CSRF se guarda en la sesión del usuario, si el token CSRF no coincide, el formulario no se envia, si el token CSRF coincide, el formulario se envia
                 El token CSRF es un secreto que solo el servidor sabe La clave de seguridad es un secreto que solo el usuario sabe, la clave de seguridad se guarda en la base de datos -->

                @csrf

                <!-- Le pregunta al controlador si el email es correcto -->
                @error('email')
                    <div class="alert alert-danger text-center shadow-sm py-2">
                        {{ $message }} <!-- Blade sustituye el mensaje por el que le enviamos -->
                    </div>
                @enderror

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" required>
                    <label for="email">Correo Electrónico</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <label for="password">Contraseña</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-lg"> Iniciar Sesión </button>

            </form>

            <div class="text-center mt-4 pt-3 border-top">
                <a href="/registro" class="text-primary text-decoration-none">Registrarse</a>
            </div>

        </div>
    </div>

</body>

</html>
