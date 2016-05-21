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
                <div class="form-group">
                    <input type="password" class="form-control input-lg" placeholder="Confirm password" name="cpassword" id="cpassword">
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
        <a href="{{ url('/auth/twitter') }}" class="btn btn-md btn-primary btn-block btn-social btn-twitter">
            <i class="fa fa-twitter"></i> Twitter
        </a>
    </div>
    <div class="col-xs-12 col-md-4">
      <a href="{{ url('/auth/github') }}" class="btn btn-md btn-block btn-social btn-github" style="background: #000000; color: #ffffff;">
        <i class="fa fa-github"></i> Github
    </a>
</div>
</div>
</div>
</div>
</div>
<!--scripts loaded here-->
<script src="{{ URL::asset('js/jquery-2.1.1.min.js') }}"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script src="{{ URL::asset('js/scripts.js') }}"></script>
<script src="{{ URL::asset('js/jquery.als-1.7.min.js') }} "></script>
<script src="{{ URL::asset('js/video_category.js') }}"></script>
<script src="{{ URL::asset('js/user.js') }}"></script>
<script src="{{ URL::asset('js/Video.js') }}"></script>
<script src="{{ URL::asset('js/jquery.timeago.js') }}"></script>
<script src="{{ URL::asset('js/sweetalert.min.js') }}"></script>
<script>
    $('.responsive').slick({
      dots: false,
      infinite: false,
      autoplay: true,
      speed: 2000,
      slidesToShow: 5,
      slidesToScroll: 2,
      responsive: [
      {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: false
        }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2
    }
},
{
  breakpoint: 480,
  settings: {
    slidesToShow: 2,
    slidesToScroll: 1
}
}
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]
});
    $(document).ready(function() {
        $(".scroll-up").click(function() {
          scrollToElement("html", 600);
        });

        $("body").userPlugin();
        $("body").videoPlugin();

        var hash = window.location.hash;
        if (hash == "#signup") {
         $('#myModal').modal();
      }
    });
    var scrollToElement = function(el, ms){
      var speed = (ms) ? ms : 1000;
      $('html,body').animate({
        scrollTop: $(el).offset().top
      }, speed);
    }
</script>
</body>
</html>