<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


<body>
    @hasSection('no-content')
    @yield('no-content')
    @else
    <main>
        @include('includes.components.navbarhome')
        <div class="content">
            @yield('content')
        </div>
        @include('includes.components.footer')
    </main>
    @endif
</body>

</html>