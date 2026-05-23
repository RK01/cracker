@extends('layouts.app')
@section('content')
<section class="page-hero text-white text-center py-5">
  <div class="container py-4">
    <span class="badge bg-warning text-dark mb-3">Our Direction</span>
    <h1 class="display-4 fw-bold">Vision & Mission</h1>
    <p class="lead opacity-75">What drives us forward</p>
  </div>
</section>
<section class="section-padding">
  <div class="container py-5">
    <!-- Top Cards -->
    <div class="row g-4">
        <!-- Vision -->
        <div class="col-md-6">
            <div class="card-custom bg-white">
                <div class="icon-box">
                    <i class="bi bi-eye"></i>
                </div>
                <h5 class="card-title">Our Vision</h5>
                <p class="card-text">
                    To be India's most trusted competitive exam coaching institute, 
                    where every student — regardless of background — gets world-class mentorship, 
                    modern learning tools, and a proven path to crack JEE, NEET, CA, CLAT, CUET and other exams.
                </p>
            </div>
        </div>
        <!-- Mission -->
        <div class="col-md-6">
            <div class="card-custom bg-white">
                <div class="icon-box">
                    <i class="bi bi-bullseye"></i>
                </div>
                <h5 class="card-title">Our Mission</h5>
                <p class="card-text">
                    Provide concept-driven, personalized coaching through expert faculty, 
                    small batches, and continuous performance tracking. 
                    We focus on transparency, ethics, and measurable student success.
                </p>
            </div>
        </div>
    </div>
    <!-- Core Values -->
    <div class="core-section mt-5">
        <h4 class="core-title">Our Core Values</h4>
        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="core-box">
                    <div class="core-icon">
                        <i class="bi bi-heart"></i>
                    </div>
                    <h6>Empathy</h6>
                    <p>Every student is heard, supported, mentored.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="core-box">
                    <div class="core-icon">
                        <i class="bi bi-lightbulb"></i>
                    </div>
                    <h6>Excellence</h6>
                    <p>Industry-best teaching, no compromises.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="core-box">
                    <div class="core-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h6>Integrity</h6>
                    <p>Transparent fees, ethical counseling, honest results.</p>
                </div>
            </div>

        </div>
    </div>
</div>
</section>

@endsection