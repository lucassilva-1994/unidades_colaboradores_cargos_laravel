@extends('layout')
@section('title', 'Avaliações')
@section('h1', 'Avaliações')
@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h5>Avaliações ({{ $desempenhos->count() }})</h5>
        </div>
        <div class="table-responsive">
            <form action="{{ route('colaborador.desempenho.show') }}" method="post" class="card-body">
                <div class="input-group">
                    @csrf
                    <input type="search" class="form-control" name="search" value="{{ $_POST ? $_POST['search'] : '' }}" placeholder="Digite sua busca" />
                    <button class="btn btn-success" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        @if ($desempenhos->isNotEmpty())
            <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th>Unidade</th>
                                <th>Cargo</th>
                                <th>Nota</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($desempenhos as $desempenho)
                                <tr class="text-nowrap">
                                    <td>{{ $desempenho->colaborador->nome }}</td>
                                    <td>{{ $desempenho->colaborador->cpf }}</td>
                                    <td>{{ $desempenho->colaborador->email}}</td>
                                    <td>{{ $desempenho->colaborador->unidade->nome_fantasia}}</td>
                                    <td>{{ $desempenho->colaborador->cargo->cargo }}</td>
                                    <td>{{ $desempenho->nota_desempenho }}</td>
                                    <td>
                                        <a href="{{ route('colaborador.desempenho.edit', [$desempenho->colaborador->id, $desempenho->id]) }}"
                                            class="btn btn-primary btn-sm" title="Editar"><i class="bi bi-pencil-fill"></i></a>
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
                        {{ $desempenhos->appends(request()->except('_token'))->links() }}
                    </li>
                </ul>
            </nav>
        @else
            <div class="card-body">
                <div>
                    <h4>Nenhuma avaliação cadastrada.</h4>
                </div>
            </div>
        @endif
    </div>
@endsection
