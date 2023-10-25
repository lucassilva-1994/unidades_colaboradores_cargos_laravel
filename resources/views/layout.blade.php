<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" />
    <title>@yield('title', 'Unidades colaboradores cargos')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg mb-3" style="background-color: rgb(92, 0, 128);">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-end" id="menu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link link-light" href="{{ route('unidade.show') }}"><i
                                class="bi bi-card-list"></i> Unidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-light" href="{{ route('cargo.show') }}"><i
                            <i class="bi bi-person-workspace"></i> Cargos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-light" href="{{ route('colaborador.show') }}"><i
                            <i class="bi bi-people-fill"></i> Colaboradores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-light" href="{{ route('colaborador.desempenho.show') }}"><i
                            <<i class="bi bi-chat-square-dots-fill"></i> Avaliações</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-3 mb-3">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-3 mt-3">
                <h1>@yield('h1')</h1>
                @include('message')
            </div>
        </div>
        @yield('content')
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ url('js/jquery.mask.min.js') }}"></script>
</html>
