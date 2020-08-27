<header class="c-header c-header-light c-header-fixed">
  <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
    <i class="fas fa-align-justify"></i>
  </button>
  <a class="c-header-brand d-lg-none c-header-brand-sm-up-center" href="{{ route('dashboard') }}">
    <img src="{{ asset('img/logo.png') }}" class="c-sidebar-brand-full">
  </a>
  <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
    <i class="fas fa-align-justify"></i>
  </button>
  

  <ul class="c-header-nav d-md-down-none">
    <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
  </ul>

  <ul class="c-header-nav mfs-auto">
  </ul>

  <ul class="c-header-nav">
    <li class="c-header-nav-item dropdown">
      <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <div class="c-avatar"><img class="c-avatar-img" src="{{ asset('img/avatar.png') }}" alt="user-image"></div>
      </a>
      <div class="dropdown-menu dropdown-menu-right pt-0">
        <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
        <a class="dropdown-item" href="#">
          <i class="fas fa-envelope mr-2"></i> Messages<span class="badge badge-success mfs-auto">42</span>
        </a>
        <a class="dropdown-item" href="#">
          <i class="fas fa-tasks mr-2"></i> Tasks<span class="badge badge-danger mfs-auto">42</span>
        </a>
        
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" onClick="$('#logoutForm').submit()">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
        {!! Form::open(['route' => 'logout', 'id' => 'logoutForm']) !!}
        {!! Form::close() !!}
      </div>
    </li>
  </ul>

</header>