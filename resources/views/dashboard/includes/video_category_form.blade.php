<div class="row">
  <div class="col-md-6">
    <h2>Add a new video category</h2>
    @include('dashboard.includes.error_or_success_message')
    <form class="form" method="POST" action="/dashboard/category/create">
      {{ csrf_field() }}
      <div class="form-group">
        <input id="name" type="text" class="validate form-control" name="name" value="{{ old('name') }}" placeholder="Name">
      </div>
      <div class="form-group">
        <textarea id="description" class="form-control" name="description" placeholder="Description">{{ old('description') }}</textarea>
      </div>
      <div class="form-group">
        <button class="btn btn-lg btn-primary" type="submit" name="action">Create <i class="material-icons right">send</i>
        </button>
      </div>
    </form>
  </div>
</div>