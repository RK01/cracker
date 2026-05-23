@extends('layouts.app')
@section('content')

<section class="page-hero text-white text-center py-5">
  <div class="container py-4">
    <span class="badge bg-warning text-dark mb-3">Our Mentors</span>
    <h1 class="display-4 fw-bold">Meet Our Expert Faculty</h1>
    <p class="lead opacity-75">India's finest mentors guiding your success</p>
  </div>
</section>

<section class="section-padding"><div class="container"><div class="row g-4">
    <div class="col-md-6 col-lg-4">
      <div class="card faculty-card h-100 shadow-sm border-0">
        <img src="assets/img/faculty-1.jpg" class="card-img-top" alt="Dr. Rajesh Kumar">
        <div class="card-body text-center">
          <h5 class="mb-1">Dr. Rajesh Kumar</h5>
          <p class="text-warning fw-semibold small mb-1">Physics (IIT-JEE)</p>
          <p class="text-muted small mb-2">18+ years experience</p>
          <p class="small">IIT Bombay alumnus with 18 years mentoring JEE rankers.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card faculty-card h-100 shadow-sm border-0">
        <img src="assets/img/faculty-2.jpg" class="card-img-top" alt="Prof. Anita Sharma">
        <div class="card-body text-center">
          <h5 class="mb-1">Prof. Anita Sharma</h5>
          <p class="text-warning fw-semibold small mb-1">Chemistry (NEET/JEE)</p>
          <p class="text-muted small mb-2">15+ years experience</p>
          <p class="small">PhD in Organic Chemistry; specialist in NEET pattern.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card faculty-card h-100 shadow-sm border-0">
        <img src="assets/img/faculty-3.jpg" class="card-img-top" alt="Mr. Vikram Singh">
        <div class="card-body text-center">
          <h5 class="mb-1">Mr. Vikram Singh</h5>
          <p class="text-warning fw-semibold small mb-1">Mathematics</p>
          <p class="text-muted small mb-2">20+ years experience</p>
          <p class="small">Authored 5 books on JEE Mathematics; ex-FIITJEE.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card faculty-card h-100 shadow-sm border-0">
        <img src="assets/img/faculty-4.jpg" class="card-img-top" alt="Dr. Meera Iyer">
        <div class="card-body text-center">
          <h5 class="mb-1">Dr. Meera Iyer</h5>
          <p class="text-warning fw-semibold small mb-1">Biology (NEET)</p>
          <p class="text-muted small mb-2">12+ years experience</p>
          <p class="small">AIIMS Delhi alumna; mentored 200+ NEET toppers.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card faculty-card h-100 shadow-sm border-0">
        <img src="assets/img/faculty-5.jpg" class="card-img-top" alt="CA Suresh Mehta">
        <div class="card-body text-center">
          <h5 class="mb-1">CA Suresh Mehta</h5>
          <p class="text-warning fw-semibold small mb-1">CA Foundation</p>
          <p class="text-muted small mb-2">22+ years experience</p>
          <p class="small">Practising Chartered Accountant and educator.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card faculty-card h-100 shadow-sm border-0">
        <img src="assets/img/faculty-6.jpg" class="card-img-top" alt="Adv. Priya Nair">
        <div class="card-body text-center">
          <h5 class="mb-1">Adv. Priya Nair</h5>
          <p class="text-warning fw-semibold small mb-1">CLAT / Legal Reasoning</p>
          <p class="text-muted small mb-2">10+ years experience</p>
          <p class="small">NLSIU graduate; trained 100+ NLU students.</p>
        </div>
      </div>
    </div></div></div></section>
@endsection