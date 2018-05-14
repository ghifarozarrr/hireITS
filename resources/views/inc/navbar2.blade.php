<header id="header" id="home">
  <div class="container">
    <div class="row align-items-center justify-content-between d-flex">
      <div id="logo">
        <a class="navbar-brand" href="{{url('/')}}">hire<strong>ITS</strong></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="{{url('/')}}">Home</a></li>

          <li class="menu-has-children"><a href="#">Find Work</a>
            <ul>
              <li><a href="{{route('browse.jobs')}}">Browse Projects</a></li>
              <div class="dropdown-divider"></div>
              <li><a href="#">Browse Categories</a></li>
            </ul>
          </li>
          <li class="menu-has-children"><a href="#">Hire freelancers</a>
            <ul>
              <li><a href="{{route('post.project.page')}}">Post a project</a></li>
              <div class="dropdown-divider"></div>
              <li><a href="{{route('browse.showcase')}}">Showcase</a></li>
            </ul>
          </li>
          @if(Auth::check())
            <li class="menu-has-children"><a id="navbar-pic" href="#"><img src=""  alt="">My Account</a>
              <ul>

                <li><a href="{{route('view.freelancer.profile')}}">Profile</a></li>
                <li><a href="{{route('view.freelancer.dashboard')}}">Dashboard</a></li>
                <div class="dropdown-divider"></div>
                <li><a href="{{ route('logout') }}" class="dropdown-item"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                </form>
              </ul>

            </li>
          @else
            <li class=""><a id="login-btn" data-toggle="modal" data-target="#exampleModalCenter" href="#">Login</a></li>
          @endif
        </ul>
      </nav>
    </div>
  </div>
</header>