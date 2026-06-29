<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestor IT | Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        // Se ejecuta cuando la página ha terminado de cargar
        document.addEventListener("DOMContentLoaded", function() {
            // Ponemos un temporizador  (3 segundos)
            setTimeout(function() {
                // Buscamos todas las alertas que haya en la pantalla
                let alertas = document.querySelectorAll('.alert');
                
                alertas.forEach(function(alerta) {
                    // Usamos la función nativa de Bootstrap para cerrarlas con animación
                    let bsAlert = new bootstrap.Alert(alerta);
                    bsAlert.close();
                });
            }, 3000);
        });
    </script>
</body>
</head>

<body class="bg-light d-flex align-items-center vh-100">

    <div class="container">

        <div class="container mt-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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