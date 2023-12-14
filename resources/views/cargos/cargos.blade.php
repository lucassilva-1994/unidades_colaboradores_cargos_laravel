@extends('layout')
@section('title', 'Cargos')
@section('h1', 'Cargos')
@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h5>{{ $cargo ? 'Editar cargo' : 'Novo cargo' }}</h5>
        </div>
        <div class="card-body">
            <form class="row" method="post"
                action="{{ $cargo ? route('cargo.update') : route('cargo.create') }}">
                @csrf
                @if ($cargo)
                    <input type="hidden" name="id" value="{{ $cargo->id }}" />
                    @method('put')
                @endif
                <div class="col-md-8">
                    <label for="cargo">Cargo</label>
                    <input type="text" class="form-control" id="cargo" name="cargo" autocomplete="off"
                        value="{{ $cargo ? $cargo->cargo : old('cargo') }}" autofocus />
                </div>
                <div class="d-grid col-md-4"><br/>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-send-fill"></i> {{ $cargo ? 'Atualizar' : 'Enviar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h5>Todos os cargos</h5>
        </div>
        @if ($cargos->isNotEmpty())
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Cargo</th>
                                <th>N° colaboradores</th>
                                <th>Criado em</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cargos as $cargo)
                                <tr  class="text-nowrap">
                                    <td>{{ $cargo->cargo}}</td>
                                    <td>{{ $cargo->colaboradores->count() }}</td>
                                    <td>{{ $cargo->created_at }}</td>
                                    <td class="list-inline">
                                        <span class="list-inline-item  mb-2">
                                            <a href="{{ route('cargo.edit', $cargo->id) }}"
                                                class="btn btn-primary btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                        </span>
                                        <span class="list-inline-item">
                                            <form action="{{ route('cargo.delete', $cargo->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="bi bi-trash-fill"></i></button>
                                            </form>
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
                        {{ $cargos->appends(request()->except('_token'))->links() }}
                    </li>
                </ul>
            </nav>
            <div class="card-footer">
                <div class="d-flex  justify-content-lg-end">
                    <strong>{{ $cargos->count() }} registros encontrados.</strong>
                </div>
            </div>
        @else
            <div class="card-body">
                <div>
                    <h4>Nenhum cargo encontrado.</h4>
                </div>
            </div>
        @endif
    </div>
@endsection
