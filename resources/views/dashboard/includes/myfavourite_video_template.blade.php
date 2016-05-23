 <div class="row">
  <div class="col-md-12">
  <h2>My favourited videos</h2>
  <div id="active_videos" class="col s12">
    @if (count($favourite) > 0)
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th data-field="sn">Sn</th>
          <th data-field="title">Title</th>
          <th data-field="url">Url</th>
          <th data-field="category">Category</th>
          <th data-field="status">View</th>
        </tr>
      </thead>
      <tbody>
        <?php $sn = 1; ?>
        @foreach($favourite as $favourites)
        <tr>
          <td>{{ $sn }}</td>
          <td>{{ $favourites->video->title }}</td>
          <td>{{ $favourites->video->url }}</td>
          <td>{{ $favourites->video->category->name }}</td>
          <td>
           <span>
             <a href ="/view/video/{{ $favourites->video->id }}" title="{{ $favourites->video->title }}" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i> View</a>
          </span>
        </td>
    </tr>
    <?php $sn++; ?>
    @endforeach
  </tbody>
</table>
</div>
@else 
<h5>Video are not available for display</h5>
@endif
</div>
<div class="row">
    <div class="col-lg-6 col-lg-offset-4 pull-right">
       {!! $favourite->render() !!}
    </div>
  </div>
</div>