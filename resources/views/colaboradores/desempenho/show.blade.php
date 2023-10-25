@extends('layout')
@section('title', 'Avaliações')
@section('h1', 'Avaliações')
@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h5>Avaliações ({{ $desempenhos->count() }})</h5>
        </div>
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
                                    <td>{{ mb_strimwidth( $desempenho->colaboradores->email, 0,25, "...")}}</td>
                                    <td>{{ mb_strimwidth( $desempenho->colaboradores->unidade->nome_fantasia, 0,25, "...")}}</td>
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
