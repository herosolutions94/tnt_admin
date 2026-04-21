<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>@yield('title', 'Home')</title> -->
    @include('frontend.includes.site-master')

</head>

<body class="home-page">

    @include('frontend.includes.header')

    <main index>
        @yield('content')
    </main>

    @include('frontend.includes.footer')
    @include('frontend.includes.commonjs')


</body>

</html>