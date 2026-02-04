@extends('app.bootstrap.template')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0" style="color: var(--primary);">Create Package</h2>
            <a href="{{ route('vacacion.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i> Back
            </a>
        </div>
        
        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
            <div class="card-body p-5">
                <form action="{{ route('vacacion.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-8">
                            <label for="titulo" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Título del paquete</label>
                            <input class="form-control form-control-lg bg-light border-0" minlength="2" maxlength="100" required id="titulo" name="titulo" placeholder="Ej: Tour por el Mediterráneo" value="{{ old('titulo') }}" type="text">
                            @error('titulo')
                                <small class="text-danger fw-bold mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="precio" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Precio (€)</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light fw-bold text-muted">€</span>
                                <input class="form-control form-control-lg bg-light border-0" step="0.01" min="0" max="999999.99" required id="precio" name="precio" placeholder="0.00" value="{{ old('precio') }}" type="number">
                            </div>
                            @error('precio')
                                <small class="text-danger fw-bold mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="pais" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">País de Destino</label>
                            <input class="form-control form-control-lg bg-light border-0" minlength="2" maxlength="100" required id="pais" name="pais" placeholder="Ej: Italia" value="{{ old('pais') }}" type="text">
                            @error('pais')
                                <small class="text-danger fw-bold mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="idtipo" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Tipo de Vacación</label>
                            <select name="idtipo" id="idtipo" required class="form-select form-select-lg bg-light border-0">
                                <option value="" @if(old('idtipo') == null) selected  @endif disabled>Selecciona el tipo...</option>
                                @foreach($tipos as $id => $nombre)
                                    <option value="{{ $id }}" @if(old('idtipo') == $id) selected @endif>{{ $nombre }}</option>
                                @endforeach
                            </select>
                            @error('idtipo')
                                <small class="text-danger fw-bold mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Descripción Detallada</label>
                        <textarea class="form-control bg-light border-0 p-3" minlength="10" required id="descripcion" name="descripcion" placeholder="Describe la experiencia completa..." cols="60" rows="6" style="border-radius: 15px;">{{ old('descripcion') }}</textarea>
                         <div class="form-text text-end mt-2"><small>Mínimo 10 caracteres</small></div>
                        @error('descripcion')
                            <small class="text-danger fw-bold mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-5">
                         <label for="image" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Foto Principal</label>
                         <div class="p-4 bg-light text-center" style="border-radius: 15px; border: 2px dashed #ddd;">
                            <input class="form-control mb-2" id="image" name="image" type="file" accept="image/*">
                            <small class="text-muted">Sube una imagen de alta calidad para la portada del paquete.</small>
                         </div>
                        @error('image')
                            <small class="text-danger fw-bold mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <input class="btn btn-primary btn-lg rounded-pill py-3 fw-bold" value="Crear Paquete" type="submit" style="letter-spacing: 1px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection