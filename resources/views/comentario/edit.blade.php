@extends('app.bootstrap.template')

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/estrellas.css') }}">
@endsection

@section('content')
<form method="post" action="{{ route('comentario.update', $comentario->id) }}">
    @csrf
    @method('put')
    <label for="texto">Comentario</label>
    <textarea class="form-control" minlength="20" id="texto" name="texto"
        placeholder="Comment for the vacation" cols="60" rows="3" >{{ old('texto', $comentario->texto) }}</textarea>
    <input class="btn btn-primary mt-3" value="Edit comentario" type="submit">
</form>
@endsection