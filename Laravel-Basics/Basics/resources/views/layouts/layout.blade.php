<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body> 
    @yield('content')     {{-- Oznacza i nazywa sekcję w layoucie do której chcemy mieć później dostęp --}}
    <ul>
        <a href="/">
            <li>Strona Główna</li>
        </a>
        <a href="/about">
            <li>About</li>
        </a>
        <a href="/contact">
            <li>Kontakt</li>
        </a>        
    </ul>
</body>
</html>