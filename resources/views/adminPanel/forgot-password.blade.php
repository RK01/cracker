<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
  <div class="container-xxl mt-4">
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
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">

        <!-- Forgot Password -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center text-center  my-4">
              <a href="index.html" class="app-brand-link gap-2">
                <img src="img/logo.png" alt="" class="app-brand-logo demo" />
              </a>
              <h4 class="my-2">Forgot Password? 🔒</h4>
              <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
            </div>
            <!-- /Logo -->

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
                <div class="text-center">
                  <a href="{{route('admin.login')}}" class="d-flex align-items-center justify-content-center">
                    <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                    Back to login
                  </a>
                </div>
          </div>
        </div>
        <!-- /Forgot Password -->
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
</body>

</html>