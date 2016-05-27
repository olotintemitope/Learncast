<div class="row">
  <form class="col-lg-6 col-lg-offset-3 bg-white login_form" method="POST" action="{{ url('auth/login') }}">
    <h4 class="text-center">LOG IN</h4>
    @include('main.includes.error_and_success')
    {!! csrf_field() !!}
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username')}}">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" placeholder="Password" name="password"value="">
    </div>
    <div class="form-group">
      <button class="btn btn-danger btn-block">Log In</button>
    </div>
    <div class="form-group">
      <a href="/#signup" class="btn btn-default custom-button-width pull-right border">
       <i class="fa fa-user"></i> Signup
     </a>
     <a href="/password/reset" class="btn btn-default custom-button-width pull-left border">
       <i class="fa fa-lock"></i> Password reset
     </a>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
    <div class="row">
  <div class="col-md-12">
      <a href="{{ url('/auth/facebook') }}" class="btn btn-md btn-primary btn-block btn-social btn-facebook pull-left">
       <i class="fa fa-facebook"></i> Log in with Facebook
     </a>
     <a href="{{ url('/auth/twitter') }}" class="btn btn-md btn-primary btn-block btn-social btn-twitter pull-left">
      <i class="fa fa-twitter" ></i> Log in Twitter
    </a>
    <a href="{{ url('/auth/github') }}" class="btn btn-md btn-default btn-block btn-social btn-github pull-left" style="background: #000000; color: #ffffff;">
      <i class="fa fa-github"></i> Log in Github
    </a>
  
  </div>
</div>
</form>

</div>

