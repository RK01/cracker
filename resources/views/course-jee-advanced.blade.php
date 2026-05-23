@extends('layouts.app')
@section('content')
<section class="page-hero text-white text-center py-5">
  <div class="container py-4">
    <span class="badge bg-warning text-dark mb-3">IIT JEE</span>
    <h1 class="display-4 fw-bold">JEE Advanced</h1>
    <p class="lead opacity-75">Your gateway to IIT — train with the best</p>
  </div>
</section>

    <section class="section-padding course-ca-foundation">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-8">
            <img src="assets/img/course-jee-advanced.jpg" class="img-fluid rounded-4 shadow mb-4" alt="JEE Advanced">
    
            <div class="card mb-3">
              <div class="card-body">
                <h3 class="text-primary">About this Course</h3>
                <p class="lead">JEE Advanced demands deeper conceptual clarity and unmatched problem-solving skills. Our
                advanced batch focuses on multi-concept problems, research-grade physics, organic chemistry mechanisms, and
                competitive mathematics.</p>
              </div>
            </div>

            <div class="card mb-3">
              <div class="card-body">
                <h4 class="text-primary my-4">Key Highlights</h4>
                <ul class="list-unstyled ps-2">
                  <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>IIT alumni faculty for every subject
                </li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Advanced problem sets from international olympiads</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Mentor 1:1 sessions every week</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Mock JEE Advanced tests with
                  detailed analysis</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Top 100 AIR mentorship program</li>
                </ul>
              </div>
            </div>
             <div class="card mt-2">
            <div class="card-body custom-body-card">
              <h4 class="text-primary my-4"><i class="bi bi-book text-primary me-2"></i> Syllabus Coverage</h4>
              <ul class="list-unstyled ps-2">
                <li class="mb-2"><span class="">1</span> Physics: Advanced mechanics, EM theory, quantum
                basics</li>
                <li class="mb-2"><span class="">2</span> Chemistry: Reaction mechanisms, coordination
                chemistry</li>
                <li class="mb-2"><span class="">3</span> Mathematics: Higher calculus, algebra,
                probability</li>
                <li class="mb-2"><span class="">4</span> Special: Multi-correct, paragraph, matrix-match
                practice</li>
              </ul>
              <h4 class="text-primary my-4">What You Get</h4>
              <div>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">Small Batch (25 students)</span><span
                class="badge bg-warning text-dark me-2 mb-2 p-2">IIT Alumni Mentors</span><span
                class="badge bg-warning text-dark me-2 mb-2 p-2">Olympiad-grade Problems</span><span
                class="badge bg-warning text-dark me-2 mb-2 p-2">AIR-focused Coaching</span>
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
                    <div class="info-value">1–2 Years</div>
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
                    <div class="info-value">₹1,15,000/year</div>
                  </div>
                </div>

                <!-- Includes -->
                <div class="includes-title">INCLUDES</div>

                <div class="include-item">
                  <i class="bi bi-check-circle"></i> Small Batch (25 students)
                </div>
                <div class="include-item">
                  <i class="bi bi-check-circle"></i> IIT Alumni Mentors
                </div>
                <div class="include-item">
                  <i class="bi bi-check-circle"></i> Olympiad-grade Problems
                </div>
                <div class="include-item">
                  <i class="bi bi-check-circle"></i> AIR-focused Coaching
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