<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель</title>
    <meta name="description" content="Мониторинг и поддержка Ваших сайтов 24/7">
    <link rel="icon" type="image/png" href="{{asset('theme/favicons/favicon.ico')}}" sizes="16x16">
    <link rel="stylesheet" href="{{asset('theme/fonts/font-awesome-4.3.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/cms.css')}}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div id="app">
    <header>
    <span id="doc_time">
@php
    $date_today = date("d.m.y");
        echo("Сегодня: $date_today");
@endphp
</span>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-3 navbar-container bg-light">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="#">Меню CRM</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <!-- Вертикальное меню -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#link-0">Календарь отчетов</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('csm.projects.index')}}">Работа с проектами</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#link-2">Работа с отчетами</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('csm.tasks.index')}}">Работа с задачами</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#link-4">Работа с пользователями</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-md-8 col-lg-9 content-container" style="background-color: #ffe0b2">
                @yield('content')
                <div class="row">
                    <div class="col-md-12">
                        <passport-clients></passport-clients>
                    </div>
                    <div class="col-md-12">
                        <passport-authorized-clients></passport-authorized-clients>
                    </div>
                    <div class="col-md-12">
                        <passport-personal-access-tokens></passport-personal-access-tokens>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{asset('theme/js/admin.js')}}"></script>
</html>
