<header class="">
  <div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light circle hide-on-large-only"><i class="material-icons">menu</i></a></div>
  <ul id="nav-mobile" class="side-nav fixed grey lighten-4">
    <li class="logo">
      <a id="logo-container" href="#" class="brand-logo">
        <img src="{{ URL::to('/') }}/images/user.jpg" title="myprofile" alt="myprofile">
      </a>
    </li>
    <li class="search">
      <div class="search-wrapper card">
        <input id="search" spellcheck="false" ginger_software_editor="true" class="" style=""><i class="material-icons">search</i>
        <div class="search-results"></div>
      </div>
    </li>
    <li class="bold"><a href="/dashboard" class="waves-effect waves-teal"><i class="material-icons"></i> Home</a></li>
    <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
        <li class="bold"><a class="collapsible-header  waves-effect waves-teal">Video Category <i class="material-icons">video_library</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="/dashboard/category/add">Add Category</a></li>
              <li><a href="/dashboard/category/view">View Category</a></li>
            </ul>
          </div>
        </li>
        <li class="bold"><a class="collapsible-header  waves-effect waves-teal">Courseware 
          <i class="material-icons">note_add</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="/dashboard/video/add">Add video </a></li>
              <li><a href="/dashboard/video/view">View Videos</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </li>
  </ul>
</header>