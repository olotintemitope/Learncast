<div class="row">
  <div class="col-md-6">
    <h2>Edit {{ ucwords($video->title) }} </h2>
    @include('dashboard.includes.error_or_success_message')
    <form class="form" method="POST" action="/dashboard/video/update/{{ $video->id}}">
      {{ csrf_field() }}
      <div class="form-group">
        <select name="category" id="category" class="form-control">
          <option value="" >Video Category</option>
          @foreach($categories as $category)
          @if ($category->id === $video->category_id)
          <option selected value="{{ $category->id }}">{{ $category->name }}</option>
          @else
          <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endif
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <input id="title" type="text" class="validate form-control" name="title" value="{{ ucwords($video->title) }}" placeholder="Title">
      </div>
      <div class="form-group">
        <input id="url" type="text" class="validate form-control" name ="url" value="https://www.youtube.com/watch?v={{ $video->url }}" placeholder="Url">
      </div>
      <div class="form-group">
        <textarea id="description" class="form-control" name="description" placeholder="Description">{{ $video->description }}</textarea>
      </div>
      <div class="form-group">
        <button class="btn btn-lg btn-primary" type="submit" name="action">Update</button>
      </div>
    </form>
  </div>
</div>