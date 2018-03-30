<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        @include('includes.header')
    </header>
    {{--//id="main"--}}

    <div class="content-wrapper">
        @include('layouts.sidebar')

        @yield('content')

    </div>

    <footer class="main-footer">
        @include('includes.footer')
    </footer>

</div>
@include('includes.js')
</body>
</html>

