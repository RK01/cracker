@extends('layouts.app')
@section('content')

  <section class="page-hero text-white text-center py-5">
    <div class="container py-4">
      <span class="badge bg-warning text-dark mb-3">CA</span>
      <h1 class="display-4 fw-bold">CA Foundation</h1>
      <p class="lead opacity-75">Begin your Chartered Accountancy journey</p>
    </div>
  </section>

  <section class="section-padding course-ca-foundation">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-8">
          <img src="{{ asset('assets/img/course-ca.jpg')}}" class="img-fluid rounded-4 shadow mb-4" alt="CA Foundation">
          
          <div class="card mb-3">
            <div class="card-body">
              <h3 class="text-primary">About this Course</h3>
              <p class="lead">Our CA Foundation course is built around the ICAI syllabus and prepares students for all four
                papers.</p>
            </div>
          </div>

          <div class="card mb-3">
            <div class="card-body">
              <h4 class="text-primary my-4">Key Highlights</h4>
              <ul class="list-unstyled ps-2">
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>ICAI syllabus aligned</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>All 4 subjects — expert
                  faculty
                </li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Mock exams matching ICAI
                  pattern
                </li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Concept videos for revision
                </li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>MCQ practice</li>
              </ul>
            </div>
          </div>

          <div class="card mt-2">
            <div class="card-body custom-body-card">
              <h4 class="text-primary my-4"><i class="bi bi-book text-primary me-2"></i> Syllabus Coverage</h4>
              <ul class="list-unstyled ps-2">
                <li class="mb-2"><span class="">1</span> Paper 1: Principles & Practice of Accounting</li>
                <li class="mb-2"><span class="">2</span> Paper 2: Business Laws & Correspondence</li>
                <li class="mb-2"><span class="">3</span> Paper 3: Business Maths, Reasoning & Stats</li>
                <li class="mb-2"><span class="">4</span> Paper 4: Business Economics & BCK</li>
              </ul>
              <h4 class="text-primary my-4">What You Get</h4>
              <div>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">ICAI Aligned</span><span
                  class="badge bg-warning text-dark me-2 mb-2 p-2">All 4 Papers</span><span
                  class="badge bg-warning text-dark me-2 mb-2 p-2">Mock Tests</span><span
                  class="badge bg-warning text-dark me-2 mb-2 p-2">CA Faculty</span>
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
                  <div class="info-value">6 Months</div>
                </div>
              </div>

              <!-- Batch Size -->
              <div class="info-item">
                <i class="bi bi-people info-icon"></i>
                <div>
                  <div class="info-label">Batch Size</div>
                  <div class="info-value">40 students/batch</div>
                </div>
              </div>

              <!-- Course Fee -->
              <div class="info-item">
                <i class="bi bi-currency-rupee info-icon"></i>
                <div>
                  <div class="info-label">Course Fee</div>
                  <div class="info-value">₹45,000</div>
                </div>
              </div>

              <!-- Includes -->
              <div class="includes-title">INCLUDES</div>

              <div class="include-item">
                <i class="bi bi-check-circle"></i> ICAI Aligned
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> All 4 Papers
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> Mock Tests
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> CA Faculty
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