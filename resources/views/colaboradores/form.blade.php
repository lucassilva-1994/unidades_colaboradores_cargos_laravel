@extends('layout')
@section('title', "Colaboradores")
@section('h1', 'Colaboradores')
@section('content')
    @if ($colaborador)
        <div class="d-flex justify-content-end">
            <div class="col-md-2 d-grid">
                <a class="btn btn-secondary m-1" href="{{ route('colaborador.new') }}"><i class="bi bi-file-earmark-plus-fill"></i>
                    Novo</a>
            </div>
        </div>
    @endif
    <div class="card mb-3">
        <div class="card-header">
            <h5>{{ $colaborador ? 'Editar' : 'Novo colaborador' }}</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ $colaborador ? route('colaborador.update', $colaborador->id) : route('colaborador.create') }}" class="row">
                @csrf
                @if($colaborador)
                    <input type="hidden" name="id" value="{{ $colaborador->id }}"/>
                    @method('put')
                @endif
                <div class="mb-3 col-md-6">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome"
                    value="{{ $colaborador ? $colaborador->nome : old('nome') }}"  autocomplete="off"/>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="cpf" class="form-label">CPF:</label>
                    <input type="text" class="form-control" id="cpf" placeholder="CPF" name="cpf"
                    value="{{ $colaborador ? $colaborador->cpf : old('cpf') }}"  autocomplete="off"
                        onkeypress="$(this).mask('000.000.000-00')"/>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                    value="{{ $colaborador ? $colaborador->email : old('email') }}"  autocomplete="off"/>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="cargo_id" class="form-label">Cargo:</label>
                    <select name="cargo_id" class="form-control" id="cargo_id">
                        @foreach ($cargos as $cargo)
                        <option value="{{ $cargo->id }}"
                            {{ $colaborador && $colaborador->cargo_id == $cargo->id ? 'selected' : '' }}>
                            {{ $cargo->cargo }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="unidade_id" class="form-label">Unidade:</label>
                    <select name="unidade_id" class="form-control" id="unidade_id">
                        @foreach ($unidades as $unidade)
                        <option value="{{ $unidade->id }}"
                            {{ $colaborador && $colaborador->unidade_id == $unidade->id ? 'selected' : '' }}>
                            {{ $unidade->nome_fantasia }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="d-grid col-md-6">
                    <button type="submit" class="btn btn-success">{{ $colaborador ? 'Atualizar' : 'Cadastrar' }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h5>Últimos colaboradores</h5>
        </div>
        @if ($colaboradores->isNotEmpty())
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th>Unidade</th>
                                <th>Cargo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colaboradores as $colaborador)
                                <tr>
                                    <td>{{ $colaborador->nome }}</td>
                                    <td>{{ $colaborador->cpf }}</td>
                                    <td>{{ $colaborador->email }}</td>
                                    <td>{{ $colaborador->unidade->nome_fantasia }}</td>
                                    <td>{{ $colaborador->cargo->cargo }}</td>
                                    <td class="list-inline" style="width: 10%">
                                        <span class="list-inline-item mb-2">
                                            <a href="{{ route('colaborador.edit', $colaborador->id) }}"
                                                class="btn btn-primary btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                        </span>
                                        <span class="list-inline-item">
                                            <form action="{{ route('colaborador.delete', $colaborador->id) }}" method="post">
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
