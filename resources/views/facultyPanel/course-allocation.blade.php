@extends('layouts.faculty')
@section('content')
<div class="faculty-main" id="facultyMain">
  <!-- Top Bar -->
  <div class="faculty-topbar">
    <div class="faculty-topbar-title">
      <h4><i class="fas fa-book me-2"></i>Courses & Subject Allocation</h4>
      <small>Manage your assigned courses and subjects</small>
    </div>
  </div>

  <!-- Allocated Courses -->
  <div class="form-section">
    <h5 class="form-section-title">
      <i class="fas fa-check-circle me-2"></i>Allocated Courses
    </h5>

    <div class="row">

      @forelse($cources as $cource)

      <div class="col-md-6 col-lg-4 mb-3">
        <div class="card border-1 shadow-sm" style="border-left: 4px solid var(--faculty-accent);">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-start my-2">
              <h6 class="card-title fw-bold mb-0">{{$cource->name}}</h6>
              <span class="table-badge {{ $cource->status == '' ? 'success' : 'danger' }}">
                {{ $cource->status == 1 ? 'Active' : 'Inactive' }}
              </span>
            </div>
          </div>
          <div class="card-body">
            <p class="text-muted mb-3">
            <p>{{$cource->courseDetail->title}}</p>
            <ul>
              @foreach($cource->subjects as $subject)
              <li>{{$subject->name}}</li>
              @endforeach
            </ul>
            </p>
            <p>{{$cource->courseDetail->description}}</p>
            <div class="mb-3">
              <small class="d-block mb-1">Duration: <strong>{{$cource->courseDetail->duration}}</strong></small>
            </div>
          </div>
        </div>
      </div>
      @empty
      <h2>Data Not Found</h2>
      @endforelse
    </div>
  </div>

  <div class="row mt-4">

  </div>
  <!-- Subjects Management -->
  <div class="row mt-4">
    <div class="col-lg-12">
      <div class="form-section">
        <h5 class="form-section-title">
          <i class="fas fa-book-open me-2"></i>Courses, Subjects & Syllabus
        </h5>
        <div class="accordion" id="courseAccordion">
          @foreach($cources as $course)

          @php
          $detail = $course->courseDetail->first();
          $syllabus = $detail->syllabus ?? [];
          @endphp
          <div class="accordion-item mb-3 border-0 shadow-sm">
            {{-- Accordion Header --}}
            <h2 class="accordion-header" id="heading{{ $course->id }}">
              <button class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $course->id }}"
                aria-expanded="false">
                <div class="w-100 d-flex justify-content-between align-items-center pe-3">
                  <div>
                    <strong>{{ $course->name }}</strong>
                    <span class="ms-2 text-muted">

                    </span>
                  </div>
                  <div>
                    @if($course->status == '')
                    <span class="table-badge success">
                      Active
                    </span>
                    @else
                    <span class="table-badge danger">
                      Inactive
                    </span>
                    @endif
                  </div>
                </div>
              </button>
            </h2>
            {{-- Accordion Body --}}
            <div id="collapse{{ $course->id }}"
              class="accordion-collapse collapse"
              data-bs-parent="#courseAccordion">
              <div class="accordion-body">
                {{-- Course Info --}}
                <div class="row mb-4">
                  <div class="col-md-6 mb-3">
                    <div class="p-3 rounded"
                      style="background: var(--faculty-bg);">
                      <small class="text-muted">Duration</small>
                      <h6 class="mb-0">
                        {{ $detail->duration ?? 'N/A' }}
                      </h6>
                    </div>
                  </div>

                  <div class="col-md-6 mb-3">
                    <div class="p-3 rounded"
                      style="background: var(--faculty-bg);">
                      <small class="text-muted">Batch Size</small>
                      <h6 class="mb-0">
                        {{ $detail->batch_size ?? 'N/A' }}
                      </h6>
                    </div>
                  </div>
                </div>
                {{-- Subjects --}}
                <h6 class="mb-3">
                  <i class="fas fa-book me-2"></i>Subjects
                </h6>
                @if($syllabus)
                <div class="row">
                  @foreach($syllabus as $subject)
                    @php
                    $parts = explode(':', $subject, 2);
                    $title = $parts[0] ?? 'Subject';
                    $content = $parts[1] ?? '';
                    @endphp
                  <div class="col-md-4 mb-3">
                    <div class="card border-1 shadow-sm h-100" style="border: 4px solid var(--faculty-accent);">
                      <div class="card-header">
                        <h6 class="card-title">{{ $title }}</h6>
                      </div>
                      <div class="card-body">
                        <div class="mt-3">
                          <strong class="small">Syllabus:</strong>
                          <div class="mt-2">
                            <span class="table-badge success mb-1 d-inline-block">
                              {{ $content }}
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                @else
                <h3>Slybuss not available</h3>
                @endif
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    {{--<div class="col-lg-4">
      <div class="form-section">
        <h5 class="form-section-title">
          <i class="fas fa-info-circle me-2"></i>Course Statistics
        </h5>

        <div class="mb-3 p-3" style="background: var(--faculty-bg); border-radius: 8px;">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span>Total Courses</span>
            <strong style="font-size: 1.5rem; color: var(--faculty-primary);">4</strong>
          </div>
        </div>

        <div class="mb-3 p-3" style="background: var(--faculty-bg); border-radius: 8px;">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span>Active Courses</span>
            <strong style="font-size: 1.5rem; color: var(--faculty-success);">3</strong>
          </div>
        </div>

        <div class="mb-3 p-3" style="background: var(--faculty-bg); border-radius: 8px;">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span>Total Students</span>
            <strong style="font-size: 1.5rem; color: var(--faculty-accent);">840</strong>
          </div>
        </div>

        <div class="mb-3 p-3" style="background: var(--faculty-bg); border-radius: 8px;">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span>Subjects Covered</span>
            <strong style="font-size: 1.5rem; color: var(--faculty-info);">8</strong>
          </div>
        </div>
      </div>
    </div> --}}
  </div>
</div>
@endsection