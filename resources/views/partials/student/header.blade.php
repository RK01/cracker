<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm top-navebar">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" width="45" height="45" style="object-fit:contain">
        <div>
            <span class="fw-bold fs-5 text-white d-block" style="line-height:1.1">Competition</span>
            <small class="fw-bold" style="color:var(--accent);font-size:.75rem">CRACKER</small>
        </div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        @if(Auth::check())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
            <i class="bi bi-person-circle"></i> {{ ucwords(Auth::user()->name) }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('student.profile') }}">Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
          </ul>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        @else
        <li class="nav-item ms-lg-2">
          <a class="btn btn-outline-warning fw-bold me-2 text-nowrap" href="{{ route('login') }}">
            <i class="bi bi-box-arrow-in-right"></i> Login
          </a>
        </li>
        <li class="nav-item">
          <a class="btn btn-warning fw-bold" href="{{ route('register') }}">Register</a>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>