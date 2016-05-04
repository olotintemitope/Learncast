<nav class="light-blue darken-1">
  <ul class="right">
    <li>
       <a class="dropdown-button" href="#" data-activates="d2">
        {{ ucwords(Auth::user()->username) }} <i class="fa fa-chevron-down" aria-hidden="true"></i>
       </a>
      <ul id='d2' class='dropdown-content'>
        <li><a href="/dashboard/profile">Profile </a></li>
        <li><a href="/dashboard/logout">Log-Out </a></li>
      </ul>
    </li>
  </ul>
  <a href="#" data-activates="slide-out" class="button-collapse">
    <i class="mdi-navigation-menu"></i></a>
</nav>