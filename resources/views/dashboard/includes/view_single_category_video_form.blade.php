<div class="row">
  <div class="col-md-6">
   <h2>Edit {{ $category->name }} </h2>
    @include('dashboard.includes.error_or_success_message')
    <form class="form" method="POST" action="/dashboard/category/update/{{ $category->id }}">
     {{ csrf_field() }}
     <div class="form-group">
      <input id="name" type="text" class="validate form-control" name="name" value="{{ $category->name }}" placeholder="Name">
    </div>
    <div class="form-group">
      <textarea id="description" class="form-control" name="description" placeholder="Description">{{ $category->description }}</textarea>
    </div>
    <div class="form-group">
    <button class="btn btn-primary" type="submit" name="action">Update
       <i class="material-icons right">mode_edit</i>
     </button>
   </div>
 </form>
</div>
</div>
