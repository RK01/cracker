@extends('layouts.app')
@section('content')
<section class="page-hero text-white text-center py-5">
  <div class="container py-4">
    <span class="badge bg-warning text-dark mb-3">Our Story</span>
    <h1 class="display-4 fw-bold">About Competitive Cracker</h1>
    <p class="lead opacity-75">Empowering students to crack India's toughest exams since 2010</p>
  </div>
</section>

<section id="about" class="py-5 bg-white">
  <div class="container py-4">
    <div class="section-title">
      <span class="badge bg-warnings bg-opacity-25 text-dark px-3 py-2 rounded-pill mb-2">ABOUT US</span>
      <h2>Why Choose <span class="accent">Competitive Cracker</span>?</h2>
      <div class="line"></div>
    </div>
    <div class="row g-5 align-items-center mb-5">
      <div class="col-md-6 position-relative">
        <img src="img/Mission-home.jpeg" alt="Students" class="img-fluid rounded-4 shadow" style="height:350px;width:100%;object-fit:cover;">
        <div class="position-absolute bottom-0 end-0 bg-warning text-dark rounded-3 p-3 shadow m-2">
          <div class="fs-3 fw-bold">15+</div><small class="fw-semibold">Years of Trust</small>
        </div>
      </div>
      <div class="col-md-6">
        <h3 class="fw-bold mb-3">Premier Coaching Institute Since 2010</h3>
        <p class="text-muted">Competitive Cracker is a premier coaching institute dedicated to nurturing young minds and
          preparing them for competitive examinations. With over 15 years of experience, we have helped thousands of
          students crack JEE, NEET, NDA, and other top-level exams.</p>
        <div class="row g-3">
          <div class="col-6">
            <div class="d-flex align-items-center gap-2 bg-light rounded-3 p-3"><i class="bi bi-people-fill text-warning"></i><small class="fw-semibold">10,000+ Students</small></div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center gap-2 bg-light rounded-3 p-3"><i class="bi bi-trophy-fill text-warning"></i><small class="fw-semibold">95% Success Rate</small></div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center gap-2 bg-light rounded-3 p-3"><i class="bi bi-book-fill text-warning"></i><small class="fw-semibold">50+ Expert Faculty</small></div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center gap-2 bg-light rounded-3 p-3"><i class="bi bi-graph-up-arrow text-warning"></i><small class="fw-semibold">Top Rankers Every Year</small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-4 mb-5">
      <div class="col-md-4">
        <div class="card card-hover border rounded-4 overflow-hidden h-100">
          <img src="img/Vision-home.jpeg" class="card-img-top" style="height:160px;object-fit:cover" alt="Our Vision">
          <div class="card-body text-center">
            <div class="bg-warnings bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:50px;height:50px;margin-top:-30px;position:relative;z-index:1;border:4px solid #fff"><i class="bi bi-eye-fill text-warning"></i></div>
            <h5 class="fw-bold">Our Vision</h5>
            <p class="text-muted small">To be the leading educational institution that empowers every student to crack
              any competition and excel in their career.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-hover border rounded-4 overflow-hidden h-100">
          <img src="img/Mission-home.jpeg" class="card-img-top" style="height:160px;object-fit:cover" alt="Our Mission">
          <div class="card-body text-center">
            <div class="bg-warnings bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:50px;height:50px;margin-top:-30px;position:relative;z-index:1;border:4px solid #fff"><i class="bi bi-bullseye text-warning"></i></div>
            <h5 class="fw-bold">Our Mission</h5>
            <p class="text-muted small">To provide world-class coaching through innovative teaching methods, experienced
              faculty, and personalized mentorship.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-hover border rounded-4 overflow-hidden h-100">
          <img src="img/Objectives-home.jpeg" class="card-img-top" style="height:160px;object-fit:cover" alt="Our Objectives">
          <div class="card-body text-center">
            <div class="bg-warnings bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:50px;height:50px;margin-top:-30px;position:relative;z-index:1;border:4px solid #fff">
              <i class="bi bi-award-fill text-warning"></i>
            </div>
            <h5 class="fw-bold">Our Objectives</h5>
            <p class="text-muted small">To develop critical thinking, build exam temperament, and ensure students are
              fully prepared for national-level exams.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-6 col-md-3">
        <div class="stat-box card-hover">
          <div class="num">15+</div><small class="opacity-75">Years Experience</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-box card-hover">
          <div class="num">10,000+</div><small class="opacity-75">Students Placed</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-box card-hover">
          <div class="num">50+</div><small class="opacity-75">Expert Faculty</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-box card-hover">
          <div class="num">95%</div><small class="opacity-75">Success Rate</small>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection