<!DOCTYPE html>
<html lang="en">
<?php $num = rand(0, 9); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="icon" type="image/png" href=<?php echo $path = asset(
        'img/favicon' . $num . '.png'
    ); ?>>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pig.css') }}">

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