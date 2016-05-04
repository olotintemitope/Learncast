<div class="card-panel hoverable">
 <div class="row">
  <div class="col s12">
    <ul class="tabs">
      <li class="tabs col s3"><a class="active" href="#active_videos">Active Videos</a></li>
      <li class="tabs col s3"><a class="" href="#pending_videos">Pending Videos</a></li>
    </ul>
  </div>
  <div id="active_videos" class="col s12">
  @if (count($videos) > 0)
    <table class="bordered responsive-table">
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
        <?php $sn = 1; ?>
        @foreach($videos as $video)
        <tr>
          <td>{{ $sn }}</td>
          <td>{{ $video->title }}</td>
          <td>{{ $video->url }}</td>
          <td>{{ $video->category->name }}</td>
          <td>
           <span>
            <a href="/dashboard/video/edit/{{ $video->id }}" title="{{ $video->title }}" id="{{ $video->id }}">Edit <i class="fa fa-pencil" aria-hidden="true"></i> 
            </a>
          </span>
        </td>
        <td>
         <select id="{{ $video->id }}" name="activate" class="activate_video">
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
<div id="pending_videos" class="col s12">
@if (count($pendingVideos) > 0)
  <table class="bordered responsive-table">
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
        <td>{{ $video->id }}</td>
        <td>{{ $video->title }}</td>
        <td>{{ $video->url }}</td>
        <td>{{ $video->category->name }}</td>
        <td>
         <select id="{{ $video->id }}" name="activate" class="activate_video">
          <option value="" selected>Select</option>
          <option value="1">Activate</option>
        </select>
      </td>
    </tr>
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