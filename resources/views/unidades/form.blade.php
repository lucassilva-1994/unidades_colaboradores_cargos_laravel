@extends('layout')
@section('title', "Unidades")
@section('h1', 'Unidades')
@section('content')
    @if ($unidade)
        <div class="d-flex justify-content-end">
            <div class="col-md-2 d-grid">
                <a class="btn btn-secondary m-1" href="{{ route('unidade.new') }}"><i class="bi bi-file-earmark-plus-fill"></i>
                    Novo</a>
            </div>
        </div>
    @endif
    <div class="card mb-3">
        <div class="card-header">
            <h5>{{ $unidade ? 'Editar unidade' : 'Nova unidade' }}</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ $unidade ? route('unidade.update', $unidade->id) : route('unidade.create') }}" class="row">
                @csrf
                @if($unidade)
                    <input type="hidden" name="id" value="{{ $unidade->id }}"/>
                    @method('put')
                @endif
                <div class="mb-3 col-md-12">
                    <label for="nome_fantasia" class="form-label">Nome fantasia:</label>
                    <input type="text" class="form-control" id="nome_fantasia" placeholder="Nome fantasia"
                        name="nome_fantasia" value="{{ $unidade ? $unidade->nome_fantasia : old('nome_fantasia') }}" autofocus autocomplete="off"/>
                </div>
                <div class="mb-3 col-md-12">
                    <label for="razao_social" class="form-label">Razão social:</label>
                    <input type="text" class="form-control" id="razao_social" placeholder="Razão social"
                        name="razao_social" value="{{ $unidade ? $unidade->razao_social : old('razao_social') }}"  autocomplete="off"/>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="cnpj" class="form-label">CNPJ:</label>
                    <input type="text" class="form-control" id="cnpj" placeholder="CNPJ" name="cnpj"
                    value="{{ $unidade ? $unidade->cnpj : old('cnpj') }}"  autocomplete="off"
                    onkeypress="$(this).mask('00.000.000/0000-00')"/>
                </div>
                <div class="d-grid col-md-6 mb-3"><br/>
                    <button type="submit" class="btn btn-success">{{ $unidade ? 'Atualizar' : 'Cadastrar' }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h5>Últimas unidades</h5>
        </div>
        @if ($unidades->isNotEmpty())
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome fantasia</th>
                                <th>Razão social</th>
                                <th>CNPJ</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unidades as $unidade)
                                <tr>
                                    <td>{{ $unidade->id }}</td>
                                    <td>{{ $unidade->nome_fantasia }}</td>
                                    <td>{{ $unidade->razao_social }}</td>
                                    <td>{{ $unidade->cnpj }}</td>
                                    <td class="list-inline">
                                        <span class="list-inline-item mb-2">
                                            <a href="{{ route('unidade.edit', $unidade->id) }}"
                                                class="btn btn-primary btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                        </span>
                                        <span class="list-inline-item">
                                            <form action="{{ route('unidade.delete', $unidade->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
