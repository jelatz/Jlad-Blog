<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('styles.css')}}">
    
    
    {{-- SCRIPTS --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{asset('custom.js')}}"></script>
    <title>Document</title>
</head>
<body class="font-roboto">
    <main>
        {{ $slot }}
    </main>
</body>
</html>