@extends('layouts.app')
@section('content')
  <section class="page-hero text-white text-center py-5">
    <div class="container py-4">
      <span class="badge bg-warning text-dark mb-3">Gallery</span>
      <h1 class="display-4 fw-bold">Photo & Video Gallery</h1>
      <p class="lead opacity-75">Glimpses from our campus and events</p>
    </div>
  </section>

  <section class="section-padding">
    <div class="container">
      <ul class="nav nav-pills justify-content-center mb-4" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill"
            data-bs-target="#photos">Photos</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#videos">Videos</button>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="photos">
          <div class="row g-3">
            <div class="col-6 col-md-4 col-lg-4">
              <div class="gallery-item"><img src="assets/img/gallery-1.jpg" alt="Gallery"></div>
            </div>
            <div class="col-6 col-md-4 col-lg-4">
              <div class="gallery-item"><img src="assets/img/gallery-2.jpg" alt="Gallery"></div>
            </div>
            <div class="col-6 col-md-4 col-lg-4">
              <div class="gallery-item"><img src="assets/img/gallery-3.jpg" alt="Gallery"></div>
            </div>
            <div class="col-6 col-md-4 col-lg-4">
              <div class="gallery-item"><img src="assets/img/gallery-4.jpg" alt="Gallery"></div>
            </div>
            <div class="col-6 col-md-4 col-lg-4">
              <div class="gallery-item"><img src="assets/img/gallery-5.jpg" alt="Gallery"></div>
            </div>
            <div class="col-6 col-md-4 col-lg-4">
              <div class="gallery-item"><img src="assets/img/gallery-6.jpg" alt="Gallery"></div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="videos">
          <div class="row g-4">
            <div class="col-md-6">
              <div class="ratio ratio-16x9"><iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                  allowfullscreen></iframe></div>
            </div>
            <div class="col-md-6">
              <div class="ratio ratio-16x9"><iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                  allowfullscreen></iframe></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="lightbox" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content bg-transparent border-0">
        <img id="lightboxImg" class="img-fluid rounded shadow-lg">
      </div>
    </div>
  </div>
@endsection