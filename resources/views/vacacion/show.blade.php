@extends('app.bootstrap.template')

@section('content')

<!-- Hero Section -->
<div class="position-relative w-100 mb-5" style="height: 50vh; min-height: 400px; border-radius: 30px; overflow: hidden; margin-top: -20px;">
    @php
        $bgImage = $vacacion->fotos->count() > 0 ? asset($vacacion->fotos->first()->ruta) : asset('assets/img/placeholder.jpg');
    @endphp
    <div style="background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center; height: 100%; width: 100%;">
        <div style="background: rgba(0,0,0,0.4); height: 100%; width: 100%; display: flex; align-items: flex-end; padding: 3rem;">
            <div class="container">
                <span class="badge bg-warning text-dark mb-2 px-3 py-2 text-uppercase fw-bold ls-1">{{ $vacacion->tipo->nombre }}</span>
                <h1 class="text-white display-4 fw-bold mb-0" style="text-shadow: 0 2px 10px rgba(0,0,0,0.3);">{{ $vacacion->titulo }}</h1>
                <p class="text-white-50 fs-4 mb-0"><i class="fas fa-map-marker-alt me-2 text-warning"></i> {{ $vacacion->pais }}</p>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-5">
        <!-- Left Content -->
        <div class="col-lg-8">
            <div class="mb-5">
                <h3 class="fw-bold mb-4" style="color: var(--primary);">About this trip</h3>
                <p class="lead text-muted" style="line-height: 1.8;">
                    {{ $vacacion->descripcion }}
                </p>
            </div>

            <!-- Gallery -->
            @if($vacacion->fotos->count() > 1)
                <div class="mb-5">
                    <h4 class="fw-bold mb-3">Gallery</h4>
                    <div class="row g-3">
                        @foreach($vacacion->fotos->skip(1) as $foto)
                            <div class="col-md-6 mb-2">
                                <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm">
                                    <img src="{{ asset($foto->ruta) }}" class="img-fluid object-fit-cover" alt="Gallery">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Comments Section -->
            <hr class="my-5 opacity-25">
            <h4 class="fw-bold mb-4">Reviews & Comments</h4>
            
            <div class="d-flex flex-column gap-4 mb-5">
                @forelse($vacacion->comentarios as $comentario)
                    <div class="card border-0 shadow-sm rounded-4 bg-light">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;">
                                        <i class="fas fa-user text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">{{ $comentario->user->name }}</h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">{{ $comentario->created_at->format('F d, Y') }}</small>
                                    </div>
                                </div>
                                @auth
                                    @if(Auth::id() == $comentario->iduser || Auth::user()->rol == 'admin')
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                                <li><a class="dropdown-item" href="{{ route('comentario.edit', $comentario->id) }}">Edit</a></li>
                                                <li>
                                                    <form action="{{ route('comentario.destroy', $comentario->id) }}" method="post">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                            <p class="mb-0 text-secondary">{{ $comentario->texto }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 bg-light rounded-4">
                        <p class="text-muted mb-0">No reviews yet. Be the first to share your experience!</p>
                    </div>
                @endforelse
            </div>

            @auth
                @php $hasReserved = $vacacion->reservas->contains('iduser', Auth::id()); @endphp
                @if($hasReserved)
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Leave a Review</h5>
                            <form method="post" action="{{ route('comentario.store') }}">
                                @csrf
                                <input type="hidden" name="idvacacion" value="{{ $vacacion->id }}">
                                <div class="mb-3">
                                    <textarea class="form-control bg-light border-0" required id="texto" name="texto" rows="3" placeholder="How was your experience?" style="border-radius: 15px; padding: 1rem;"></textarea>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary rounded-pill px-4" type="submit">Post Review</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            @endauth
        </div>

        <!-- Right Sidebar (Sticky Booking Card) -->
        <div class="col-lg-4">
            <div class="position-sticky" style="top: 100px;">
                <div class="card border-0 shadow-lg p-3" style="border-radius: 25px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                            <span class="text-muted fs-5">Price</span>
                            <span class="display-6 fw-bold text-dark">{{ $vacacion->precio }} €</span>
                        </div>

                        <ul class="list-unstyled mb-4 text-muted">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Best Price Guarantee</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Instant Confirmation</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Professional Guide</li>
                        </ul>

                        @auth
                            @if(Auth::user()->rol == 'admin' || Auth::user()->rol == 'advanced')
                                <div class="d-grid mb-3">
                                    <a href="{{ route('vacacion.edit', $vacacion->id) }}" class="btn btn-outline-warning rounded-pill py-3 fw-bold">Edit Package</a>
                                </div>
                            @endif

                             @php $hasReserved = $vacacion->reservas->contains('iduser', Auth::id()); @endphp
                             @if(!$hasReserved)
                                <form action="{{ route('reserva.store') }}" method="post" class="d-grid">
                                    @csrf
                                    <input type="hidden" name="idvacacion" value="{{ $vacacion->id }}">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3 fw-bold shadow-sm hover-scale">
                                        Book Now
                                    </button>
                                </form>
                            @else
                                <div class="alert alert-success rounded-4 text-center fw-bold">
                                    <i class="fas fa-check-circle me-2"></i> You booked this!
                                </div>
                            @endif
                        @else
                            <div class="alert alert-light text-center rounded-4">
                                <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Log in</a> to book this trip.
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
