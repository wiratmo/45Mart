@include('layout.header')

<body>
    <div class="wrapper">
        @include('layout.sidebar')
        <div class="main-panel">
            @include('layout.top_navbar')
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
</body>
@include('layout.footer')
