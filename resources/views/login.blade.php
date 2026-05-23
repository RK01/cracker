@extends('layouts.app')
@section('content')
<section class="auth-wrapper">
  <div class="container">
    <!-- Notification Container -->
    <div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 99999;">
        @if(session('success') || session('error') || $errors->any())
            <div id="auto-hide-alert" class="toast show align-items-center text-white border-0 shadow-lg {{ session('success') ? 'bg-success' : 'bg-danger' }}" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <div class="d-flex align-items-center">
                            <i class="fas {{ session('success') ? 'fa-check-circle' : 'fa-exclamation-circle' }} me-2 fs-5"></i>
                            <div>
                                @if(session('success'))
                                    {{ session('success') }}
                                @elseif(session('error'))
                                    {{ session('error') }}
                                @else
                                    <ul class="mb-0 list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <!-- Progress Bar Timer (Optional but Modern) -->
                <div class="progress" style="height: 3px; background: rgba(255,255,255,0.2);">
                    <div id="toast-progress" class="progress-bar bg-white" style="width: 100%;"></div>
                </div>
            </div>
        @endif
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="auth-card">
          <div class="row g-0">
            <div class="col-md-5 d-none d-md-block">
              <div class="auth-side h-100">
                <h3 class="mb-3">Welcome Back!</h3>
                <p class="opacity-75 mb-4">Continue your journey to crack every competition. Your dashboard awaits.</p>
                <ul>
                  <li><i class="bi bi-play-circle-fill"></i> Live & recorded classes</li>
                  <li><i class="bi bi-file-earmark-pdf-fill"></i> Notes & study material</li>
                  <li><i class="bi bi-clipboard-check-fill"></i> Online tests & quizzes</li>
                  <li><i class="bi bi-bar-chart-fill"></i> Performance analytics</li>
                  <li><i class="bi bi-chat-dots-fill"></i> Doubt-solving with faculty</li>
                </ul>
                <div class="mt-4 pt-3 border-top border-light border-opacity-25">
                  <p class="small mb-1 opacity-75">New here?</p>
                  <div class="d-flex justify-content-between">
                    <a href="{{ route('register') }}" class="btn btn-info btn-sm fw-bold">Create an Account</a>
                    <a href="{{ route('forgot-password') }}" class="btn btn-warning btn-sm fw-bold">Forgot Password</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <div class="auth-form">
                <div class="text-center mb-4">
                  <div class="auth-icon-circle"><i class="bi bi-person-circle"></i></div>
                  <h2>Student Login</h2>
                  <p class="text-muted small">Sign in to access your courses & dashboard</p>
                </div>
                <div id="loginMsg"></div>
                @if(session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <form id="loginForm" action="{{ route('login.submit') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label class="form-label fw-semibold small">Username or Email</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-person"></i></span>
                      <!-- Name attribute add kiya: 'login' -->
                      <input name="login" id="loginUser" type="text" class="form-control" placeholder="Enter username or email" required>
                      <input type="hidden" name="role" value="student_faculty_login">
                    </div>
                  </div>
                  <div class="mb-2">
                    <label class="form-label fw-semibold small">Password</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-lock"></i></span>
                      <!-- Name attribute add kiya: 'password' -->
                      <input name="password" id="loginPass" type="password" class="form-control" placeholder="Enter password" required>
                      <button type="button" class="toggle-pw" onclick="togglePw('loginPass', this)"><i class="bi bi-eye"></i></button>
                    </div>
                  </div>
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label small" for="remember">Remember me</label>
                  </div>
                  @error('login')
                    <span class="text-danger small text-center">{{ $message }}</span>
                  @enderror
                  <button class="btn btn-auth" type="submit" id="loginBtn">
                    <span id="btnText"><i class="bi bi-box-arrow-in-right"></i> Sign In</span>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection