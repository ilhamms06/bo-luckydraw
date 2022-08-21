<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="/">Lucky Draw</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">Lucky Draw</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
          <a href="/" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>
        @if (Auth::user()->status == 1)
          <li class="menu-header">Entry Data</li>
          <li class="nav-item {{ Request::is('project*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('project.index') }}"><i class="far fa-file-alt"></i> <span>Project</span></a>
          </li>

          <li class="nav-item {{ Request::is('screen*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('screen.index') }}"><i class="far fa-file-alt"></i> <span>Screen</span></a>
          </li>

          <li class="nav-item {{ Request::is('item*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('item.index') }}"><i class="far fa-file-alt"></i> <span>Item</span></a>
          </li>

          <li class="nav-item {{ Request::is('participant*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('participant.index') }}"><i class="far fa-file-alt"></i> <span>Participant</span></a>
          </li>

          <li class="nav-item {{ Request::is('winner*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('winner.index') }}"><i class="far fa-file-alt"></i> <span>Winner</span></a>
          </li>



          <li class="menu-header">Setting</li>

          <li class="nav-item {{ Request::is('user*') ? 'active' : '' }}">
            <a class="nav-link" href=""><i class="far fa-user"></i> <span>User</span></a>
          </li>
        @endif
        
      </ul>
  </aside>
