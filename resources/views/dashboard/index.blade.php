<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" />
  @include('dashboard.includes.links_and_metadata')
  <title>Dashboard :: Welcome home</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
   @include('dashboard.includes.top_nav')
   @include('dashboard.includes.side_nav')
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
     <!--  @yield('content') -->
     <!-- Small boxes (Stat box) -->
     <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{ $favourite }}</h3>
            <p>Video Favourites</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="/dashboard/video/favourites" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{ $videos }}<sup style="font-size: 20px"></sup></h3>
            <p>Uploaded Videos</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="/dashboard/video/view" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      @if (Auth::user()->role_id == 2)
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{ $category }}</h3>
            <p>Video Catgories</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="/dashboard/category/view" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      @endif
    </div>
    <div class="row">
     <div class="col-lg-6 col-xs-12">
       <p>You are welcome to LearnCast: A web portal for all learning resources, we have a wide range of subjects that will help you to grow faster in your career.<br/>
         Happy Learning! <br/><br/>
         <Strong class="right">CE0</Strong><em class="right"> Temitope Olotin.</em>
       </p>
     </div>
   </div>
 </section>
</div>
</div>
@include('dashboard.includes.footer')

