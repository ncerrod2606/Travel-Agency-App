@extends('app.bootstrap.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                    <hr>
                    Name: {{ Auth::user()->name }}<br>
                    Email: {{ Auth::user()->email }}<br>
                    Password:: {{ Auth::user()->password }}<br>
                    Created at: {{ Auth::user()->created_at->format('d/m/Y h:i:s') }}<br>
                    Edited at: {{ Auth::user()->updated_at->format('d/m/Y h:i:s') }}<br>
                    <a href="{{ route('home.edit') }}" class="btn btn-outline-primary btn-sm mt-3">Edit your profile</a>
                    
                    <hr class="my-4">
                    
                    <h4 class="mb-3">My Reservations</h4>
                    @if($reservas->isEmpty())
                        <div class="alert alert-info">
                            You haven't booked any trips yet. <a href="{{ route('main') }}">Browse packages</a>
                        </div>
                    @else
                        <div class="row g-3">
                            @foreach($reservas as $reserva)
                                <div class="col-md-6">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="row g-0">
                                            <div class="col-4">
                                                <img src="{{ $reserva->vacacion->getPath() }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $reserva->vacacion->titulo }}" style="min-height: 100px;">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body py-2">
                                                    <h6 class="card-title fw-bold mb-1">{{ $reserva->vacacion->titulo }}</h6>
                                                    <p class="card-text text-muted small mb-1"><i class="fas fa-map-marker-alt me-1"></i> {{ $reserva->vacacion->pais }}</p>
                                                    <p class="card-text text-success fw-bold small mb-2">{{ number_format($reserva->vacacion->precio, 2) }} €</p>
                                                    <a href="{{ route('vacacion.show', $reserva->vacacion->id) }}" class="btn btn-sm btn-primary rounded-pill px-3" style="font-size: 0.75rem;">View Trip</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
