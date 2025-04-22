<!DOCTYPE html>
<html lang="en">

<head>
    @include('head')
</head>

<body class="sidebar-mini layout-fixed" style="height: auto;">
    <div class="wrapper">
        <!-- Navbar -->
        @include('nav')
        <div style="min-height: calc(100vh - 140px);">
            @yield('content')
        </div>

    </div>
</body>

</html>