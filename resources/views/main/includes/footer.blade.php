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
      <div class="modal-body login-modal">
        <div class="clearfix"></div>
        <div id="social-icons-conatainer">
          <div class="modal-body-left">
           <h6 class="text-center info">COMPLETE THESE FIELDS TO SIGN UP</h6>
            <form class="col-md-12 " method="POST" id="signUpForm">
              {!! csrf_field() !!}
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" name="username" id="username">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Email" name="email" id="email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Confirm password" name="cpassword" id="cpassword">
              </div>
              <div class="preloader-wrapper small active">
                <img src="{{ URL::to('/') }}/images/preloader.gif" title="preloader" alt="preloader">
              </div>
              <div class="form-group">
              <button type="button" class="btn btn-success" id="signup">Sign up</button>
             </div>
           </form>
         </div>

         <div class="modal-body-right">
          <div class="modal-social-icons">
            <a href="{{ url('/auth/facebook') }}" class="btn btn-default facebook"> <i class="fa fa-facebook modal-icons"></i> Sign In with Facebook </a>
            <a href="{{ url('/auth/twitter') }}" class="btn btn-default twitter"> <i class="fa fa-twitter modal-icons"></i> Sign In with Twitter </a>
            <a href='{{ url('/auth/github') }}' class="btn btn-default github"> <i class="fa fa-github modal-icons"></i> Sign In with GitHub </a>
          </div> 
        </div>  
        <!-- <div id="center-line"></div> -->
      </div>                                                        
      <div class="clearfix"></div>

      <div class="form-group modal-register-btn">
        <a href="/login" class="btn btn-default border custom-button-width">Log In</a>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="modal-footer login_modal_footer">
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

    $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $('.scroll-up').fadeIn();
    } else {
      $('.scroll-up').fadeOut();
    }
  });
    $('.scroll-up').click(function() {
      scrollToElement("html", 600);
    });

    $('body').userPlugin();
    $('body').videoPlugin();

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