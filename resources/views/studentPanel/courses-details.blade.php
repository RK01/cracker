@extends('layouts.student')
@section('content')

  <section class="page-hero text-white text-center py-5">
    <div class="container py-4">
      <h1 class="display-4 fw-bold">{{$courseDetails->title}}</h1>
    </div>
  </section>

  <section class="section-padding course-ca-foundation">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-8">
          <img src="{{ asset('assets/img/course-ca.jpg')}}" class="img-fluid rounded-4 shadow mb-4" alt="CA Foundation">
          
          <div class="card mb-3">
            <div class="card-body">
              <h3 class="text-primary">About this Course</h3>
              <p class="lead">{{$courseDetails->description}}</p>
            </div>
          </div>

          <div class="card mb-3">
            <div class="card-body">
              <h4 class="text-primary my-4">Key Highlights</h4>
              <ul class="list-unstyled ps-2">
                @foreach($courseDetails->highlights ?? [] as $item)
                  <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i>{{$item}}</li>
                @endforeach
                
              </ul>
            </div>
          </div>

          <div class="card mt-2">
            <div class="card-body custom-body-card">
              <h4 class="text-primary my-4"><i class="bi bi-book text-primary me-2"></i> Syllabus Coverage</h4>
              <ul class="list-unstyled ps-2">
                @foreach($courseDetails->syllabus ?? [] as $key=> $item)
                  <li class="mb-2"><span class=""><td>{{ $key + 1 }}</td></span> {{$item}}</li>
                @endforeach
              </ul>
              <h4 class="text-primary my-4">What You Get</h4>
              <div>
                @foreach($courseDetails->what_you_get ?? [] as $item)
                  <span class="badge bg-warning text-dark me-2 mb-2 p-2">{{$item}}</span>
                @endforeach
                
              </div>
            </div>
          </div>

        </div>


        <div class="col-lg-4">
          <div class="card shadow-sm border-0 sticky-top course-card" style="top:90px;">
            <div class="card-body">

              <div class="course-title">Course courseDetailss</div>

              <!-- Duration -->
              <div class="info-item">
                <i class="bi bi-clock info-icon"></i>
                <div>
                  <div class="info-label">Duration</div>
                  <div class="info-value">{{$courseDetails->duration}}</div>
                </div>
              </div>

              <!-- Batch Size -->
              <div class="info-item">
                <i class="bi bi-people info-icon"></i>
                <div>
                  <div class="info-label">Batch Size</div>
                  <div class="info-value">{{$courseDetails->batch_size}} students/batch</div>
                </div>
              </div>

              <!-- Course Fee -->
              <div class="info-item">
                <i class="bi bi-currency-rupee info-icon"></i>
                <div>
                  <div class="info-label">Course Fee</div>
                  <div class="info-value">₹{{$courseDetails->price}}</div>
                </div>
              </div>

              <!-- Includes -->
              <div class="includes-title">INCLUDES</div>

              @foreach($courseDetails->includes ?? [] as $item)
              <div class="include-item">
                <i class="bi bi-check-circle"></i> {{ $item }}
              </div>
              @endforeach
              @if(hasPurchasedThisCourse($courseDetails->course_sub_category_id)) 
              <button class="btn btn-buy w-100 mt-2" disabled >
                 Purchesed
              </button>
              @else
              <a href="{{ route('student.courses.payment', encrypt($courseDetails->id)) }}" class="btn btn-buy w-100 mt-2">
                <i class="bi bi-cart"></i>Buy Now
              </a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection