@extends('layout')
@section('title', 'Avaliação')
@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h5>{{ $desempenho ? 'Editar avaliação' : 'Avaliar' }}</h5>
        </div>
        <div class="card-body">
            <form method="post"
                action="{{ !$desempenho ? route('colaborador.desempenho.create', $colaborador->id) : route('colaborador.desempenho.update',$colaborador->id) }}"
                class="row">
                @csrf
                @if ($desempenho)
                    @method('put')
                    <input type="hidden" name="id" value="{{ $desempenho->id }}"/>
                @endif
                <input type="hidden" name="cargo_id" value="{{ $colaborador->cargo->id }}"/>
                <input type="hidden" name="colaborador_id" value="{{ $colaborador->id }}"/>
                <div class="mb-3 col-md-6">
                    <label class="form-label">Nome:</label>
                    <input type="text" class="form-control"
                        value="{{$colaborador->nome}}" readonly disabled/>
                </div>
                <div class="mb-3 col-md-3">
                    <label class="form-label">Cargo:</label>
                    <input type="text" class="form-control"
                      value="{{$colaborador->cargo->cargo}}" readonly disabled/>
                </div>
                <div class="mb-3 col-md-1">
                    <label for="nota_desempenho" class="form-label">Nota:</label>
                    <input type="text" class="form-control" id="nota_desempenho" 
                        placeholder="Nota" name="nota_desempenho"
                        value="{{ $desempenho ? $desempenho->nota_desempenho : old('nota_desempenho')}}"/>
                </div>
                <div class="d-grid mb-3 col-md-2"><br/>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    @endsection
