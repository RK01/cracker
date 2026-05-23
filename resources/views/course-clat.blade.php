@extends('layouts.app')
@section('content')

<section class="page-hero text-white text-center py-5">
  <div class="container py-4">
    <span class="badge bg-warning text-dark mb-3">Law</span>
    <h1 class="display-4 fw-bold">CLAT Exam Preparation</h1>
    <p class="lead opacity-75">Your path to top National Law Universities</p>
  </div>
</section>

<section class="section-padding course-ca-foundation">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-8">
        <img src="{{ asset('assets/img/course-clat.jpg')}}" class="img-fluid rounded-4 shadow mb-4" alt="CLAT Exam Preparation">

        <div class="card mb-3">
          <div class="card-body">
            <h3 class="text-primary">About this Course</h3>
            <p class="lead">
              Our CLAT program covers all five sections — English, Current Affairs, Legal Reasoning, Logical
              Reasoning, and Quantitative Techniques.
            </p>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-body">
            <h4 class="text-primary my-4">Key Highlights</h4>
            <ul class="list-unstyled ps-2">
              <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>5-section comprehensive
                coverage
              </li>
              <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Daily current affairs sessions
              </li>
              <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Legal aptitude masterclasses
              </li>
              <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>30+ full-length CLAT mocks
              </li>
              <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>RC speed-reading workshops
              </li>
            </ul>
          </div>
        </div>

        <div class="card mt-2">
          <div class="card-body custom-body-card">
            <h4 class="text-primary my-4"><i class="bi bi-book text-primary me-2"></i> Syllabus Coverage</h4>
            <ul class="list-unstyled ps-2">
              <li class="mb-2"><span class="">1</span> English Language & Comprehension</li>
              <li class="mb-2"><span class="">2</span> Current Affairs & GK</li>
              <li class="mb-2"><span class="">3</span> Legal Reasoning</li>
              <li class="mb-2"><span class="">4</span> Logical Reasoning</li>
              <li class="mb-2"><span class="">5</span> Quantitative Techniques</li>
            </ul>
            <h4 class="text-primary my-4">What You Get</h4>
            <div>
              <span class="badge bg-warning text-dark me-2 mb-2 p-2">All 5 Sections</span>
              <span class="badge bg-warning text-dark me-2 mb-2 p-2">Daily Current Affairs</span>
              <span class="badge bg-warning text-dark me-2 mb-2 p-2">30+ Mocks</span>
              <span class="badge bg-warning text-dark me-2 mb-2 p-2">NLU Mentors</span>
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
                <div class="info-value">₹65,000</div>
              </div>
            </div>

            <!-- Includes -->
            <div class="includes-title">INCLUDES</div>

            <div class="include-item">
              <i class="bi bi-check-circle"></i> All 5 Sections
            </div>
            <div class="include-item">
              <i class="bi bi-check-circle"></i> Daily Current Affairs
            </div>
            <div class="include-item">
              <i class="bi bi-check-circle"></i> 30+ Mocks
            </div>
            <div class="include-item">
              <i class="bi bi-check-circle"></i> NLU Mentors
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