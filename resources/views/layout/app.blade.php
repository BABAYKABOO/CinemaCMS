<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/css/app.css')}}" rel="stylesheet">
    <link href="{{ asset('/css/')}}@yield('style')" rel="stylesheet">

</head>
<body style="background: url(@yield('img'));">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@include('partials.header')

   @yield('content')

@include('partials.footer')
</body>
</html>

