@extends('layouts.app')
@section('content')
<section class="page-hero text-white text-center py-5">
  <div class="container py-4">
    <span class="badge bg-warning text-dark mb-3">Register</span>
    <h1 class="display-4 fw-bold">Student Registration</h1>
    <p class="lead opacity-75">Join Competitive Cracker — start your journey today</p>
  </div>
</section>

<section class="section-padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-lg border-0 p-4 p-md-5">
          <form id="registerForm" accept="{{route('register.store')}}" method="POST">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Full Name *</label>
                <input name="name" class="form-control" value="{{ old('name') }}" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Phone Number *</label>
                <input name="phone" type="tel" pattern="[0-9]{10}" maxlength="10" class="form-control" value="{{ old('phone') }}" required>
                <small class="text-muted">10-digit mobile number</small>
              </div>

              <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input name="email" type="email" class="form-control" value="{{ old('email') }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Course Interest *</label>
                <select name="course_id" class="form-select" required>
                  <option value="">Select course</option>
                  @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">State *</label>
                <select id="state" name="state" class="form-select" required>
                  <option value="">Select state</option>
                  @foreach($states as $stateId => $stateName)
                    <option value="{{ $stateId }}">{{ $stateName }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">City *</label>
                <select id="city" name="city" class="form-select" required>
                  <option value="">Select city</option>
                </select>
              </div>

              <div class="col-12">
                <label class="form-label">CAPTCHA *</label>
                <div class="d-flex align-items-center gap-3 flex-wrap">
                   <span class="captcha-box" id="captchaText"
                    style="background:#eee; padding:10px; font-weight:bold; letter-spacing:5px;">
                    {{ $captcha }}
                  </span>
                  <button type="button" id="refreshCaptcha" class="btn btn-outline-primary btn-sm"><i class="bi bi-arrow-clockwise"></i></button>
                 
                  <input id="captchaInput" name="captcha" class="form-control" style="max-width:220px" placeholder="Enter CAPTCHA" required>
                </div>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-warning btn-lg w-100">Register Now</button>
                <p class="small text-muted text-center mt-3">By registering, you agree to receive updates. Username and password will be displayed on the next page.</p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  window.STATES_CITIES = @json($cities);

  document.addEventListener('DOMContentLoaded', function() {
    const stateSelect = document.getElementById('state');
    const citySelect = document.getElementById('city');

    stateSelect.addEventListener('change', function() {

        const stateId = this.value;

        citySelect.innerHTML = '<option value="">Select city</option>';

        if (!stateId) return;

        const cities = window.STATES_CITIES[stateId] || [];

        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city.city_id;
            option.textContent = city.city_name;
            citySelect.appendChild(option);
        });
    });
    // Captcha generator
    document.getElementById('refreshCaptcha').addEventListener('click', function() {
        fetch('{{ route("captcha.refresh") }}')
            .then(r => r.json())
            .then(data => {
                document.getElementById('captchaText').textContent = data.captcha;
            });
    });

  
    // Is event listener ko script ke end mein add karein taaki check ho sake
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      const userInput = document.getElementById('captchaInput').value;
      const actualCaptcha = document.getElementById('generatedCaptchaInput').value;

      if (userInput !== actualCaptcha) {
        e.preventDefault(); // Form submit hone se rok dega
        alert('Invalid CAPTCHA! Please try again.');
        return false;
      }
    });

  });

</script>
@endsection