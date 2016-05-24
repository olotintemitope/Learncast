<header class="main-header">
  <!-- Logo -->
  <a href="/dashboard" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>L</b>C</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>LEARN</b>CAST</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ Auth::user()->picture_url }}" title="{{ ucwords(Auth::user()->username) }}" alt="{{ ucwords(Auth::user()->username) }}" class="img-circle user-image">
            <span class="hidden-xs">{{ ucwords(Auth::user()->username) }} </span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{ Auth::user()->picture_url }}" title="{{ ucwords(Auth::user()->username) }}" alt="{{ ucwords(Auth::user()->username) }}" class="img-circle">
              <p>
                {{ ucwords(Auth::user()->username) }} 
                <!-- <small>Member since Nov. 2012</small> -->
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="/dashboard/profile" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="/dashboard/logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>