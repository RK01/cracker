@extends('layouts.app')
@section('content')
  <section class="page-hero text-white text-center py-5">
    <div class="container py-4">
      <span class="badge bg-warning text-dark mb-3">IIT JEE</span>
      <h1 class="display-4 fw-bold">JEE Mains</h1>
      <p class="lead opacity-75">Crack JEE Mains with India's top mentors</p>
    </div>
  </section>

  <section class="section-padding course-ca-foundation">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-8">
          <img src="assets/img/course-jee-mains.jpg" class="img-fluid rounded-4 shadow mb-4" alt="JEE Mains">

          <div class="card mb-3">
            <div class="card-body">
              <h3 class="text-primary">About this Course</h3>
              <p class="lead">Our JEE Mains program is designed to build a strong foundation in Physics, Chemistry, and
                Mathematics. With concept-driven teaching, daily practice problems, and weekly mock tests, students develop
                the speed and accuracy required to score in the top percentile.</p>
            </div>
          </div>

          <div class="card mb-3">
            <div class="card-body">
              <h4 class="text-primary my-4">Key Highlights</h4>
              <ul class="list-unstyled ps-2">
                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>500+ hours of live classroom
              teaching</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Weekly full-length mock tests on
              actual JEE pattern</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Doubt-clearing sessions every
              evening</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Printed study material covering
              NCERT + advanced concepts</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>Performance analytics &
              personalized improvement plans</li>
              </ul>
            </div>
          </div>
          
          
          <div class="card mt-2">
            <div class="card-body custom-body-card">
              <h4 class="text-primary my-4"><i class="bi bi-book text-primary me-2"></i> Syllabus Coverage</h4>
              <ul class="list-unstyled ps-2">
                <li class="mb-2"><span class="">1</span> Physics: Mechanics, Thermodynamics,
              Electromagnetism, Optics, Modern Physics</li>
                <li class="mb-2"><span class="">2</span> Chemistry: Physical, Inorganic, Organic
              Chemistry — full NCERT + advanced</li>
                <li class="mb-2"><span class="">3</span> Mathematics: Algebra, Calculus, Coordinate
              Geometry, Trigonometry, Vectors</li>
                <li class="mb-2"><span class="">4</span> Practice: 10,000+ MCQs, previous 20 years'
              papers</li>

              </ul>
              <h4 class="text-primary my-4">What You Get</h4>
              <div>
                <span class="badge bg-warning text-dark me-2 mb-2 p-2">Live + Recorded Classes</span><span
              class="badge bg-warning text-dark me-2 mb-2 p-2">Test Series (40+ tests)</span><span
              class="badge bg-warning text-dark me-2 mb-2 p-2">DPP (Daily Practice Problems)</span><span
              class="badge bg-warning text-dark me-2 mb-2 p-2">Mentor Support</span>
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
                  <div class="info-value">30 students/batch</div>
                </div>
              </div>

              <!-- Course Fee -->
              <div class="info-item">
                <i class="bi bi-currency-rupee info-icon"></i>
                <div>
                  <div class="info-label">Course Fee</div>
                  <div class="info-value">₹85,000/year</div>
                </div>
              </div>

              <!-- Includes -->
              <div class="includes-title">INCLUDES</div>

              <div class="include-item">
                <i class="bi bi-check-circle"></i> Live + Recorded Classes
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> Test Series (40+ tests)
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> DPP (Daily Practice Problems)
              </div>
              <div class="include-item">
                <i class="bi bi-check-circle"></i> Mentor Support
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