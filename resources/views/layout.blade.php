<!doctype html>
<html lang="lv">

    <head>
        <meta charset="UTF-8">
        <title>2. Projekts - {{ $title }}</title>
        <meta name="description" content="Mans 2. Projekts">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
         rel="stylesheet" 
         integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
         crossorigin="anonymous">
    </head>

    <body>

    <nav class="navbar b-primary mb-3" data-bs-theme="dark">
        <header class="container">
            <a class="navbar-brand" href="#"> 2. Projekts {{ $title }} </a>
        </header>
    </nav>

    <main class="container">
        <div class="row">
            <div class="col">

                @yield('content')

            </div>

        </div>

    </main>

    <footer class="text-bg-dark mt-3">
        <div class="container">
            <div class="row py-5">
                <div class="col">
                    Mikus Valts, 2026
                </div>
            </div>
        </div>
    </footer>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
        crossorigin="anonymous"></script>

    </body>
</html>