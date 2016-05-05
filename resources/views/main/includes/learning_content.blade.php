<div class="container v-center bounceInDown animated bg-white">
  @foreach ($allVideos->chunk(4) as $chunk)
  <div class="row">
    @foreach ($chunk as $video)
    <div class="col-lg-3">
      <div class="cuadro_intro_hover" style="background-color:#cccccc;">
       <p>
          <img src="http://img.youtube.com/vi/{{ $video->url }}/mqdefault.jpg" class="img-responsive" alt="{{ $video->title}}" >
       </p>
       <div class="caption">
        <div class="blur"></div>
        <div class="caption-text">
          <h3>{{ $video->title }}</h3>
          <p>{{ $video->description }}</p>
          <a class=" btn btn-primary" href="/view/video/{{ $video->id }}">
            <span class="glyphicon glyphicon-play"> VIEW </span></a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endforeach
</div>