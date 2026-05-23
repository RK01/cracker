@extends('layouts.app')
@section('content')
  <section class="page-hero text-white text-center py-5">
    <div class="container py-4">
      <span class="badge bg-warning text-dark mb-3">Courses</span>
      <h1 class="display-4 fw-bold">IIT JEE Programs</h1>
      <p class="lead opacity-75">Choose your path — JEE Mains or JEE Advanced</p>
    </div>
  </section>

  <section class="section-padding section-c-i-j">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-6">
          <div class="card card-course h-100 shadow-sm">
            <img src="{{ asset('assets/img/course-jee-mains.jpg') }}" class="card-img-top" alt="JEE Mains">
            <div class="card-body">
              <h4>JEE Mains</h4>
              <p class="text-muted">Crack JEE Mains with India's top mentors</p>
              <div class="d-flex gap-3 small text-muted mb-2">
                <span><i class="bi bi-clock"></i> 1–2 Years</span>
                <span><i class="bi bi-people"></i> 30 students/batch</span>
                <span><i class="bi bi-tag"></i> ₹85,000/year</span>
              </div>
              <p>Our JEE Mains program is designed to build a strong foundation in Physics, Chemistry, and Mathematics.
                With concept-driven teaching, daily practice problems, and weekly mock tests, students develop the speed
                and accuracy required to score in the top percentile.</p>
              <div class="d-flex gap-2">
                <a href="course-jee-mains" class="btn btn-warning flex-fill">Enroll</a>
                <a href="register" class="btn btn-primary flex-fill">Buy Now</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-course h-100 shadow-sm">
            <img src="{{ asset('assets/img/course-jee-advanced.jpg') }}" class="card-img-top" alt="JEE Advanced">
            <div class="card-body">
              <h4>JEE Advanced</h4>
              <p class="text-muted">Your gateway to IIT — train with the best</p>
              <div class="d-flex gap-3 small text-muted mb-2">
                <span><i class="bi bi-clock"></i> 1–2 Years</span>
                <span><i class="bi bi-people"></i> 25 students/batch</span>
                <span><i class="bi bi-tag"></i> ₹1,15,000/year</span>
              </div>
              <p>JEE Advanced demands deeper conceptual clarity and unmatched problem-solving skills. Our advanced batch
                focuses on multi-concept problems, research-grade physics, organic chemistry mechanisms, and competitive
                mathematics.</p>
              <div class="d-flex gap-2">
                <a href="course-jee-advanced" class="btn btn-warning flex-fill">Enroll</a>
                <a href="register" class="btn btn-primary flex-fill">Buy Now</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection