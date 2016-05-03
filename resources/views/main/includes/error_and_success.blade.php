@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger">
      <strong>Whoops! Something went wrong!</strong>
      <br>
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    @if (session('status') == 'Oops! Login attempt failed!')
    <div class="alert alert-danger">
      <strong> {{ session('status') }}</strong>
    </div>
    @endif
    @if (session('status') == 'Sucessfully logged in!') 
    <div class="alert alert-success">
      <strong> {{ session('status') }}</strong>
    </div>
    @endif