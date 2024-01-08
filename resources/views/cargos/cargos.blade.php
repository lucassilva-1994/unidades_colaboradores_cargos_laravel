@extends('layout')
@section('title', 'Cargos')
@section('h1', 'Cargos')
@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h5>{{ $cargo ? 'Editar cargo' : 'Novo cargo' }}</h5>
        </div>
        <div class="card-body">
            <form class="row" method="POST" id="form" action="{{ $cargo ? route('cargo.update') : route('cargo.create') }}">
                @csrf
                @if ($cargo)
                    @method('PUT')
                @endif
                <input type="hidden" name="id" value="{{ $cargo ? $cargo->id : '' }}" />
                <div class="col-md-8">
                    <label for="cargo">Cargo</label>
                    <input type="text" class="form-control" id="cargo" name="cargo" autocomplete="off"
                        value="{{ $cargo ? $cargo->cargo : old('cargo') }}" autofocus />
                </div>
                <div class="d-grid col-md-4"><br />
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-send-fill"></i> {{ $cargo ? 'Atualizar' : 'Enviar' }}
                    </button>
                </div>
            </form>
            <div class="col-md-12 mt-3" id="message">

            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h5>Todos os cargos</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="cargos">
                    <thead>
                        <th>Nome do cargo</th>
                        <th>Colaboradores</th>
                        <th>Ações</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#form').submit(function(e) {
                e.preventDefault();
                $.post({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                         loadCargos();
                         $('#message').html('<div class="alert alert-success">'+response.message+'</div>');
                         if (!response.updated) {
                            $('#form')[0].reset();
                        }
                    },
                    error: function(error) {
                        $('#message').html('<div class="alert alert-danger">'+error.responseJSON.message+'</div>');
                    }
                });
            })
            loadCargos();

            function loadCargos() {
                $.get('/cargo/getCargos', function(data) {
                    displayCargos(data);
                });
            }

            function displayCargos(cargos) {
                var tableBody = $('#cargos tbody');
                tableBody.empty();
                $.each(cargos, function(index, cargo) {
                    row = `<tr>
                     <td>${cargo.cargo}</td>
                     <td>${cargo.colaboradores.length}</td>
                     <td>
                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-product-id="${cargo.id}">Excluir</button>
                    </td>
                </tr>`;
                    tableBody.append(row);
                });
            }

            $('#cargos').on('click', '.btn-delete', function() {
                var cargoId = $(this).data('product-id');
                deleteCargos(cargoId);
            });

            function deleteCargos(cargoId) {
                $.post({
                    url:  "{{ route('cargo.delete', ':id') }}".replace(':id', cargoId),
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        loadCargos();
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            }
        });
    </script>
@endsection
