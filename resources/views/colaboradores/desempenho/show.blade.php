@extends('layout')
@section('title', 'Avaliações')
@section('h1', 'Avaliações')
@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h5>Colaboradores ({{ $desempenhos->count() }})</h5>
        </div>
        @include('message')
        @if ($desempenhos->isNotEmpty())
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
                                <th>Nota</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($desempenhos as $desempenho)
                                <tr>
                                    <td>{{ $desempenho->colaboradores->nome }}</td>
                                    <td>{{ $desempenho->colaboradores->cpf }}</td>
                                    <td>{{ $desempenho->colaboradores->email }}</td>
                                    <td>{{ $desempenho->colaboradores->unidade->nome_fantasia }}</td>
                                    <td>{{ $desempenho->cargos->cargo }}</td>
                                    <td>{{ $desempenho->nota_desempenho }}</td>
                                    <td>
                                        <a href="{{ route('colaborador.desempenho.edit', [$desempenho->colaboradores->id, $desempenho->id]) }}"
                                            class="btn btn-primary btn-sm" title="Editar"><i class="bi bi-pencil-fill"></i></a>
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
