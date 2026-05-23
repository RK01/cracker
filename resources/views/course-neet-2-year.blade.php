@extends('layouts.app')
@section('content')

  <section class="page-hero text-white text-center py-5">
    <div class="container py-4">
      <span class="badge bg-warning text-dark mb-3">NEET</span>
      <h1 class="display-4 fw-bold">Two Year Integrated Course for NEET</h1>
      <p class="lead opacity-75">Comprehensive 2-year program for medical aspirants</p>
    </div>
  </section>

  <section class="section-padding course-ca-foundation">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-8">
          <img src="assets/img/course-neet-2year.jpg" class="img-fluid rounded-4 shadow mb-4"
            alt="Two Year Integrated Course for NEET">
          <div class="card mb-3">
            <div class="card-body">
              <h3 class="text-primary">About this Course</h3>
              <p class="lead">Our 2-year NEET program starts from Class 11 and provides complete coverage of Physics,
                Chemistry, and Biology with NCERT focus.
              </p>
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-body">
              <h4 class="text-primary my-4">Key Highlights</h4>
              <ul class="list-unstyled ps-2">
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>NCERT-focused syllabus mastery</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Daily Biology, Physics & Chemistry classes</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Weekly NEET-pattern tests</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>AIIMS & JIPMER pattern practice</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Line-by-line NCERT revision</li>
              </ul>
            </div>
          </div>
          
          <div class="card mt-2">
            <div class="card-body custom-body-card">
              <h4 class="text-primary my-4"><i class="bi bi-book text-primary me-2"></i> Syllabus Coverage</h4>
              <ul class="list-unstyled ps-2">
                <li class="mb-2"><span class="">1</span> Biology: Botany & Zoology — full NCERT</li>
                <li class="mb-2"><span class="">2</span> Physics: Mechanics, Thermal, Optics, Modern</li>
                <li class="mb-2"><span class="">3</span> Chemistry: Physical, Inorganic, Organic</li>
                <li class="mb-2"><span class="">4</span> Practice: 25 years' NEET PYQs</li>
              </ul>
              <h4 class="text-primary my-4">What You Get</h4>
              <div>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">2-Year Integrated</span>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">NCERT Mastery</span>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">AIIMS Practice</span>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">Daily Doubt Sessions</span>
              </div>
            </div>
          </div>
          
        </div>
        <div class="col-lg-4">
          <div class="card shadow-sm border-0 sticky-top course-card" style="top:90px;">
            <div class="card-body">

              <div class="course-title">Course Details</div>

              <!-- Duration -->
              <div class="info-item">
                <i class="bi bi-clock info-icon"></i>
                <div>
                  <div class="info-label">Duration</div>
                  <div class="info-value">2 Year</div>
                </div>
              </div>

              <!-- Batch Size -->
              <div class="info-item">
                <i class="bi bi-people info-icon"></i>
                <div>
                  <div class="info-label">Batch Size</div>
                  <div class="info-value">35 students/batch</div>
                </div>
              </div>

              <!-- Course Fee -->
              <div class="info-item">
                <i class="bi bi-currency-rupee info-icon"></i>
                <div>
                  <div class="info-label">Course Fee</div>
                  <div class="info-value">₹95,000</div>
                </div>
              </div>

              <!-- Includes -->
              <div class="includes-title">INCLUDES</div>

              <div class="include-item">
                <i class="bi bi-check-circle"></i> 2-Year Integrated
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> NCERT Mastery
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> AIIMS Practice
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> Doubt Sessions Daily
              </div>

              <!-- Buttons -->
              <button class="btn btn-enroll w-100">
                <i class="bi bi-arrow-right"></i> Enroll Now
              </button>

              <button class="btn btn-buy w-100">
                <i class="bi bi-cart"></i> Buy Now
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Footer -->
@endsection