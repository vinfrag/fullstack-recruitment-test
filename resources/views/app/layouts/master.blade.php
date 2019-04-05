<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <title>Medoucine</title>
    </head>

    <body>
        <main id="app" class="container">

            <main-component></main-component>
                        
            @yield('body')
            
            @yield('footer')
        </main>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>

</html>