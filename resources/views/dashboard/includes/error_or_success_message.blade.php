<div class="row">
 <div class="input-field col s8 offset-m3">
   @if (session('status') == 'Category already exists!')
   <div class="card-panel deep-orange accent-4 danger">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
  @if (session('status') == 'Oops! Category does not exist!')
   <div class="card-panel deep-orange accent-4 danger">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
  @if (session('status') == 'File accepted must be a jpg and not more 10MB!')
   <div class="card-panel deep-orange accent-4 danger">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
  @if (session('status') == 'Sucessfully created!') 
  <div class="card-panel teal darken-4 success">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
  @if (session('status') == 'Profile picture update successfully!') 
  <div class="card-panel teal darken-4 success">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
  @if (session('status') == 'Sucessfully updated!') 
  <div class="card-panel teal darken-4 success">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
  @if (count($errors) > 0)
  <!-- Form Error List -->
  <div class="card-panel deep-orange accent-4 danger">
    <strong>Whoops! Something went wrong!</strong>
    <br>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>
</div>