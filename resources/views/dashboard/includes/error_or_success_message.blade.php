<div class="row">
 <div class="col-md-6">
  @if (session('status') == 'Oops! unauthorized access to video!')
   <div class="text-danger">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
 @if (session('status') == 'Invalid url')
   <div class="text-danger">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
  @if (session('status') == 'Video url already exists')
   <div class="text-danger">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
   @if (session('status') == 'Category already exists!')
   <div class="text-danger">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
  @if (session('status') == 'Oops! unauthorized access to video category!')
   <div class="text-danger">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
  @if (session('status') == 'File accepted must be a jpg and not more 10MB!')
   <div class="text-danger">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
  @if (session('status') == 'Sucessfully created!') 
  <div class="text-success">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
  @if (session('status') == 'Profile picture update successfully!') 
  <div class="text-success">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
  @if (session('status') == 'Sucessfully updated!') 
  <div class="text-success">
    <strong> {{ session('status') }}</strong>
  </div>
  @endif
  @if (count($errors) > 0)
  <!-- Form Error List -->
  <div class="text-danger">
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