<form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    @auth
    <li class="dropdown"><a href="/backend" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      <img alt="image" src="{{ asset('stisla') }}/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
      <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div></a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-divider"></div>
        
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="dropdown-item has-icon text-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>
      </div>
    </li>
    @endauth
  </ul>
