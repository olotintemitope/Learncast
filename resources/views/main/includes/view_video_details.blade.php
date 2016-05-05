<div class="container v-center">
 <div class="row">
  <div class="col-lg-12 bg-white video_frame">
    <div class="video_wrapper">
     <iframe src="https://www.youtube.com/embed/{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
   </div>
   <h3> {{ $video->title }} </h3>
   <div class="video_details">
     <ul class="list-inline">
      <li><button type="button" class="btn btn-primary btn-sm views"> <i class="fa fa-eye"> {{ $video->views }}  </i> </button></li>
      <li><button type="button" class="btn btn-primary btn-sm comments" id="{{ $video->id }}"> <i class="fa fa-comment"> 5</i></li>
      <li><button type="button" class="btn btn-primary btn-sm favourites" id="{{ $video->id }}"> <i class="fa fa-thumbs-up"> {{ $video->favourites }} </i> </button></li></li>
    </ul>
    <p> {{ $video->description }} </p>
  </div>
</div>
</div>
<div class="row">
  <div class="col-lg-8">
    <div class="panel panel-primary">
     <div class="panel-heading">RECENT COMMENT HISTORY</div>
     <div class="panel-body">
       <ul class="media-list">
        <li class="media">
          <div class="media-body">
           <div class="media">
            <a class="pull-left" href="#">
              <img class="media-object img-circle " src="{{ URL::to('/') }}/images/user.jpg">
            </a>
            <div class="media-body">
              Donec sit amet ligula enim. Duis vel condimentum massa.
              Donec sit amet ligula enim. Duis vel condimentum massa.Donec sit amet ligula enim. 
              Duis vel condimentum massa.
              Donec sit amet ligula enim. Duis vel condimentum massa.
              <br>
              <small class="text-muted">Alex Deo | 23rd June at 5:00pm</small>
              <hr>
            </div>
          </div>
        </div>
      </li>    
    </ul>
  </div>
  <div class="panel-footer">
   <div class="input-group">
    <input type="text" class="form-control" placeholder="Enter Message">
    <span class="input-group-btn">
     <button class="btn btn-primary" type="button">SEND</button>
   </span>
 </div>
</div>
</div>
</div>
<div class="col-lg-4">
 <div class="related_videos_wrapper">
  <h3> Related Videos </h3>
  <div class="list_videos ">
    <div class="video_thumbnail">
     <a class="pull-left" href="#">
      <img class="media-object img-circle " src="{{ URL::to('/') }}/images/user.jpg">
    </a>
  </div>
  <div class="video_info bg-white">
   <h4>PHP Iterators</h4>
   <span>Category</span><br>
   <span>12,000 views</span>
 </div>
</div>
<div class="list_videos">
 <div class="video_thumbnail">
   <a class="pull-left" href="#">
    <img class="media-object img-circle " src="{{ URL::to('/') }}/images/user.jpg">
  </a>
</div>
<div class="video_info bg-white">
 <h4>PHP Iterators</h4>
 <span>Category</span><br>
 <span>12,000 views</span>
</div>
</div>
</div>
</div>
</div>
</div>