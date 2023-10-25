@extends('layout')
@section('title', 'Todas as unidades')
@section('content')
    <div class="d-flex justify-content-start">
    @section('h1', 'Todas as unidades')
</div>
<div class="d-flex justify-content-end">
    <div class="col-md-2 d-grid">
        <a class="btn btn-secondary m-1" href="{{ route('unidade.new') }}"><i class="bi bi-file-earmark-plus-fill"></i>
            Novo</a>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5>Listagem de unidades ({{ $unidades->count() }})</h5>
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
                            <th>Colaboradores</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unidades as $unidade)
                            <tr>
                                <td>{{ $unidade->id }}</td>
                                <td>{{ mb_strimwidth( $unidade->nome_fantasia, 0,30, "...")}}</td>
                                <td>{{ mb_strimwidth( $unidade->razao_social, 0,30, "...")}}</td>
                                <td>{{ $unidade->cnpj }}</td>
                                <td>{{ $unidade->colaboradores->count() }}</td>
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
            <nav class="mt-3">
                <ul class="pagination justify-content-center">
                    <li>
                        {{ $unidades->appends(request()->except('_token'))->links() }}
                    </li>
                </ul>
            </nav>
        </div>
    @else
        <div class="card-body">
            <div>
                <h4>Nenhuma unidade cadastrada.</h4>
            </div>
        </div>
    @endif
</div>
@endsection
