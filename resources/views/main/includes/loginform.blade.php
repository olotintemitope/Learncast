<div class="row">
  <form class="col-lg-6 col-lg-offset-3 bg-white login_form" method="POST" action="{{ url('auth/login') }}">
    <h4 class="text-center">LOG IN</h4>
    @include('main.includes.error_and_success')
    {!! csrf_field() !!}
    <div class="form-group">
      <input type="text" class="form-control input-lg" placeholder="Username" name="username" value="{{ old('username')}}">
    </div>
    <div class="form-group">
      <input type="password" class="form-control input-lg" placeholder="Password" name="password"value="">
    </div>
    <div class="form-group">
      <button class="btn btn-danger btn-block">Log In</button>
    </div>
    <div class="form-group">
      <a href="/#signup" class="btn btn-default custom-button-width pull-right">
       <i class="fa fa-user"></i> Signup
     </a>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
    <div class="form-group">
      <a href="{{ url('/auth/facebook') }}" class="btn btn-md btn-primary btn-block btn-social btn-facebook">
       <i class="fa fa-facebook"></i> Facebook
     </a>
     <a href="{{ url('/auth/twitter') }}" class="btn btn-md btn-primary btn-block btn-social btn-twitter">
      <i class="fa fa-twitter"></i> Twitter
    </a>
    <a href="{{ url('/auth/github') }}" class="btn btn-md btn-default btn-block btn-social btn-github" style="background: #000000; color: #ffffff;">
      <i class="fa fa-github"></i> Github
    </a>
  </div>
</form>
</div>

