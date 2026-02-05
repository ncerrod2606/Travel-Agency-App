@extends('app.bootstrap.template')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold" style="color: var(--primary);">Reservas por Usuario</h2>
            <p class="text-muted">Vista de administrador: Usuarios con reservas activas.</p>
        </div>
    </div>

    @if($users->isEmpty())
        <div class="alert alert-info shadow-sm" role="alert">
            <i class="fas fa-info-circle me-2"></i> No hay usuarios con reservas actualmente.
        </div>
    @else
        <div class="accordion shadow-lg" id="accordionReservas" style="border-radius: 15px; overflow: hidden;">
            @foreach($users as $user)
                <div class="accordion-item border-0 mb-1">
                    <h2 class="accordion-header" id="heading{{ $user->id }}">
                        <button class="accordion-button collapsed fw-bold py-4 {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $user->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $user->id }}" style="background-color: #f8f9fa;">
                            <div class="d-flex align-items-center w-100">
                                <div class="me-3">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span style="font-size: 1.1rem;">{{ $user->name }}</span>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                                <div class="ms-auto me-4">
                                    <span class="badge bg-secondary rounded-pill px-3">{{ $user->reservas->count() }} Reservas</span>
                                </div>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse{{ $user->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $user->id }}" data-bs-parent="#accordionReservas">
                        <div class="accordion-body bg-white p-4">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col" class="border-0 rounded-start">ID</th>
                                            <th scope="col" class="border-0">Destino</th>
                                            <th scope="col" class="border-0">Precio</th>
                                            <th scope="col" class="border-0 rounded-end">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->reservas as $reserva)
                                            <tr>
                                                <td class="fw-bold text-muted">#{{ $reserva->id }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($reserva->vacacion->fotos->count() > 0)
                                                            <img src="{{ $reserva->vacacion->getPath() }}" class="rounded me-3" width="50" height="50" style="object-fit: cover;">
                                                        @else
                                                            <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center text-muted" style="width: 50px; height: 50px;">
                                                                <i class="fas fa-image"></i>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <span class="d-block fw-bold">{{ $reserva->vacacion->titulo }}</span>
                                                            <small class="text-muted">{{ $reserva->vacacion->pais }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-success">{{ number_format($reserva->vacacion->precio, 2) }} €</td>
                                                <td>
                                                    <a href="{{ route('vacacion.show', $reserva->vacacion->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                        Ver Paquete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
