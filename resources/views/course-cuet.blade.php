@extends('layouts.app')
@section('content')
  <section class="page-hero text-white text-center py-5">
    <div class="container py-4">
      <span class="badge bg-warning text-dark mb-3">University Entrance</span>
      <h1 class="display-4 fw-bold">CUET Exam Preparation</h1>
      <p class="lead opacity-75">Crack CUET for top central universities</p>
    </div>
  </section>

  <section class="section-padding course-ca-foundation">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-8">
          <img src="{{ asset('assets/img/course-cuet.jpg')}}" class="img-fluid rounded-4 shadow mb-4" alt="CUET Exam Preparation">

          <div class="card mb-3">
            <div class="card-body">
              <h3 class="text-primary">About this Course</h3>
              <p class="lead">
                Our CUET program covers Section 1 (Languages), Section 2 (Domain subjects), and Section 3 (General
                Test).
              </p>
            </div>
          </div>


          <div class="card mb-3">
            <div class="card-body">
              <h4 class="text-primary my-4">Key Highlights</h4>
              <ul class="list-unstyled ps-2">
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>All 3 sections of CUET</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Choose any 6 domain subjects
                </li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>General Test mastery</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Mock tests in CBT format</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>University-specific guidance
                </li>
              </ul>
            </div>
          </div>


          <div class="card mt-2">
            <div class="card-body custom-body-card">
              <h4 class="text-primary my-4"><i class="bi bi-book text-primary me-2"></i> Syllabus Coverage</h4>
              <ul class="list-unstyled ps-2">
                <li class="mb-2"><span class="">1</span> Section 1A: Language</li>
                <li class="mb-2"><span class="">2</span> Section 2: Domain subjects</li>
                <li class="mb-2"><span class="">3</span> Section 3: General Test</li>
                <li class="mb-2"><span class="">4</span> CBT mock tests</li>
              </ul>
              <h4 class="text-primary my-4">What You Get</h4>
              <div>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">All Sections</span>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">CBT Practice</span>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">Domain Choice</span>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">University Counseling</span>
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
                  <div class="info-value">6–12 Months</div>
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
                  <div class="info-value">₹40,000</div>
                </div>
              </div>

              <!-- Includes -->
              <div class="includes-title">INCLUDES</div>

              <div class="include-item">
                <i class="bi bi-check-circle"></i> All Sections
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> CBT Practice
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> Domain Choice
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> University Counseling
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
@endsection