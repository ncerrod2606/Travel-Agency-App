@extends('app.bootstrap.template')

@section('modalcontent')
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="orderModalLabel">Ordenar vacaciones por ...</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="list-group list-group-flush">
            <a href="{{ route('main', array_merge(['field' => 1, 'order' => 2], request()->except('field', 'order', 'page'))) }}" 
               class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3">
                <i class="fas fa-calendar-alt text-primary fa-lg" style="width: 25px;"></i>
                <div>
                    <h6 class="mb-0 fw-bold">Las más recientes</h6>
                    <small class="text-muted">Orden cronológico inverso</small>
                </div>
            </a>
            
            <a href="{{ route('main', array_merge(['field' => 1, 'order' => 1], request()->except('field', 'order', 'page'))) }}" 
               class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3">
                <i class="fas fa-history text-secondary fa-lg" style="width: 25px;"></i>
                <div>
                    <h6 class="mb-0">Las más antiguas</h6>
                    <small class="text-muted">Orden cronológico</small>
                </div>
            </a>

            <a href="{{ route('main', array_merge(['field' => 2, 'order' => 1], request()->except('field', 'order', 'page'))) }}" 
               class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3">
                <i class="fas fa-tag text-success fa-lg" style="width: 25px;"></i>
                <div>
                    <h6 class="mb-0">Las más baratas</h6>
                    <small class="text-muted">Precio ascendente</small>
                </div>
            </a>

            <a href="{{ route('main', array_merge(['field' => 2, 'order' => 2], request()->except('field', 'order', 'page'))) }}" 
               class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3">
                <i class="fas fa-dollar-sign text-danger fa-lg" style="width: 25px;"></i>
                <div>
                    <h6 class="mb-0">Las más caras</h6>
                    <small class="text-muted">Precio descendente</small>
                </div>
            </a>

            <a href="{{ route('main', array_merge(['field' => 3, 'order' => 1], request()->except('field', 'order', 'page'))) }}" 
               class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3">
                <i class="fas fa-sort-alpha-down text-info fa-lg" style="width: 25px;"></i>
                <div>
                    <h6 class="mb-0">Tipo (A-Z)</h6>
                    <small class="text-muted">Alfabéticamente por tipo</small>
                </div>
            </a>

            <a href="{{ route('main', array_merge(['field' => 3, 'order' => 2], request()->except('field', 'order', 'page'))) }}" 
               class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3">
                <i class="fas fa-sort-alpha-up text-info fa-lg" style="width: 25px;"></i>
                <div>
                    <h6 class="mb-0">Tipo (Z-A)</h6>
                    <small class="text-muted">Alfabéticamente inverso</small>
                </div>
            </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="filterModalLabel">Filtrar vacaciones por ...</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="filterForm" action="{{ route('main') }}" method="get">
            <input type="hidden" name="field" value="{{ request('field') }}">
            <input type="hidden" name="order" value="{{ request('order') }}">
            <select name="pais" id="pais" class="form-control mb-2">
                <option value="" @if($pais == null) selected @endif>Selecciona un país...</option>
                @foreach($paises as $country)
                    <option value="{{ $country }}" @if($country == $pais) selected @endif>{{ $country }}</option>
                @endforeach
            </select>
            <input type="number" class="form-control mb-2" name="desde" value="{{ $desde }}" placeholder="Desde precio" min="0" step="1">
            <input type="number" class="form-control mb-2" name="hasta" value="{{ $hasta }}" placeholder="Hasta precio" min="0" step="1">
            <input type="submit" class="btn btn-primary form-control" value="Filtrar">
            </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
@section('content')

<!-- Wayfarer Hero -->
<div class="hero-wrapper container">
    <div class="row align-items-center mb-4">
        <div class="col-lg-6 hero-text-block">
            <h1 class="hero-title">Your Next <br> Adventure Awaits</h1>
            <p class="hero-subtitle">
                Explore stunning destinations, unique experiences, and unforgettable journeys with Travel Agency App.
            </p>
        </div>
        <div class="col-lg-6 text-end">
            <!-- Optional: Could put button here, or nothing -->
        </div>
    </div>

    <!-- Rounded Hero Image -->
    <div class="hero-image-container">
        <!-- Using the same hero banner image from previous step -->
        <img src="{{ asset('assets/img/hero_wayfarer.png') }}" alt="Adventure">
    </div>

    <!-- Floating Search/Filter Bar -->
    <div class="search-bar-floating">
        <div class="d-flex align-items-center flex-grow-1 gap-3">
             <div class="d-flex flex-column">
                 <small class="text-muted fw-bold" style="font-size: 0.7rem; text-transform: uppercase;">Location</small>
                 <span class="fw-bold fs-6">Anywhere</span> <!-- Placeholder for visual -->
             </div>
             <div class="vr mx-2"></div>
             <div class="d-flex flex-column">
                 <small class="text-muted fw-bold" style="font-size: 0.7rem; text-transform: uppercase;">Date</small>
                 <span class="fw-bold fs-6">Add dates</span>
             </div>
        </div>
        
        <div class="d-flex gap-2">
            <button class="btn btn-secondary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter me-2"></i> Filter
            </button>
            <button class="btn btn-secondary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#orderModal">
                <i class="fas fa-sort me-2"></i> Sort
            </button>
            <button class="btn btn-primary rounded-circle p-3" style="width:50px; height:50px; padding:0 !important; display:grid; place-items:center;" onclick="document.getElementById('filterForm').submit()">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</div>

<!-- Packages List -->
<div class="container py-5 mt-5" id="vacation-list">
    <div class="row mb-5">
        <div class="col-12">
             <small class="text-muted text-uppercase fw-bold ls-1">The Best for You</small>
             <h2 class="mt-2">Explore Our Exclusive <br> Tour Packages</h2>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($vacaciones as $vacacion)
            <div class="col">
                 <a href="{{ route('vacacion.show', $vacacion->id) }}" class="text-decoration-none text-dark">
                    <div class="card-vacation">
                        <div class="card-img-wrapper">
                            @php
                                $bgImage = $vacacion->getPath();
                            @endphp
                            <img src="{{ $bgImage }}" alt="{{ $vacacion->titulo }}">
                            <!-- Floating Tag inside image -->
                            <span class="badge bg-light text-dark position-absolute top-0 start-0 m-3 rounded-pill px-3 py-2 shadow-sm" style="font-weight:600;">
                                <i class="fas fa-map-marker-alt text-primary me-1"></i> {{ $vacacion->pais }}
                            </span>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">{{ $vacacion->titulo }}</h3>
                            <span class="location-badge">{{ Str::limit($vacacion->descripcion, 50) }}</span>
                            
                            <div class="mt-auto d-flex justify-content-between align-items-center border-top pt-3">
                                <div class="d-flex flex-column">
                                    <small class="text-muted" style="font-size:0.8rem;">Starting from</small>
                                    <span class="card-price">{{ $vacacion->precio }} €</span>
                                </div>
                                <button class="btn btn-primary px-4 py-2" style="font-size:0.85rem;">Booking</button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

@if($hasPagination)
    <div class="container mb-5">
        {{ $vacaciones->onEachSide(2)->links() }}
    </div>
@endif

@endsection