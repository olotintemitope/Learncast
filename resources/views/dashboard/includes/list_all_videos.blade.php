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
      @if ($videos->count() > 0)
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th data-field="sn">Sn</th>
            <th data-field="title">Title</th>
            <th data-field="category">Category</th>
            <th data-field="view">View</th>
            <th data-field="status">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($videos as $index => $video)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ ucwords($video->title) }}</td>
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
          @endforeach
        </tbody>
      </table>
      {!! $videos->render() !!}
      @else
      <h5>You do not have any active video(s)</h5>
      @endif
    </div>
    <div id="pending_videos" class="col-md-12 tab-pane fade">
      @if ($pendingVideos->count() > 0)
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th data-field="sn">Sn</th>
            <th data-field="title">Title</th>
            <th data-field="category">Category</th>
            <th data-field="status">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pendingVideos as $index  =>  $video)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ ucwords($video->title) }}</td>
            <td>{{ $video->category->name }}</td>
            <td>
              <select id="{{ $video->id }}" name="activate" class="activate_video form-control">
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
      <h5>You do not have any pending video(s)</h5>
      @endif
    </div>
  </div>
</div>
</div>