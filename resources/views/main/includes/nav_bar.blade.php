<nav class="navbar navbar-trans navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapsible">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand text-default" href="/">Learncast</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar-collapsible">
            @if (Auth::check())
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                <li id="user-avatar">
                <a href="dashboard/profile">
                  <img src="{{ Auth::user()->picture_url }}" class="img-circle" height="30">
              </a>
          </li>
          <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ ucwords(Auth::user()->username) }}<span class="caret"></span>
          </a>

          <ul class="dropdown-menu" role="menu">
            <li>
                <a href="/dashboard/profile">
                    <i class="fa fa-btn fa-user"></i> {{ ucwords(Auth::user()->username) }}'s profile
                </a>
            </li>
            <li role="separator" class="divider"></li>
            <li><a href="/dashboard"><i class="fa fa-btn fa-dashboard"></i> Dashboard</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/dashboard/logout"><i class="fa fa-btn fa-power-off"></i> Logout</a></li>
        </ul>
    </li>
</ul>
@else 
<ul class="nav navbar-nav navbar-right">
    <li><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
    <li><a href="/login">Login</a></li>
    <li>&nbsp;</li>
</ul>
@endif
</div>
</div>
</nav>