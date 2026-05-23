@extends('layouts.app')
@section('content')
  <section class="page-hero text-white text-center py-5">
    <div class="container py-4">
      <span class="badge bg-warning text-dark mb-3">Dropper</span>
      <h1 class="display-4 fw-bold">12th Dropper Batch</h1>
      <p class="lead opacity-75">Second chance — focused, intensive coaching</p>
    </div>
  </section>


  <section class="section-padding course-ca-foundation">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-8">
          <img src="{{ asset('assets/img/course-dropper.jpg')}}" class="img-fluid rounded-4 shadow mb-4" alt="12th Dropper Batch">
          
          <div class="card mb-3">
            <div class="card-body">
              <h3 class="text-primary">About this Course</h3>
              <p class="lead">Our dropper batch is exclusively for students who've completed Class 12 and want a focused
            year of preparation for JEE/NEET.</p>
            </div>
          </div>
          
          <div class="card mb-3">
            <div class="card-body">
              <h4 class="text-primary my-4">Key Highlights</h4>
              <ul class="list-unstyled ps-2">
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Exclusively for droppers</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Complete syllabus revision in 6 months</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>6 months of test series</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Psychological counseling</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Hostel facility available</li>
              </ul>
            </div>
          </div>
          <div class="card mt-2">
            <div class="card-body custom-body-card">
              <h4 class="text-primary my-4"><i class="bi bi-book text-primary me-2"></i> Syllabus Coverage</h4>
              <ul class="list-unstyled ps-2">
                <li class="mb-2"><span class="">1</span> Choose track: JEE / NEET</li>
                <li class="mb-2"><span class="">2</span> Full syllabus revision</li>
                <li class="mb-2"><span class="">3</span> Daily DPPs + weekly tests</li>
                <li class="mb-2"><span class="">4</span> Performance analytics</li>
              </ul>
              <h4 class="text-primary my-4">What You Get</h4>
              <div>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">Dropper Only</span>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">JEE or NEET</span>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">Hostel Available</span>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">Counseling Included</span>
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
                  <div class="info-value">25 students/batch</div>
                </div>
              </div>

              <!-- Course Fee -->
              <div class="info-item">
                <i class="bi bi-currency-rupee info-icon"></i>
                <div>
                  <div class="info-label">Course Fee</div>
                  <div class="info-value">₹90,000</div>
                </div>
              </div>

              <!-- Includes -->
              <div class="includes-title">INCLUDES</div>

              <div class="include-item">
                <i class="bi bi-check-circle"></i> Dropper Only
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> JEE or NEET
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> Hostel Available
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> Counseling Included
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