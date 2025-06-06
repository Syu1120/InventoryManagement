<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <!-- Scripts -->
        @vite(['resources/sass/app.scss'])
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        在庫管理
                    </a>

                    <div>
                        
                    </div>
                </div>
            </nav>
        </div>
    </body>
</html>