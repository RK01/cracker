@extends('layouts.app')
@section('content')
  <section class="page-hero text-white text-center py-5">
    <div class="container py-4">
      <span class="badge bg-warning text-dark mb-3">NEET</span>
      <h1 class="display-4 fw-bold">One Year Integrated Course for NEET</h1>
      <p class="lead opacity-75">Intensive 1-year crash course for NEET</p>
    </div>
  </section>

  <section class="section-padding course-ca-foundation">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-8">
          <img src="assets/img/course-neet-1year.jpg" class="img-fluid rounded-4 shadow mb-4"
            alt="One Year Integrated Course for NEET">
             <div class="card mb-3">
              <div class="card-body">
                <h3 class="text-primary">About this Course</h3>
                <p class="lead">A focused, fast-paced 1-year program for Class 12 students and droppers preparing for NEET.
                  Covers complete syllabus with intense revision cycles.</p>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-body">
                <h4 class="text-primary my-4">Key Highlights</h4>
                <ul class="list-unstyled ps-2">
                  <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Complete syllabus coverage in 8
              months</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>4 months dedicated revision & test
              series</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>30+ full-length mock tests</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>1:1 mentorship for droppers</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Stress-management sessions</li>
                </ul>
              </div>
            </div>
         
            <div class="card mt-2">
              <div class="card-body custom-body-card">
                <h4 class="text-primary my-4"><i class="bi bi-book text-primary me-2"></i> Syllabus Coverage</h4>
                <ul class="list-unstyled ps-2">
                  <li class="mb-2"><span class="">1</span> Rapid Biology revision — NCERT focused</li>
                  <li class="mb-2"><span class="">2</span> Physics speed-solving techniques</li>
                  <li class="mb-2"><span class="">3</span> Chemistry NCERT + key reactions</li>
                  <li class="mb-2"><span class="">4</span> Test analysis & strategy</li>
                </ul>
                <h4 class="text-primary my-4">What You Get</h4>
                <div>
                  <span class="badge bg-warning text-dark me-2 mb-2 p-2">Fast-Track 1 Year</span>
                  <span class="badge bg-warning text-dark me-2 mb-2 p-2">30+ Mock Tests</span>
                  <span class="badge bg-warning text-dark me-2 mb-2 p-2">Dropper Friendly</span>
                  <span class="badge bg-warning text-dark me-2 mb-2 p-2">Personal Mentor</span>
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
                <div class="info-value">1 Year</div>
              </div>
            </div>

            <!-- Batch Size -->
            <div class="info-item">
              <i class="bi bi-people info-icon"></i>
              <div>
                <div class="info-label">Batch Size</div>
                <div class="info-value">30 students/batch</div>
              </div>
            </div>

            <!-- Course Fee -->
            <div class="info-item">
              <i class="bi bi-currency-rupee info-icon"></i>
              <div>
                <div class="info-label">Course Fee</div>
                <div class="info-value">₹78,000/year</div>
              </div>
            </div>

            <!-- Includes -->
            <div class="includes-title">INCLUDES</div>

            <div class="include-item">
              <i class="bi bi-check-circle"></i> Fast-Track 1 Year
            </div>
            <div class="include-item">
              <i class="bi bi-check-circle"></i> 30+ Mock Tests
            </div>
            <div class="include-item">
              <i class="bi bi-check-circle"></i> Dropper Friendly
            </div>
            <div class="include-item">
              <i class="bi bi-check-circle"></i> Personal Mentor
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