<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('boots/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('icon/all.css')}}">
    <script src="{{URL::asset('boots/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{URL::asset('boots/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{URL::asset('icon/all.js')}}"></script>
    <title>E-shop</title>
</head>
<body>
    @include('header')
    @yield('content')
    @include('footer')
</body>
</html>