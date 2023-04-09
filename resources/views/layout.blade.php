<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/base.css">
    @yield('script')
    @vite(['resources/css/app.css','resources/js/ajaxlike.js','resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
</head>

<body>
    <header>
        @yield('header')
    </header>

    <main role="main" id="container" class="main">
        @yield('content')
    </main>

    <footer>
        @include('footer')
    </footer>


</body>

</html>