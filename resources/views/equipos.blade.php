<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestor IT | Equipos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        // Se ejecuta cuando la página ha terminado de cargar
        document.addEventListener("DOMContentLoaded", function() {
            // Ponemos un temporizador de 3000 milisegundos (3 segundos)
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

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/equipos">
                <i class="bi bi-pc-display-horizontal me-2"></i>Gestor Equipos IT
            </a>

            <!-- boton de Logout -->
            <form action="/logout" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold">
                    <i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión
                </button>
            </form>
        </div>

    </nav>


    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">
        <!-- Botón para añadir equipos -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-secondary fw-bold m-0">Inventario de Equipos</h2>
            <a href="/equipos/crear" class="btn btn-primary shadow-sm fw-bold rounded-pill px-4">
                <i class="bi bi-plus-lg me-2"></i>Añadir Equipo
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">


                <!-- Formulario para filtrar por estado y marca -->

                <form action="/equipos" method="GET" class="card card-body border-0 shadow-sm mb-4 rounded-4">
                    <div class="row g-3">

                        <!-- Filtro por marca/modelo -->
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i
                                        class="bi bi-search text-muted"></i></span>
                                <input type="text" name="buscar" class="form-control border-start-0"
                                    placeholder="Buscar por marca, modelo..." value="{{ request('buscar') }}">
                            </div>
                        </div>

                        <!-- Filtro por estado -->
                        <div class="col-md-4">
                            <select name="estado" class="form-select">
                                <option value="">Estado</option>
                                <option value="Disponible" {{ request('estado') == 'Disponible' ? 'selected' : '' }}>
                                    🟢Disponible</option>
                                <option value="Asignado" {{ request('estado') == 'Asignado' ? 'selected' : '' }}>
                                    🔵Asignado
                                </option>
                                <option value="Reparacion" {{ request('estado') == 'Reparacion' ? 'selected' : '' }}>
                                    🔴 En reparación</option>
                            </select>
                        </div>

                        <!-- Botón para filtrar -->
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100 fw-bold">Filtrar</button>

                            <!-- Botón para limpiar el filtro -->
                            @if (request('buscar') || request('estado'))
                                <a href="/equipos" class="btn btn-light border"><i class="bi bi-x-lg"></i></a>
                            @endif
                        </div>

                    </div>
                </form>

                <!-- tabla de equipos -->

                <table class="table table-hover mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th class="px-4 py-3 text-muted">MARCA</th>
                            <th class="py-3 text-muted">MODELO</th>
                            <th class="py-3 text-muted">ESTADO</th>
                            <th class="px-4 py-3 text-end text-muted"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($equipos as $equipo)
                            <tr>
                                <td class="px-4 py-3 align-middle fw-bold">{{ $equipo->marca }}</td>
                                <td class="py-3 align-middle">{{ $equipo->modelo }}</td>
                                <td class="py-3 align-middle">
                                    @if ($equipo->estado == 'Disponible')
                                        <span class="badge bg-success rounded-pill px-3 py-2"><i
                                                class="bi bi-check-circle me-1"></i>Disponible</span>
                                    @elseif($equipo->estado == 'Asignado')
                                        <span class="badge bg-primary rounded-pill px-3 py-2"><i
                                                class="bi bi-person-badge me-1"></i>Asignado</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill px-3 py-2"><i
                                                class="bi bi-tools me-1"></i>En
                                            Reparación</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 align-middle text-end">

                                    <a href="/equipos/{{ $equipo->id }}/editar"
                                        class="btn btn-sm btn-outline-secondary me-1" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalBorrar{{ $equipo->id }}" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <div class="modal fade" id="modalBorrar{{ $equipo->id }}" tabindex="-1"
                                        aria-labelledby="modalLabel{{ $equipo->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">

                                                <div class="modal-header border-bottom-0 pb-0">
                                                    <h5 class="modal-title text-danger fw-bold"
                                                        id="modalLabel{{ $equipo->id }}">
                                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Confirmar
                                                        Eliminación
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Cerrar"></button>
                                                </div>

                                                <div class="modal-body text-start py-4">
                                                    <p class="mb-1">¿Estás seguro de que deseas eliminar el equipo
                                                        <strong>{{ $equipo->marca }} {{ $equipo->modelo }}</strong>?
                                                    </p>

                                                </div>

                                                <div class="modal-footer border-top-0 pt-0">
                                                    <button type="button"
                                                        class="btn btn-light fw-bold rounded-pill px-4"
                                                        data-bs-dismiss="modal">Cancelar</button>

                                                    <form action="/equipos/{{ $equipo->id }}" method="POST"
                                                        class="m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger fw-bold rounded-pill px-4">
                                                            Sí, eliminar
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                    No hay equipos registrados todavía.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Paginación: links() funcion que genera los enlaces de paginación.
                pagination::bootstrap-5 es el tipo de paginación que usamos. -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $equipos->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
