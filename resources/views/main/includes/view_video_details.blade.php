<div class="container v-center">
 <div class="row">
  <div class="col-lg-12 bg-white video_frame">
    <div class="video_wrapper">
     <iframe src="https://www.youtube.com/embed/{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
   </div>
   <h3> {{ $video->title }}</h3><p class="pull-right"><strong>Created by </strong><em> <a href="/view/user/{{ $video->user->id}}" >{{ ucwords($video->user->username) }} </a></em></p>
   <div class="video_details">
     <ul class="list-inline">
      <li>
       <button type="button" class="btn btn-primary btn-sm views"> 
        <i class="fa fa-eye"> {{ $video->views }}  </i> 
      </button>
    </li>
    <li><button type="button" class="btn btn-primary btn-sm comments"> <i class="fa fa-comment"> {{ count($video->comments) }}</i>
    </li>
    @if (Auth::check())
    <li>
     <button type="button" class="btn btn-primary btn-sm favourites" id="{{ $video->id }}" data-user="{{ Auth::user()->id }}" data-fav="{{ $video->favourites }}"> 
       <i class="fa fa-thumbs-up"> {{ $video->favourites }} </i> 
     </button>
   </li>
   @endif
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
         @if (count($video->comments))
         @foreach($video->comments as $comment)
         <li class="media">
          <div class="media-body">
           <div class="media">
            <a class="pull-left" href="#">
              <img class="media-object img-circle" src="{{ $comment->user->picture_url }}">
            </a>
            <div class="media-body">
             <!-- Single button -->
             @if (Auth::check() && Auth::user()->id == $comment->user_id)
             <div class="btn-group pull-right">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="glyphicon glyphicon-option-vertical"></i>
              </button>
              <ul class="dropdown-menu t-menu">
                <li  class= "edit-comment" id="{{ $comment->id }}"><a href="#"><i class="glyphicon glyphicon-pencil"></i> Edit</a></li>
                <li role="separator" class="divider"></li>
                <li class="delete-comment" id="{{ $comment->id }}"><a href="#"><i class="glyphicon glyphicon-trash" ></i> Delete</a></li>
              </ul>
            </div>
            @endif
            <div class="comment" id="comment{{ $comment->id }}">{{ $comment->comment }}</div>
            <div class="comment_form"></div>
            <br><br>
            <small class="text-muted">{{ ucwords($comment->user->username) }} | posted {{ Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() }}
            </small>
            <hr>
          </div>
        </div>
      </div>
    </li> 
    @endforeach
    @else
    <li>
     <h4 align="center" class="video_category text-danger">Oops! comments are not available for display!</h4>
   </li>
   @endif
 </ul>
</div>
@if (Auth::check())
<div class="panel-footer">
  <div class="preloader-wrapper small active">
    <img src="{{ URL::to('/') }}/images/preloader.gif" title="preloader" alt="preloader">
  </div>
  <form method="POST" id="comment_form">
   {!! csrf_field() !!}
   <div class="input-group">
    <!-- <input type="text" class="form-control" placeholder="Enter Message" id="comment"> -->
    <textarea class="form-control" placeholder="Enter Message" id="comment"></textarea>
    <span class="input-group-btn">
      <button class="btn btn-primary clear-fix" type="button" id="send" data-user="{{ Auth::user()->id }}" data-video="{{ $video->id }}" data-avatar="{{ Auth::user()->picture_url }}" data-username = "{{ ucwords(Auth::user()->username) }}">SEND</button>
    </span>
  </div>
</form>
</div>
@endif
</div>
</div>
<div class="col-lg-4">
 <div class="related_videos_wrapper">
  <h3> Related Videos </h3>
  <div class="list_videos ">
    <div class="video_thumbnail">
     <a class="pull-left" href="#">
      <img  class="media-object" height="90" style="top: 8px" src="https://i.ytimg.com/vi/D38CH9zmG2w/hqdefault.jpg?custom=true&amp;w=120&amp;h=90&amp;jpg444=true&amp;jpgq=90&amp;sp=68&amp;sigh=pjnaiMZbwUI1NflYEgDNZhtOcTI" alt="" aria-hidden="true" width="120">
    </a>
  </div>
  <div class="video_info bg-white">
   <h5>All for Love - Hillsong United</h5>
   <span>Category</span><br>
   <span>12,000 views</span>
 </div>
</div>
<div class="list_videos">
 <div class="video_thumbnail">
   <a class="" href="#">
   <img  class="media-object" height="90" style="top: 8px" src="https://i.ytimg.com/vi/NoM0AT8fBvs/hqdefault.jpg?custom=true&amp;w=120&amp;h=90&amp;jpg444=true&amp;jpgq=90&amp;sp=68&amp;sigh=pjnaiMZbwUI1NflYEgDNZhtOcTI" alt="" aria-hidden="true" width="120">
  </a>
</div>
  <div class="video_info bg-white">
    <h5>PHP Iterators</h5>
    <span>Category</span><br>
    <span>12,000 views</span>
   </div>
</div>
</div>
</div>
</div>
</div>