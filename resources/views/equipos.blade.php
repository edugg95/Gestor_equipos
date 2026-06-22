<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor IT | Equipos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/equipos">
                <i class="bi bi-pc-display-horizontal me-2"></i>Gestor Equipos IT
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-secondary fw-bold m-0">Inventario de Equipos</h2>
            <a href="/equipos/crear" class="btn btn-primary shadow-sm fw-bold rounded-pill px-4">
                <i class="bi bi-plus-lg me-2"></i>Añadir Equipo
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
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
                        @forelse($misEquipos as $equipo)
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
                                                class="bi bi-tools me-1"></i>En Reparación</span>
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
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
