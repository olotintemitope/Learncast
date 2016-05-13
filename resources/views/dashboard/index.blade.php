<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" />
  @include('dashboard.includes.links_and_metadata')
  <title>Dashboard :: Welcome home</title>
</head>
<body>
  @include('dashboard.includes.side_nav')
  <main>
    @include('dashboard.includes.top_nav')
    <div class="row">
     <div class="col s12 m12">
      <div class="card big">
       <div class="card-content">
        <span class="card-title activator grey-text text-darken-4">
         <i class="material-icons right">more_vert</i></span>
         <div class="row" style="margin-right:3%;">
                <div class="col-lg-3 col-md-6">
                    <div class="card card-inverse card-primary">
                        <div class="card-block bg-primary">
                            <div class="rotate">gaa
                                <i class="fa fa-heart-o fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Favourites</h6>
                            <h4 class="display-1">{{ count($favourite) }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-inverse card-success">
                        <div class="card-block bg-success">
                            <div class="rotate">
                                <i class="fa fa-file-video-o fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Uploaded Videos</h6>
                            <h4 class="display-1">{{ $videos }}</h4>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->role_id == 2)
                <div class="col-lg-3 col-md-6">
                    <div class="card card-inverse card-warning">
                        <div class="card-block bg-warning">
                            <div class="rotate">
                                <i class="fa fa-video-camera fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Video Category</h6>
                            <h4 class="display-1">{{ $category }}</h4>
                        </div>
                    </div>
                </div>
                @endif
            </div>
       </div>
       <div class="card-reveal">
        <span class="card-title grey-text text-darken-4">Welcome Note:<i class="material-icons right">close</i></span>
        <p>You are welcome to LearnCast: A web portal for all learning resources, we have a wide range of subjects
         that will help you to grow faster in your career.<br/>
         Happy Learning. <br/>
         <Strong class="right">CE0</Strong><br/><em class="right">Temitope Olotin.</em>
         </p>
      </div>
    </div>
  </div>
</div>
</main>    
@include('dashboard.includes.footer')
</body>
</html>