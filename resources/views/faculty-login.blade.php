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
                <div class="progress" style="height: 3px; background: rgba(255,255,255,0.2);">
                    <div id="toast-progress" class="progress-bar bg-white" style="width: 100%;"></div>
                </div>
            </div>
        @endif
    </div>
    
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="auth-card" style="border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
          <div class="row g-0">
            
            <!-- Left Side Panel (New Elegant Faculty Palette) -->
            <div class="col-md-5 d-none d-md-block">
              <!-- Yahan ek unique professional deep slate to dark emerald gradient use kiya hai -->
              <div class="auth-side h-100" style="background: linear-gradient(135deg, #1e293b 0%, #115e59 100%); padding: 40px 30px;">
                <h3 class="mb-3 text-white fw-bold">Faculty Workspace</h3>
                <p class="text-white-50 mb-4">Welcome back! Sign in to access your customized academic tools, track student outcomes, and manage classes.</p>
                
                <ul class="list-unstyled ready-faculty-list">
                  <li class="mb-3 text-white-50"><i class="bi bi-mortarboard text-info me-2 fs-5"></i> <strong class="text-white">Lectures:</strong> Live & scheduled sessions</li>
                  <li class="mb-3 text-white-50"><i class="bi bi-folder-plus text-info me-2 fs-5"></i> <strong class="text-white">Resources:</strong> Upload notes & handouts</li>
                  <li class="mb-3 text-white-50"><i class="bi bi-file-earmark-check text-info me-2 fs-5"></i> <strong class="text-white">Evaluations:</strong> Tests, quizzes & grading</li>
                  <li class="mb-3 text-white-50"><i class="bi bi-lightning text-info me-2 fs-5"></i> <strong class="text-white">Insights:</strong> Batch performance metrics</li>
                  <li class="mb-3 text-white-50"><i class="bi bi-chat-left-dots text-info me-2 fs-5"></i> <strong class="text-white">Mentorship:</strong> Resolve student queries</li>
                </ul>
                
                <div class="mt-5 pt-3 border-top border-light border-opacity-10">
                  <p class="small mb-2 text-white-50">Account access recovery:</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('forgot-password') }}" class="btn btn-outline-light btn-sm px-3 fw-semibold" style="border-color: rgba(255,255,255,0.3);">Reset Password</a>
                    <span class="badge bg-dark bg-opacity-20 text-info px-2 py-1 small fw-normal">Educator Portal</span>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Right Side Form (Clean, Modern Inputs with Matching Accents) -->
            <div class="col-md-7">
              <div class="auth-form" style="padding: 45px 40px;">
                <div class="text-center mb-4">
                  <!-- Custom color for the circle avatar indicator -->
                  <div class="auth-icon-circle mb-2" style="background-color: #f0fdfa; color: #0d9488; border: 1px solid #ccfbf1;"><i class="bi bi-person-workspace"></i></div>
                  <h2 class="fw-bold" style="color: #0f172a;">Faculty Login</h2>
                  <p class="text-muted small">Enter your authorized credentials below</p>
                </div>
                
                <div id="loginMsg"></div>
                @if(session('error'))
                  <div class="alert alert-danger py-2 small">{{ session('error') }}</div>
                @endif
                
                <form id="loginForm" action="{{ route('login.submit') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Official Email / Username</label>
                    <div class="input-group">
                      <span class="input-group-text" style="background-color: #f8fafc; border-right: none; color: #64748b;"><i class="bi bi-envelope"></i></span>
                      <input name="login" id="loginUser" type="text" class="form-control" placeholder="name@institution.com" style="border-left: none; background-color: #f8fafc;" required>
                      <input type="hidden" name="role" value="faculty_login">
                    </div>
                  </div>
                  
                  <div class="mb-2">
                    <label class="form-label fw-semibold small text-dark">Password</label>
                    <div class="input-group">
                      <span class="input-group-text" style="background-color: #f8fafc; border-right: none; color: #64748b;"><i class="bi bi-lock"></i></span>
                      <input name="password" id="loginPass" type="password" class="form-control" placeholder="••••••••" style="border-left: none; border-right: none; background-color: #f8fafc;" required>
                      <button type="button" class="toggle-pw px-3" onclick="togglePw('loginPass', this)" style="background-color: #f8fafc; border: 1px solid #ced4da; border-left: none; color: #64748b;"><i class="bi bi-eye"></i></button>
                    </div>
                  </div>
                  
                  <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" style="cursor: pointer;">
                      <label class="form-check-label small text-muted" for="remember" style="cursor: pointer; user-select: none;">Keep me logged in</label>
                    </div>
                  </div>
                  
                  @error('login')
                    <span class="text-danger small text-center d-block mb-3 fw-medium">{{ $message }}</span>
                  @enderror
                  
                  <!-- Custom Styled Premium Button to completely match the fresh tone -->
                  <button class="btn w-100 py-2.5 fw-bold text-white transition-all shadow-sm" type="submit" id="loginBtn" style="background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%); border: none; border-radius: 6px;">
                    <span id="btnText"><i class="bi bi-shield-check me-2"></i> Access Dashboard</span>
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