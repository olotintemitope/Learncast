<footer class="page-footer grey darken-1" style="bottom: 0;">
    <div class="footer-copyright">
        <div class="container">
        © 2015-2016 Learncast, All rights reserved.
        <a class="grey-text text-lighten-4 right" href="#">#TIA</a>
        </div>
      </div>
    </footer>
<!--scripts loaded here-->
    <script src="{{ URL::asset('js/jquery-2.1.1.min.js') }}"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.als-1.7.min.js') }} "></script>
    <script src="{{ URL::asset('js/video_category.js') }}"></script>
    <script src="{{ URL::asset('js/videoCategory.js') }}"></script>
    <script src="{{ URL::asset('js/Video.js') }}"></script>
    <script src="{{ URL::asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('js/materialize.min.js') }}"></script>
<script>
 $(document).ready(function() {
  $("body").videoCategoryPlugin();
  $("body").videoPlugin();
  $(".button-collapse").sideNav();
  $('.collapsible').collapsible();
  $('select').material_select();
 });
</script>