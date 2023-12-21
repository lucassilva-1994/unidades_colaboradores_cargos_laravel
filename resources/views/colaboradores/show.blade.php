@extends('layout')
@section('title', 'Colaboradores')
@section('h1', 'Colaboradores')
@section('content')
    <div class="d-flex justify-content-end">
        <div class="col-md-2 d-grid">
            <a class="btn btn-secondary m-1" href="{{ route('colaborador.new') }}"><i class="bi bi-file-earmark-plus-fill"></i>
                Novo</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Colaboradores ({{ $colaboradores->count() }})</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('colaborador.show') }}" method="post">
                <div class="input-group">
                    @csrf
                    <input type="search" class="form-control" name="search" value="{{ $_POST ? $_POST['search'] : '' }}"
                        placeholder="Digite sua busca" />
                    <button class="btn btn-success" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
        @if ($colaboradores->isNotEmpty())
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                <tr  class="text-nowrap">
                                    <td>{{ $colaborador->nome }}</td>
                                    <td>{{ $colaborador->cpf }}</td>
                                    <td>{{ $colaborador->email }}</td>
                                    <td>{{ $colaborador->unidade->nome_fantasia}}</td>
                                    <td>{{ str($colaborador->cargo->cargo)->words(4) }}</td>
                                    <td class="list-inline" style="width: 15%">
                                        <span class="list-inline-item mb-2">
                                            <a href="{{ route('colaborador.edit', $colaborador->id) }}"
                                                class="btn btn-primary btn-sm" title="Editar"><i
                                                    class="bi bi-pencil-fill"></i></a>
                                        </span>
                                        <span class="list-inline-item mb-2">
                                            <form action="{{ route('colaborador.delete', $colaborador->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </span>
                                        <span class="list-item-item mb-2">
                                            <a href="{{ !$colaborador->desempenho ? route('colaborador.desempenho.new', $colaborador->id) : route('colaborador.desempenho.edit', [$colaborador->id, $colaborador->desempenho->id]) }}"
                                                class="btn {{ $colaborador->desempenho ? 'btn-info' : 'btn-secondary' }} btn-sm"
                                                title="Avaliar"><i class="bi bi-chat-square-dots-fill"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <nav class="mt-3">
                <ul class="pagination justify-content-center">
                    <li>
                        {{ $colaboradores->appends(request()->except('_token'))->links() }}
                    </li>
                </ul>
            </nav>
        @else
            <div class="card-body">
                <div>
                    <h4>Nenhum colaborador cadastrado.</h4>
                </div>
            </div>
        @endif
    </div>
@endsection
