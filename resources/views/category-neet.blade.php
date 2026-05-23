@extends('layouts.app')
@section('content')
<section class="page-hero text-white text-center py-5">
  <div class="container py-4">
    <span class="badge bg-warning text-dark mb-3">Courses</span>
    <h1 class="display-4 fw-bold">NEET Programs</h1>
    <p class="lead opacity-75">Medical entrance preparation — 1 or 2 year tracks</p>
  </div>
</section>

<section class="section-padding section-c-i-j">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card card-course h-100 shadow-sm">
          <img src="{{ asset('assets/img/course-neet-2year.jpg')}}" class="card-img-top" alt="Two Year Integrated Course for NEET">
          <div class="card-body">
            <h4>Two Year Integrated Course for NEET</h4>
            <p class="text-muted">Comprehensive 2-year program for medical aspirants</p>
            <div class="d-flex gap-3 small text-muted mb-2">
              <span><i class="bi bi-clock"></i> 2 Years</span>
              <span><i class="bi bi-people"></i> 35 students/batch</span>
              <span><i class="bi bi-tag"></i> ₹95,000/year</span>
            </div>
            <p>Our 2-year NEET program starts from Class 11 and provides complete coverage of Physics, Chemistry, and
              Biology with NCERT focus.</p>
            <div class="d-flex gap-2">
              <a href="course-neet-2-year.html" class="btn btn-warning flex-fill">Enroll</a>
              <a href="register.html" class="btn btn-primary flex-fill">Buy Now</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-course h-100 shadow-sm">
          <img src="{{ asset('assets/img/course-neet-1year.jpg')}}" class="card-img-top" alt="One Year Integrated Course for NEET">
          <div class="card-body">
            <h4>One Year Integrated Course for NEET</h4>
            <p class="text-muted">Intensive 1-year crash course for NEET</p>
            <div class="d-flex gap-3 small text-muted mb-2">
              <span><i class="bi bi-clock"></i> 1 Year</span>
              <span><i class="bi bi-people"></i> 30 students/batch</span>
              <span><i class="bi bi-tag"></i> ₹78,000/year</span>
            </div>
            <p>A focused, fast-paced 1-year program for Class 12 students and droppers preparing for NEET. Covers
              complete syllabus with intense revision cycles.</p>
            <div class="d-flex gap-2">
              <a href="course-neet-1-year.html" class="btn btn-warning flex-fill">Enroll</a>
              <a href="register.html" class="btn btn-primary flex-fill">Buy Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection