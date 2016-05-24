<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0.0
  </div>
  <strong>Copyright &copy; 2016-2017 <a href="http://github.com/andela-tolotin">Temitope Olotin</a>.</strong> All rights
  reserved.
</footer>
<!-- jQuery 2.2.0 -->
<script src="{{ URL::asset('plugins/jQuery/jQuery-2.2.0.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- My plugin for video and video categories -->
<script src="{{ URL::asset('js/videoCategory.js') }}"></script>
<script src="{{ URL::asset('js/Video.js') }}"></script>
<script src="{{ URL::asset('js/sweetalert.min.js') }}"></script>

<!-- Bootstrap 3.3.6 -->
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('js/app.min.js') }}"></script>

<script>
  $(function() {
    // More code using $ as alias to jQuery
    $("body").videoCategoryPlugin();
    $("body").videoPlugin();
    //$.widget.bridge('uibutton', $.ui.button);
  });
</script>
</body>
</html>