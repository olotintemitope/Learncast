<div class="card-panel hoverable">
  @include('dashboard.includes.error_or_success_message')
  <form class="col s12" method="POST" action="/dashboard/category/update/{{ $category->id }}">
   {{ csrf_field() }}
   <div class="row">
     <div class="input-field col s8 offset-m3">
      <input id="name" type="text" class="validate" name="name" value="{{ $category->name }}">
      <label for="name">Name</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s8 offset-m3">
      <textarea id="description" class="materialize-textarea" name="description">{{ $category->description }}</textarea>
      <label for="description">Description</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s8 offset-m3">
      <button class="btn waves-effect waves-dark" type="submit" name="action">Update
       <i class="material-icons right">mode_edit</i>
     </button>
   </div>
 </div>
</form>
</div>
