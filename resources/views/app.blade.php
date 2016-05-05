@include('main.includes.header')
<style type="text/css">
body,html {
  background-image: none !important;
  background: #f8f8f8;
}

</style>
@include('main.includes.nav_bar')
<div class="container">
    <div class="content">
        @yield('content')
    </div>
</div>
@include('main.includes.footer')

