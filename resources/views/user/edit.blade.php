@extends('app.bootstrap.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold m-0" style="color: var(--primary);">Edit User</h2>
                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i> Back
                </a>
            </div>

            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        @method('put')
                        
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Full Name</label>
                                <input id="name" type="text" class="form-control form-control-lg bg-light border-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Email Address</label>
                                <input id="email" type="email" class="form-control form-control-lg bg-light border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="password" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Password (Leave empty to keep)</label>
                                <input id="password" type="password" class="form-control form-control-lg bg-light border-0 @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="rol" class="form-label text-muted fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Role</label>
                                <select required name="rol" id="rol" class="form-select form-select-lg bg-light border-0">
                                    <option value="" @if(old('rol', $user->rol) == null) selected @endif disabled>Select Role...</option>
                                    @foreach($rols as $rol)
                                        <option value="{{ $rol }}" @if($rol == old('rol', $user->rol)) selected @endif>{{ ucfirst($rol) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch p-3 bg-light rounded-4">
                                <input class="form-check-input ms-0 me-3" type="checkbox" role="switch" id="verified" name="verified" value="verified" @if($user->hasVerifiedEmail()) checked @endif style="width: 3em; height: 1.5em;">
                                <label class="form-check-label fw-bold pt-1" for="verified">Email Verified</label>
                            </div>
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3 fw-bold shadow-sm" style="letter-spacing: 1px;">
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection