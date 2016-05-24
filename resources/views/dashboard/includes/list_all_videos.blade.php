 <div class="row">
  <div class="col-md-12">
  <h2>View Uploaded Videos</h2>
    <ul class="nav nav-tabs">
      <li role="presentation" class="active">
       <a data-toggle="tab" href="#active_videos">Active Videos</a>
     </li>
     <li role="presentation">
       <a data-toggle="tab"  href="#pending_videos">Pending Videos</a>
     </li>
   </ul>
 </div>
 <div class="tab-content">
 <div id="active_videos" class="col-md-12 tab-pane active">
    @if (count($videos) > 0)
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th data-field="sn">Sn</th>
          <th data-field="title">Title</th>
          <th data-field="url">Url</th>
          <th data-field="category">Category</th>
          <th data-field="view">View</th>
          <th data-field="status">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $sn = 1; ?>
        @foreach($videos as $video)
        <tr>
          <td>{{ $sn }}</td>
          <td>{{ ucwords($video->title) }}</td>
          <td>{{ $video->url }}</td>
          <td>{{ $video->category->name }}</td>
          <td><a href ="/view/video/{{ $video->id }}" title="{{ $video->title }}" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i> View</a></td>
          <td>
           <span>
            <a href="/dashboard/video/edit/{{ $video->id }}" title="{{ $video->title }}" id="{{ $video->id }}">Edit <i class="fa fa-pencil" aria-hidden="true"></i> 
            </a>
          </span>
        </td>
        <td>
         <select id="{{ $video->id }}" name="activate" class="activate_video form-control">
          <option value="" selected>Select</option>
          <option value="0">De-activate</option>
        </select>
      </td>
    </tr>
    <?php $sn++; ?>
    @endforeach
  </tbody>
</table>
{!! $videos->render() !!}
</div>
@else 
<h5>Video are not available for display</h5>
@endif
<div id="pending_videos" class="col-md-12 tab-pane fade">
  @if (count($pendingVideos) > 0)
  <?php $sn = 1; ?>
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th data-field="sn">Sn</th>
        <th data-field="title">Title</th>
        <th data-field="url">Url</th>
        <th data-field="category">Category</th>
        <th data-field="status">Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pendingVideos as $video)
      <tr>
        <td>{{ $sn }}</td>
        <td>{{ ucwords($video->title) }}</td>
        <td>{{ $video->url }}</td>
        <td>{{ $video->category->name }}</td>
        <td>
         <select id="{{ $video->id }}" name="activate" class="activate_video form-control">
          <option value="" selected>Select</option>
          <option value="1">Activate</option>
        </select>
      </td>
    </tr>
    <?php $sn++; ?>
    @endforeach
  </tbody>
</table>
{!! $pendingVideos->render() !!}
@else 
<h5>Video are not available for display</h5>
@endif
</div>
</div>
</div>
</div>