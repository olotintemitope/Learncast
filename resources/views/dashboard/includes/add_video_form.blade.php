<div class="card-panel hoverable">
 @include('dashboard.includes.error_or_success_message')
 <form class="col s12" method="POST" action="/dashboard/video/create">
  {{ csrf_field() }}
  <div class="row">
    <div class="input-field col s8 offset-m3">
      <select name="category" id="category">
        <option value="" >Video Category</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
      <label>Video Category</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s8 offset-m3">
      <input id="title" type="text" class="validate" name="title" value="{{ old('title')}}">
      <label for="name">Title</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s8 offset-m3">
    <input id="url" type="text" class="validate" name ="url" value="{{ old('url')}}">
      <label for="url">Url</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s8 offset-m3">
      <textarea id="description" class="materialize-textarea" name="description"></textarea>
      <label for="description">Description</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s8 offset-m3">
      <button class="btn waves-effect waves-dark" type="submit" name="action">Create
       <i class="material-icons right">send</i>
     </button>
   </div>
 </div>
</form>
</div>