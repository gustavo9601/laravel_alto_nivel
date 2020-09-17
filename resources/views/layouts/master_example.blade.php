<!doctype html>
<html lang="es_CO">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ecommerce GM</title>
</head>
<body>

{{--Verificando si se recibe desde el controlador la sesion como error--}}
{{--@if(session()->has('error'))
    <div class="alert alert-danger">
        {{session()->get('error')}}
    </div>
@endif--}}

@if(session()->has('success'))
    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
@endif

{{--Validando la variable global de laravel $errors--}}
@if (isset($errors) && $errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif


{{--Nombre al segemento, de como se llamara de otros archivos--}}
@yield('content')
</body>
</html>
