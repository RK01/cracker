@extends('layouts.app')
@section('content')
<section class="py-5" style="background:linear-gradient(135deg,#f8fbff 0%,#eef4ff 100%);min-height:calc(100vh - 70px);">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-lg p-4 p-md-5" style="border-radius:1.5rem;">
          <div class="text-center">
            <div class="success-badge"><i class="bi bi-check-lg"></i></div>
            <span class="badge bg-success-subtle text-success fw-semibold mb-2 px-3 py-2">Registration Successful</span>
            <h1 class="text-primary fw-bold mt-2">Welcome aboard, <span id="tyName">Student</span>! 🎉</h1>
            <p class="text-muted mb-0">You have successfully registered with <strong>Competitive Cracker</strong>.</p>
            <p class="text-muted">A confirmation has been sent to <strong id="tyEmail">your email</strong>.</p>
          </div>

          <!-- <div class="row g-3 mt-3 mb-4">
            <div class="col-md-4">
              <div class="text-center p-3 rounded-3 h-100" style="background:#fff7e0;">
                <i class="bi bi-mortarboard-fill text-warning" style="font-size:2rem;"></i>
                <h6 class="mt-2 mb-0 text-primary">Course</h6>
                <p class="small text-muted mb-0" id="tyCourse">—</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="text-center p-3 rounded-3 h-100" style="background:#e7f1ff;">
                <i class="bi bi-telephone-fill text-primary" style="font-size:2rem;"></i>
                <h6 class="mt-2 mb-0 text-primary">Phone</h6>
                <p class="small text-muted mb-0" id="tyPhone">—</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="text-center p-3 rounded-3 h-100" style="background:#e7fff1;">
                <i class="bi bi-geo-alt-fill text-success" style="font-size:2rem;"></i>
                <h6 class="mt-2 mb-0 text-primary">Location</h6>
                <p class="small text-muted mb-0" id="tyLoc">—</p>
              </div>
            </div>
          </div> -->

          <!-- <div class="cred-card">
            <h5 class="text-primary fw-bold text-center mb-3">
              <i class="bi bi-key-fill text-warning"></i> Your Login Credentials
            </h5>
            <div class="cred-row">
              <div><span class="cred-label"><i class="bi bi-person"></i> Username</span></div>
              <div class="d-flex align-items-center gap-2">
                <span class="cred-value" id="tyUser">-</span>
                <button class="copy-btn" onclick="ccCopy('tyUser', this)"><i class="bi bi-clipboard"></i> Copy</button>
              </div>
            </div>
            <div class="cred-row mb-0">
              <div><span class="cred-label"><i class="bi bi-shield-lock"></i> Password</span></div>
              <div class="d-flex align-items-center gap-2">
                <span class="cred-value" id="tyPass">-</span>
                <button class="copy-btn" onclick="ccCopy('tyPass', this)"><i class="bi bi-clipboard"></i> Copy</button>
              </div>
            </div>
            <p class="small text-center mb-0 mt-3 text-muted">
              <i class="bi bi-info-circle"></i> Save these credentials safely. You can change your password after first login.
            </p>
          </div> -->

          <div class="text-center mt-4">
            <h6 class="text-primary fw-bold">What happens next?</h6>
            <div class="row g-3 mt-2">
              <div class="col-md-4">
                <div class="p-2"><i class="bi bi-1-circle-fill text-warning fs-3"></i>
                  <p class="small mt-1 mb-0">Our counselor will call you within 24 hours.</p></div>
              </div>
              <div class="col-md-4">
                <div class="p-2"><i class="bi bi-2-circle-fill text-warning fs-3"></i>
                  <p class="small mt-1 mb-0">Login & explore your dashboard.</p></div>
              </div>
              <div class="col-md-4">
                <div class="p-2"><i class="bi bi-3-circle-fill text-warning fs-3"></i>
                  <p class="small mt-1 mb-0">Start your first class & material.</p></div>
              </div>
            </div>
          </div>

          <div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
            <a href="login.html" class="btn btn-primary px-4"><i class="bi bi-box-arrow-in-right"></i> Login Now</a>
            <a href="index.html" class="btn btn-warning px-4"><i class="bi bi-house-door"></i> Back to Home</a>
            <a href="contact.html" class="btn btn-outline-primary px-4"><i class="bi bi-headset"></i> Contact Support</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection