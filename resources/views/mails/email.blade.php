<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Llamado de emergencia</title>
</head>
<body>
    <p>Hola! Se ha reportado un nuevo caso de emergencia a las {{ $distressCall->created_at }}.</p>
    <p>Estos son los datos del usuario que ha realizado la denuncia:</p>
    <ul>
        <li>Nombre: {{ $distressCall->user->name }}</li>
        <li>Teléfono: {{ $distressCall->user->phone }}</li>
        <li>DNI: {{ $distressCall->user->dni }}</li>
    </ul>
    <p>Y esta es la posición reportada:</p>
    <ul>
        <li>Latitud: {{ $distressCall->lat }}</li>
        <li>Longitud: {{ $distressCall->lng }}</li>
        <li>
            <a href="https://www.google.com/maps/dir/{{ $distressCall->lat }},{{ $distressCall->lng }}">
                Ver en Google Maps
            </a>
        </li>
    </ul>
</body>
</html>


<!-- @component('mail::message')
# {{ $mailData['titulo'] }}
contenido del correo...
@component('mail::button', ['url' => $mailData['url'], 'color' => 'success'])
Boton
@endcomponent
Saludos,<br>
{{ config('app.name') }}
@endcomponent -->