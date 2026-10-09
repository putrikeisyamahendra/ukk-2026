<!doctype html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', config('app.name'))
    </title>

    {{-- BOOTSTRAP --}}
    <link
        rel="stylesheet"
        href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"
    >

    {{-- APP CSS --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/app.css') }}"
    >

</head>


<body>

    {{-- SIDEBAR (sidebar + tombol tema ada di sini) --}}
    @include('partials.navbar')


    {{-- KONTEN UTAMA --}}
    <main id="mainContent" class="main-content">

        <div class="container flex-grow-1 py-4 py-lg-5">

            @include('partials.flash')

            @yield('content')

        </div>

    </main>


    {{-- FOOTER --}}
    @include('partials.footer')


    {{-- BOOTSTRAP JS --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    @yield('scripts')

</body>

</html>