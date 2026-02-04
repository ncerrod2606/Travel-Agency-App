@extends('app.bootstrap.template')

@section('content')

<!-- begin modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteModalLabel">Confirm delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Seguro que quieres borrar al usuario <span id="modal-news-title">XXX</span>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button form="form-delete" type="submit" class="btn btn-primary">Delete user</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-borderless align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-muted text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">#</th>
                        <th class="py-3 text-muted text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Name</th>
                        <th class="py-3 text-muted text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Email</th>
                        <th class="py-3 text-muted text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Rol</th>
                        <th class="py-3 text-muted text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Verificado</th>
                        <th class="pe-4 py-3 text-end text-muted text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-bottom">
                        <td class="ps-4 fw-bold text-muted">{{ $user->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold" style="width: 35px; height: 35px; font-size: 0.8rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="fw-bold text-dark">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="text-secondary">{{ $user->email }}</td>
                        <td>
                            <span class="badge rounded-pill {{ $user->rol == 'admin' ? 'bg-dark' : 'bg-light text-dark border' }} px-3 py-2">
                                {{ ucfirst($user->rol) }}
                            </span>
                        </td>
                        <td>
                            @if($user->hasVerifiedEmail()) 
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3"><i class="fas fa-check me-1"></i> Verified</span>
                            @else 
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3"><i class="fas fa-times me-1"></i> Not Verified</span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                             <div class="d-inline-flex gap-2">
                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3" style="font-size: 0.75rem;">View</a>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 text-dark" style="font-size: 0.75rem;">Edit</a>
                                <button data-title="{{$user->name}}" data-href="{{ route('user.destroy', $user->id) }}" class="btn btn-sm btn-outline-danger rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#deleteModal" style="font-size: 0.75rem;">Delete</button>
                             </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-light">
                    <tr>
                        <th colspan="5" class="ps-4 py-3 text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Total Users:</th>
                        <th class="pe-4 py-3 text-end fw-bold">{{ count($users) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<form id="form-delete" action="" method="post">
    @csrf
    @method('delete')
</form>

<hr>
@endsection

@section('scritps')
<script>
    const deleteModal = document.getElementById('deleteModal')
    if(deleteModal) {
        const modalTitle = document.getElementById('modal-news-title')
        const form = document.getElementById('form-delete')
        
        deleteModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget
            const name = button.getAttribute('data-title')
            const href = button.getAttribute('data-href')
            
            modalTitle.textContent = name
            form.action = href
        })
    }
</script>
@endsection