<!doctype html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        @yield('title', config('app.name'))
    </title>


    {{-- THEME --}}

    <script>
        (function () {

            var saved =
                localStorage.getItem('sakuci-theme');

            var theme =
                saved ||
                (
                    matchMedia(
                        '(prefers-color-scheme: dark)'
                    ).matches
                        ? 'dark'
                        : 'light'
                );

            document.documentElement
                .setAttribute(
                    'data-bs-theme',
                    theme
                );

        })();
    </script>


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


<body class="bg-body-tertiary">


    {{-- =====================================================
         NAVBAR / SIDEBAR
    ====================================================== --}}

    @include('partials.navbar')


    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}

    <main
        id="mainContent"
        class="main-content"
    >

        <div
            class="container flex-grow-1 py-4 py-lg-5"
        >

            @include('partials.flash')

            @yield('content')

        </div>

    </main>


    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    @include('partials.footer')


    {{-- BOOTSTRAP --}}

    <script
        src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"
    ></script>


    {{-- THEME --}}

    <script
        src="{{ asset('js/theme.js') }}"
    ></script>


    @yield('scripts')

</body>

</html>
