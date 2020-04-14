<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@section ('title') Новости | @show</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
</head>

<body>
    <div class='container'>
        @yield('menu')
        @yield('menu_category_by_admin')

        @if(session('sucsess'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('sucsess') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @endif

        @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @endif

        @yield('contents')
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>