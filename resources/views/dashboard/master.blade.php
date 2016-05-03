<!DOCTYPE html>
<html lang="en">
<head>
 @include('dashboard.includes.links_and_metadata')
 <title>@yield('title')</title>
</head>
<body>
    @include('dashboard.includes.side_nav')
    <main>
        @include('dashboard.includes.top_nav')
        @yield('content')
    </main>
    @include('dashboard.includes.footer')
</body>
</html>
