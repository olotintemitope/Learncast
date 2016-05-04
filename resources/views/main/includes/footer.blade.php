<footer id="footer" class="footer">
    <div class="container">
        <p class="text-left">©2016 Made with <i class="fa fa-heart-o fa-lg"></i> by <a href="https://github.com/andela-tolotin/" target="_blank"> Temitope Olotin </a></p>
    </div>
</footer>

<div class="scroll-up">
    <a href="#"><i class="fa fa-angle-up"></i></a>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="text-center">SIGN UP</h2>
            </div>
            <div class="modal-body row">
                <h4 class="text-center info">COMPLETE THESE FIELDS TO SIGN UP</h4>
                <form class="col-md-10 col-md-offset-1 col-xs-12 col-xs-offset-0" method="POST" id="signUpForm">
                  {!! csrf_field() !!}
                  <div class="form-group">
                    <input type="text" class="form-control input-lg" placeholder="Username" name="username" id="username">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-lg" placeholder="Email" name="email" id="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control input-lg" placeholder="Password" name="password" id="password">
                </div>
                <div class="preloader-wrapper small active">
                    <img src="{{ URL::to('/') }}/images/preloader.gif" title="preloader" alt="preloader">
                </div>
    <div class="form-group">
        <button class="btn btn-danger btn-lg btn-block" id="signup">Sign up</button>
        <span class="pull-right"><a href="/login">Log In</a></span>
    </div>
</form>
</div>
<div class="row">
    <div class="col-xs-12 col-md-4">
        <a href="{{ url('/auth/facebook') }}" class="btn btn-md btn-primary btn-block btn-social btn-facebook">
            <i class="fa fa-facebook"></i> Facebook
        </a>
    </div>
    <div class="col-xs-12 col-md-4">
        <a href="{{ url('/auth/twitter') }}" class="btn btn-md btn-block btn-social btn-twitter">
            <i class="fa fa-twitter"></i> Twitter
        </a>
    </div>
    <div class="col-xs-12 col-md-4">
      <a href="{{ url('/auth/github') }}" class="btn btn-md btn-block btn-social btn-github">
        <i class="fa fa-github"></i> Github
    </a>
</div>
</div>
<div class="modal-footer">
    <h6 class="text-center"><a href="">Privacy is important to us. Click here to read why.</a></h6>
</div>
</div>
</div>
</div>
<!--scripts loaded here-->
<script src="{{ URL::asset('js/jquery-2.1.1.min.js') }}"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="{{ URL::asset('js/scripts.js') }}"></script>
<script src="{{ URL::asset('js/jquery.als-1.7.min.js') }} "></script>
<script src="{{ URL::asset('js/video_category.js') }}"></script>
<script src="{{ URL::asset('js/user.js') }}"></script>
<script src="{{ URL::asset('js/materialize.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("body").userPlugin();
    });
</script>
</body>
</html>