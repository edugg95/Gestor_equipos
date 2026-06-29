<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestor IT | Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">

        <div class="container">
            <a class="navbar-brand fw-bold" href="/login">
                <i class="bi bi-box-arrow-right me-2"></i>Iniciar Sesión
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-4">

                <div class="card border-0 shadow rounded-4 p-4">
                    <h3 class="mb-4 text-center text-dark fw-bold">Registro</h3>

                    <form action="/registro" method="POST">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control bg-light" id="name" name="name" placeholder="Nombre"
                                required>
                            <label for="name" class="text-muted"><i class="bi bi-person me-2"></i>Nombre</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control bg-light" id="email" name="email"
                                placeholder="correo@ejemplo.com" required>
                            <label for="email" class="text-muted"><i class="bi bi-envelope me-2"></i>Correo
                                Electrónico</label>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control bg-light" id="password" name="password"
                                placeholder="Contraseña" required>
                            <label for="password" class="text-muted"><i class="bi bi-key me-2"></i>Contraseña</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold">
                                <i class="bi bi-person-plus me-2"></i>Registrar
                            </button>
                            <a href="/login" class="btn btn-light rounded-pill text-muted fw-bold">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>

</html>