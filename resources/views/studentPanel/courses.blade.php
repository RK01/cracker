@extends('layouts.student')
@section('content')
<section class="page-hero text-white text-center py-5">
  <div class="container">
    <span class="badge bg-warning text-dark mb-3">Courses</span>
    <h1 class="display-4 fw-bold">{{getCourseNameById(Auth::user()->course_id)}}</h1>
    <p class="lead opacity-75">Medical entrance preparation — 1 or 2 year tracks</p>
  </div>
</section>

<section class="section-padding section-c-i-j">
  <div class="container">
    <div class="row g-4">
     @forelse($courses as $course)
      <div class="col-md-6">
        <div class="card card-course h-100 shadow-sm">
          <!-- Image Dynamic Karein -->
          <img src="{{ asset('assets/img/course-neet-2year.jpg')}}"
            class="card-img-top"
            alt="Course Image">

          <div class="card-body">
            <!-- Sub-category Name -->
            <h4>{{ $course->name }}</h4>

            <p class="text-muted">
              {{ $course->courseDetail->title ?? 'Title not available' }}
            </p>

            <div class="d-flex gap-3 small text-muted mb-2">
              <span>
                <i class="bi bi-clock"></i>
                {{ $course->courseDetail->duration ?? 'N/A' }}
              </span>

              <span>
                <i class="bi bi-people"></i>
                {{ $course->courseDetail->batch_size ?? 'N/A' }}
              </span>

              <span>
                <i class="bi bi-tag"></i>
                ₹ {{ $course->courseDetail->price ?? 'Contact for Price' }}
              </span>
            </div>

            <p><strong>Syllabus Preview:</strong></p>
            <ul class="list-unstyled mb-3">
              @if(isset($course->courseDetail->syllabus) && is_array($course->courseDetail->syllabus))
                  @foreach(array_slice($course->courseDetail->syllabus, 0, 3) as $topic)
                      <li class="small text-truncate text-secondary">• {{ $topic }}</li>
                  @endforeach
              @endif
            </ul>

            <p class="small text-muted line-clamp-2">
              {{ $course->courseDetail->description ?? '' }}
            </p>

            <div class="d-flex justify-content-between mt-auto">
              @if($course->courseDetail)
                  <a href="{{ route('student.courses.details', encrypt($course->courseDetail->id)) }}"
                    class="btn btn-outline-primary btn-sm">
                    View Details
                  </a>
                  @if(hasPurchasedThisCourse($course->courseDetail->course_sub_category_id)) 
                   <a  class="btn btn-info btn-sm" disabled>
                    Already Purchesed
                  </a>
                  @else
                  <a href="{{ route('student.courses.details', encrypt($course->courseDetail->id)) }}" class="btn btn-success btn-sm">
                    Buy Now
                  </a>
                  @endif
              @endif
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12">
        <div class="alert alert-info text-center">
          No courses available at the moment.
        </div>
      </div>
      @endforelse

    </div>
  </div>
</section>

@endsection