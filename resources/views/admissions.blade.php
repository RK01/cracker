@extends('layouts.app')
@section('content')
<section class="page-hero text-white text-center py-5">
  <div class="container py-4">
    <span class="badge bg-warning text-dark mb-3">Apply Now</span>
    <h1 class="display-4 fw-bold">Admissions Open 2025–26</h1>
    <p class="lead opacity-75">Limited seats — secure your spot today</p>
  </div>
</section>

<section class="section-padding admissions-section">
    <div class="container py-5">

    <!-- Heading -->
    <div class="section-title">
        <button class="btn btn-light btn-sm mb-2">JOIN US</button>
        <h1><span>Admissions</span> Open 2025–26</h1>
        <p>Secure your seat now — limited batches available</p>
        <div class="line"></div>
    </div>

    <div class="row g-4">

        <!-- Left Side -->
        <div class="col-lg-5">

            <!-- Image -->
            <img src="https://images.unsplash.com/photo-1588072432836-e10032774350" class="main-img mb-4">

            <!-- Eligibility -->
            <div class="card-box">
                <h5 class="mb-3"><i class="bi bi-file-earmark-text text-warning"></i> Eligibility Criteria</h5>
                <ul class="list-unstyled eligibility">
                    <li><i class="bi bi-check-circle"></i>Students from Class 6th to 12th (CBSE/ICSE/State Board)</li>
                    <li><i class="bi bi-check-circle"></i>12th pass students for dropper batch programs</li>
                    <li><i class="bi bi-check-circle"></i>Minimum 50% marks in previous qualifying examination</li>
                    <li><i class="bi bi-check-circle"></i>Valid Aadhaar card and recent passport photo</li>
                    <li><i class="bi bi-check-circle"></i>Entrance test or direct admission based on merit</li>
                </ul>
            </div>

        </div>

        <!-- Right Side -->
        <div class="col-lg-7">
            <div class="card-box">

                <h5 class="mb-4">
                    <i class="bi bi-rocket-takeoff text-warning"></i> Admission Process
                </h5>

                <!-- Step 1 -->
                <div class="step">
                    <div class="step-number">1</div>
                    <div>
                        <h6>Fill Application Form</h6>
                        <p>Complete the online or offline application form with your details</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="step">
                    <div class="step-number">2</div>
                    <div>
                        <h6>Document Submission</h6>
                        <p>Submit required documents — marksheets, photos, ID proof</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="step">
                    <div class="step-number">3</div>
                    <div>
                        <h6>Entrance Test / Interview</h6>
                        <p>Appear for aptitude test or get direct merit-based admission</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="step">
                    <div class="step-number">4</div>
                    <div>
                        <h6>Fee Payment & Enrollment</h6>
                        <p>Complete fee payment and start your journey to success!</p>
                    </div>
                </div>

                <!-- Button -->
                <a href="#" class="apply-btn mt-3">
                    🎯 Apply Now — Limited Seats!
                </a>

            </div>
        </div>

    </div>

</div>
</section>
@endsection