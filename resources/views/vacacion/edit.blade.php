@extends('app.bootstrap.template')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0" style="color: var(--primary);">Edit Package</h2>
            <a href="{{ route('vacacion.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i> Back
            </a>
        </div>
        
        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
            <div class="card-body p-5">
                <form action="{{ route('vacacion.update', $vacacion->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-8">
                            <label for="titulo" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Título del paquete</label>
                            <input class="form-control form-control-lg bg-light border-0" minlength="2" maxlength="100" required id="titulo" name="titulo" value="{{ old('titulo', $vacacion->titulo) }}" type="text">
                            @error('titulo')
                                <small class="text-danger fw-bold mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="precio" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Precio (€)</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light fw-bold text-muted">€</span>
                                <input class="form-control form-control-lg bg-light border-0" step="0.01" min="0" required id="precio" name="precio" value="{{ old('precio', $vacacion->precio) }}" type="number">
                            </div>
                            @error('precio')
                                <small class="text-danger fw-bold mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="pais" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">País de Destino</label>
                            <input class="form-control form-control-lg bg-light border-0" minlength="2" maxlength="100" required id="pais" name="pais" value="{{ old('pais', $vacacion->pais) }}" type="text">
                            @error('pais')
                                <small class="text-danger fw-bold mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="idtipo" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Tipo de Vacación</label>
                            <select name="idtipo" id="idtipo" required class="form-select form-select-lg bg-light border-0">
                                @foreach($tipos as $id => $nombre)
                                    <option value="{{ $id }}" @if(old('idtipo', $vacacion->idtipo) == $id) selected @endif>{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Descripción Detallada</label>
                        <textarea class="form-control bg-light border-0 p-3" minlength="10" required id="descripcion" name="descripcion" cols="60" rows="6" style="border-radius: 15px;">{{ old('descripcion', $vacacion->descripcion) }}</textarea>
                        @error('descripcion')
                            <small class="text-danger fw-bold mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-5">
                         <label class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Gestión de Fotos</label>
                         <div class="p-4 bg-light" style="border-radius: 15px; border: 2px dashed #ddd;">
                            <label for="image" class="form-label fw-bold mb-2">Añadir Foto Nueva (conserva anteriores)</label>
                            <input class="form-control mb-3" id="image" name="image" type="file" accept="image/*">
                            
                            <div class="form-check form-switch mt-3">
                                <input class="form-check-input" type="checkbox" name="deleteImage" value="true" id="deleteImage">
                                <label class="form-check-label text-danger fw-bold" for="deleteImage">Borrar todas las fotos actuales</label>
                            </div>
                         </div>
                    </div>

                    <div class="d-grid">
                        <input class="btn btn-primary btn-lg rounded-pill py-3 fw-bold" value="Guardar Cambios" type="submit" style="letter-spacing: 1px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection