<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/css/app.css')}}" rel="stylesheet">

</head>
<body style="background: url(@yield('img'));">
@include('partials.header')

   @yield('content')

@include('partials.footer')
</body>
</html>

