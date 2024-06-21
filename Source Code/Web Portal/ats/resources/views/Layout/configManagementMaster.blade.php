<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @include('partials.style')
</head>
<body>

    @include('partials.configuration_management_head')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @include('partials.script')
    
</body>
</html>