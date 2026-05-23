<!-- resources/views/partials/header.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm top-navebar">
  <div class="container">
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
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">About</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('about') }}">About Us</a></li>
            <li><a class="dropdown-item" href="{{ route('vision.mission') }}">Vision & Mission</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Courses</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('courses.jee') }}">IIT JEE</a></li>
            <li><a class="dropdown-item" href="{{ route('courses.neet') }}">NEET</a></li>
            <li><a class="dropdown-item" href="{{ route('courses.ca') }}">CA Foundation</a></li>
            <li><a class="dropdown-item" href="{{ route('courses.clat') }}">CLAT</a></li>
            <li><a class="dropdown-item" href="{{ route('courses.cuet') }}">CUET</a></li>
            <li><a class="dropdown-item" href="{{ route('courses.dropper') }}">12th Dropper</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{ route('academic') }}">Academic Classes</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('olympiad') }}">Olympiad</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('faculty') }}">Faculty</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admissions') }}">Admissions</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('gallery') }}">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>

        @if(Auth::check())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
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