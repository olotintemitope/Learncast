<div class="row">
  <div class="col-md-6">
    <h2>Add a new Video</h2>
    @include('dashboard.includes.error_or_success_message')
    <form class="form" method="POST" action="/dashboard/video/create">
      {{ csrf_field() }}
      <div class="form-group">
        <select name="category" id="category" class="form-control">
          <option value="" >Video Category</option>
          @foreach($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <input id="title" type="text" class="validate form-control" name="title" value="{{ old('title')}}" placeholder="Title">
      </div>
      <div class="form-group">
        <input id="url" type="text" class="validate form-control" name ="url" value="{{ old('url')}}" placeholder="Url">
      </div>
      <div class="form-group">
        <textarea id="description " class="form-control" name="description" placeholder="Description"></textarea>
      </div>
      <div class="form-group">
        <button class="btn btn-lg btn-primary" type="submit" name="action">Create
        <i class="material-icons pull-right">send</i>
        </button>
      </div>
    </form>
  </div>
</div>