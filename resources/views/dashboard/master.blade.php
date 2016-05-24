<!DOCTYPE html>
<html lang="en">
<head>
 @include('dashboard.includes.links_and_metadata')
 <title>@yield('title')</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
   @include('dashboard.includes.top_nav')
   @include('dashboard.includes.side_nav')
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
     @yield('content')
   </section>
 </div>
</div>
@include('dashboard.includes.footer')
