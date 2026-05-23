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
                <h3 class="mb-3">Create a Strong Password</h3>
                <p class="opacity-75 mb-4">Choose a password that's both strong and memorable. Your account security matters.</p>
                <ul>
                  <li><i class="bi bi-check2-circle"></i> Minimum 8 characters</li>
                  <li><i class="bi bi-check2-circle"></i> One uppercase & one lowercase</li>
                  <li><i class="bi bi-check2-circle"></i> At least one number</li>
                  <li><i class="bi bi-check2-circle"></i> One special character (recommended)</li>
                  <li><i class="bi bi-shield-lock-fill"></i> Stored securely & encrypted</li>
                </ul>
              </div>
            </div>
            <div class="col-md-7">
              <div class="auth-form">
                <div class="text-center mb-4">
                  <div class="auth-icon-circle"><i class="bi bi-shield-lock"></i></div>
                  <h2>Create Password</h2>
                  <p class="text-muted small">Set up a new password for your account</p>
                </div>
                <div id="cpMsg"></div>
                <form onsubmit="return doCreatePw(event)">
                  <div class="mb-3">
                    <label class="form-label fw-semibold small">New Password</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-lock"></i></span>
                      <input id="newPw" type="password" class="form-control" placeholder="Enter new password" required autocomplete="new-password">
                      <button type="button" class="toggle-pw" onclick="togglePw('newPw', this)" aria-label="Show password"><i class="bi bi-eye"></i></button>
                    </div>
                    <div id="pwBar" class="pw-strength"><div></div></div>
                    <div id="pwHint" class="pw-hint mt-1">
                      <span data-c="len">8+ chars</span>
                      <span data-c="up">Uppercase</span>
                      <span data-c="lo">Lowercase</span>
                      <span data-c="num">Number</span>
                      <span data-c="sym">Symbol</span>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-semibold small">Confirm Password</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                      <input id="newPw2" type="password" class="form-control" placeholder="Re-enter new password" required autocomplete="new-password">
                      <button type="button" class="toggle-pw" onclick="togglePw('newPw2', this)" aria-label="Show password"><i class="bi bi-eye"></i></button>
                    </div>
                  </div>
                  <button class="btn btn-auth" type="submit"><i class="bi bi-check2-circle"></i> Update Password</button>
                  <p class="text-center small text-muted mt-4 mb-0">Remembered your password? <a href="login.html" class="fw-semibold text-decoration-none" style="color:#0d2c5a;">Sign in</a></p>
                </form>
                <script>document.addEventListener('DOMContentLoaded',function(){bindPwStrength('newPw','pwBar','pwHint');});</script>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection