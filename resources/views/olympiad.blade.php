@extends('layouts.app')
@section('content')
<section class="page-hero text-white text-center py-5">
  <div class="container py-4">
    <span class="badge bg-warning text-dark mb-3">Olympiad</span>
    <h1 class="display-4 fw-bold">Olympiad Test Registration</h1>
    <p class="lead opacity-75">Register for National & International Olympiads</p>
  </div>
</section>

<section class="section-padding">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-5">
        <img src="assets/img/olympiad.jpg" class="img-fluid rounded-4 shadow mb-3" alt="Olympiad">

        <div class="card mb-3">
          <div class="card-body">
            <h3 class="text-primary"><i class="bi bi-trophy text-warning"></i> Why Participate?</h3>
            <ul class="list-unstyled ps-3 ul-li-space">
              <li><i class="bi bi-check-circle-fill text-warning me-2 py-3"></i> Compete at National & International levels</li>
              <li><i class="bi bi-check-circle-fill text-warning me-2 py-3"></i> Win medals, certificates and scholarships</li>
              <li><i class="bi bi-check-circle-fill text-warning me-2 py-3"></i> Boost academic profile for college admissions</li>
              <li><i class="bi bi-check-circle-fill text-warning me-2 py-3"></i> Identify your true academic potential</li>
            </ul>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <h3><i class="bi bi-award-fill text-warning"></i></h3>
            <h3 class="text-primary">Why participate?</h3>
            <p>Win cash prizes, medals, certificates, and gain national-level recognition. All participants get a participation certificate.</p>
          </div>
        </div>
        
      </div>
      <div class="col-lg-7 card shadow-sm border-0">
        <div class="p-4">
          <h4 class="text-primary mb-3">Registration Form</h4>
          <form id="olympiadForm" class="form-fild">

            <div class="row g-3">
              <div class="col-md-6 mb-3">
                <label class="form-label">Student Name</label>
                <input class="form-control" required pattern="[a-zA-Z\s]+" title="Please enter a valid name (letters and spaces only)">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Parent Name</label>
                <input class="form-control" required pattern="[a-zA-Z\s]+" title="Please enter a valid name (letters and spaces only)">
              </div>
            </div>

            

            <div class="row g-3">
              <div class="col-md-6 mb-3">
                <label class="form-label">Class</label>
                <select class="form-select" required>
                  <option value="">Select</option>
                  <option>Class 6</option><option>Class 7</option><option>Class 8</option><option>Class 9</option><option>Class 10</option><option>Class 11</option><option>Class 12</option>
                </select></div>
              <div class="col-md-6 mb-3">

                <label class="form-label">School Name</label>
              <input class="form-control" required>
                
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Olympiad</label>
                <select class="form-select" required>
                  <option value="">Select</option>
                  <option>National Science Olympiad</option>
                  <option>International Maths Olympiad</option>
                  <option>National Cyber Olympiad</option>
                  <option>English Olympiad</option>
                </select>
            </div>

            <div class="row g-3">
              <div class="col-md-6 mb-3">
                 <label class="form-label">Phone</label>
              <input type="tel" pattern="[0-9]{10}" class="form-control" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" required>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">City</label>
              <input type="text" class="form-control"  required>
            </div>
           
            
            <button class="btn btn-warning w-100 py-3">Register for Olympiad</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection