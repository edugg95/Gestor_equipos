<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestor IT | Añadir Equipo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/equipos">
                <i class="bi bi-pc-display-horizontal me-2"></i>Gestor IT Corp
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-4">

                <div class="card border-0 shadow rounded-4 p-4">
                    <h3 class="mb-4 text-center text-dark fw-bold">Nuevo Equipo</h3>

                    <form action="/equipos" method="POST">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control bg-light" id="marca" name="marca"
                                placeholder="Lenovo" required>
                            <label for="marca" class="text-muted"><i class="bi bi-tag me-2"></i>Marca del
                                Equipo</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control bg-light" id="modelo" name="modelo"
                                placeholder="ThinkPad" required>
                            <label for="modelo" class="text-muted"><i class="bi bi-laptop me-2"></i>Modelo</label>
                        </div>

                        <div class="form-floating mb-4">
                            <select class="form-select bg-light" id="estado" name="estado" required>
                                <option value="" disabled selected>Despliega para elegir...</option>
                                <option value="Disponible">🟢 Disponible</option>
                                <option value="Asignado">🔵 Asignado</option>
                                <option value="En Reparación">🔴 En Reparación</option>
                            </select>
                            <label for="estado" class="text-muted"><i class="bi bi-activity me-2"></i>Estado
                                Actual</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold">
                                <i class="bi bi-save me-2"></i>Guardar en Inventario
                            </button>
                            <a href="/equipos" class="btn btn-light rounded-pill text-muted fw-bold">
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
