@extends('app.bootstrap.template')

@section('content')
<!-- ventanas modales principio -->

<div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="destroyModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="destroyModalLabel">Confirm delete hairstyle</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="destroyModalContent"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button form="form-delete" type="submit" class="btn btn-primary">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- ventanas modales fin -->

<hr>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-borderless align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-muted text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">#</th>
                        <th class="py-3 text-muted text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Titulo</th>
                        <th class="py-3 text-muted text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Precio</th>
                        <th class="py-3 text-muted text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Pais</th>
                        <th class="pe-4 py-3 text-end text-muted text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vacaciones as $vacacion)
                        <tr class="border-bottom">
                            <td class="ps-4 fw-bold text-muted">{{ $vacacion->id }}</td>
                            <td class="fw-bold text-dark">{{ $vacacion->titulo }}</td>
                            <td><span class="badge bg-light text-dark border font-monospace">{{ $vacacion->precio }} €</span></td>
                            <td class="text-muted"><i class="fas fa-map-marker-alt me-1 text-primary"></i> {{ $vacacion->pais }}</td>
                            <td class="pe-4 text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('vacacion.show', $vacacion->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3" style="font-size: 0.75rem;">
                                        Show
                                    </a>
                                    <a href="{{ route('vacacion.edit', $vacacion->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 text-dark" style="font-size: 0.75rem;">
                                        Edit
                                    </a>
                                    <!-- Using the modal trigger button styled cleanly -->
                                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3" 
                                            data-bs-target="#destroyModal"
                                            data-bs-toggle="modal"
                                            data-href="{{ route('vacacion.destroy', $vacacion->id) }}"
                                            data-vacacion="{{ $vacacion->titulo }}"
                                            style="font-size: 0.75rem;">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-light">
                    <tr>
                        <th colspan="4" class="ps-4 py-3 text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Total Vacaciones:</th>
                        <th class="pe-4 py-3 text-end fw-bold">{{ count($vacaciones) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 d-flex justify-content-center">
        {{ $vacaciones->onEachSide(2)->links() }}
    </div>
</div>

<form action="" method="post" id="form-delete">
    @csrf
    @method('delete')
</form>
@endsection