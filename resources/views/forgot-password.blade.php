@extends('layouts.app')
@section('content')
<section class="auth-wrapper">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="auth-card">
          <div class="row g-0">
            <div class="col-md-5 d-none d-md-block">
              <div class="auth-side h-100">
                <h3 class="mb-3">Forgot Password?</h3>
                <p class="opacity-75 mb-4">No worries — it happens. Enter your registered email and we'll send you a secure reset link.</p>
                <ul>
                  <li><i class="bi bi-shield-check"></i> Secure password reset</li>
                  <li><i class="bi bi-envelope-check"></i> Email verification</li>
                  <li><i class="bi bi-clock-history"></i> Link valid for 30 minutes</li>
                  <li><i class="bi bi-lock-fill"></i> Encrypted & protected</li>
                </ul>
                <div class="mt-4 pt-3 border-top border-light border-opacity-25">
                  <p class="small mb-1 opacity-75">Remembered it?</p>
                  <a href="{{ route('login') }}" class="btn btn-warning btn-sm fw-bold">Back to Login</a>
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <div class="auth-form">
                <div class="text-center mb-4">
                  <div class="auth-icon-circle"><i class="bi bi-key-fill"></i></div>
                  <h2>Reset Password</h2>
                  <p class="text-muted small">We'll email you a link to create a new password</p>
                </div>
                <div id="fpMsg" class="alert d-none"></div>
                <form id="forgotPasswordForm" method="POST" action="{{ route('forgot-password.update-password') }}">
                  @csrf
                  <div class="mb-3">
                    <label class="form-label fw-semibold small">Registered Email Address</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                      <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="you@example.com" required autocomplete="email">
                    </div>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-muted">Enter the email you used during registration.</small>
                  </div>
                  <div id="passwordFields" style="display: none;">
                    <div class="mb-3">
                      <label for="password" class="form-label">New Password</label>
                      <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                      @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                      <label for="password_confirmation" class="form-label">Confirm Password</label>
                      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                      @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <button class="btn btn-auth" type="submit"><i class="bi bi-send"></i> Submit</button>
                  <div class="auth-divider"><span>or</span></div>
                  <div class="d-flex justify-content-between">
                    <a href="{{ route('login') }}" class="small text-decoration-none fw-semibold" style="color:#0d2c5a;"><i class="bi bi-arrow-left"></i> Back to Login</a>
                    <a href="{{ route('register') }}" class="small text-decoration-none fw-semibold" style="color:#0d2c5a;">Create new account <i class="bi bi-arrow-right"></i></a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
    document.getElementById('email').addEventListener('blur', function () {
        const email = this.value;
        fetch('{{ route('forgot-password.check-email') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email })
        })
        .then(response => response.json())
        .then(data => {
            const fpMsg = document.getElementById('fpMsg');
            if (data.status === 'success') {
                document.getElementById('passwordFields').style.display = 'block';
                fpMsg.className = 'alert alert-success';
                fpMsg.textContent = data.message;
                fpMsg.classList.remove('d-none');
            } else {
                fpMsg.className = 'alert alert-danger';
                fpMsg.textContent = data.message;
                fpMsg.classList.remove('d-none');
                document.getElementById('passwordFields').style.display = 'none';
            }
        });
    });
</script>
@endsection