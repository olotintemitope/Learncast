<div class="card-panel hoverable">
 <div class="row">
  <div id="active_videos" class="col s12">
    @if (count($favourite) > 0)
    <table class="bordered responsive-table">
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
        @foreach($favourite->user->videos as $video)
        <tr>
          <td>{{ $sn }}</td>
          <td>{{ $video->title }}</td>
          <td>{{ $video->url }}</td>
          <td>{{ $video->category->name }}</td>
          <td>
           <span>
             <a href ="/view/video/{{ $video->id }}" title="{{ $video->title }}"><i class="fa fa-youtube-play" aria-hidden="true"></i> View</a>
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
</div>