<header class="header">
  <div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light circle hide-on-large-only"><i class="material-icons">menu</i></a></div>
  <ul id="nav-mobile" class="side-nav fixed ">
    <li class="logo">
      <a id="logo-container" href="/dashboard/profile" class="brand-logo">
        <img src="{{ Auth::user()->picture_url }}" title="{{ ucwords(Auth::user()->username) }}" alt="{{ ucwords(Auth::user()->username) }}" class="img-circle">
      </a>
   </li>
    <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
      <li class="bold"><a class="collapsible-header  waves-effect waves-teal">Home <i class="material-icons">home</i></a>
          <div class="collapsible-body">
            <ul>
              <li> <a href="/dashboard" class="waves-effect waves-teal"> Dashboard </a></li>
              <li><a href="/">Homepage</a></li>
            </ul>
          </div>
        </li>
        @can('has-category', session('category'))
        <li class="bold"><a class="collapsible-header  waves-effect waves-teal">Video Category <i class="material-icons">video_library</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="/dashboard/category/add">Add Category</a></li>
              <li><a href="/dashboard/category/view">View Category</a></li>
            </ul>
          </div>
        </li>
        @endcan
        <li class="bold"><a class="collapsible-header  waves-effect waves-teal">My Videos 
          <i class="material-icons">note_add</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="/dashboard/video/add">Add video </a></li>
              <li><a href="/dashboard/video/view">View Videos</a></li>
              <li><a href="/dashboard/video/favourites">Favourite Videos</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </li>
  </ul>
</header>