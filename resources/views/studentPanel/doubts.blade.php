@extends('layouts.student')
@section('content')
<div class="container py-4">

  <div class="row mb-4">
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center border-primary">
        <div class="card-body">
          <div class="text-primary mb-2" style="font-size: 2rem;"><i class="bi bi-chat-dots"></i></div>
          <h4 class="mb-1">{{ $totalCount }}</h4>
          <small class="text-muted">Total Queries</small>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center border-success">
        <div class="card-body">
          <div class="text-success mb-2" style="font-size: 2rem;"><i class="bi bi-check-circle"></i></div>
          <h4 class="mb-1">{{ $resolvedCount }}</h4>
          <small class="text-muted">Resolved</small>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center border-warning">
        <div class="card-body">
          <div class="text-warning mb-2" style="font-size: 2rem;"><i class="bi bi-clock"></i></div>
          <h4 class="mb-1">{{ $pendingCount }}</h4>
          <small class="text-muted">Pending</small>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Doubts & Queries</h5>
    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#askDoubtModal">
      <i class="bi bi-plus-circle"></i> Ask New Doubt
    </button>
  </div>

  <div class="card shadow-sm">
    <div class="card-header bg-light">
      <ul class="nav nav-tabs card-header-tabs" id="doubtsTabs" role="tablist">
        <li class="nav-item">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#all" type="button">
            All Queries <span class="badge bg-primary ms-1">{{ $totalCount }}</span>
          </button>
        </li>
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pending" type="button">
            Pending <span class="badge bg-warning ms-1">{{ $pendingCount }}</span>
          </button>
        </li>
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#resolved" type="button">
            Resolved <span class="badge bg-success ms-1">{{ $resolvedCount }}</span>
          </button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <div class="tab-content">

        <div class="tab-pane fade show active" id="all">
          <div class="doubts-list">
            @forelse($allDoubts as $doubt)
            <div class="card mb-3 {{ $doubt->is_urgent ? 'border-start border-danger border-4' : '' }}">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <div>
                    <h6 class="card-title mb-1">
                      {{ $doubt->title }}
                      @if($doubt->is_urgent) <span class="badge bg-danger small">Urgent</span> @endif
                    </h6>
                    <span class="badge bg-info text-dark me-2">{{ $doubt->subject->name ?? 'N/A' }}</span>
                    <small class="text-muted">Posted {{ $doubt->created_at->diffForHumans() }}</small>
                  </div>
                  <span class="badge {{ $doubt->status == 'resolved' ? 'bg-success' : 'bg-warning' }}">
                    {{ ucfirst($doubt->status) }}
                  </span>
                </div>
                <p class="card-text small text-truncate" style="width:auto ;">{{ $doubt->description }}</p>

                <div class="d-flex justify-content-between align-items-center">
                  <small class="text-muted">
                    <i class="bi bi-paperclip"></i>{{ $doubt->image_path ? 'Attachment included' : 'No attachment' }}
                  </small>
                  {{$doubt->image_path}}
                  @if($doubt->image_path)
                  <button class="btn btn-outline-primary btn-sm" onclick="window.open('{{ asset('storage/' . $doubt->image_path) }}', '_blank')">
                    <i class="bi bi-eye"></i> View Details
                  </button>
                  @else
                  <button class="btn btn-outline-secondary btn-sm" disabled>No File</button>
                  @endif
                </div>
              </div>
            </div>
            @empty
            <p class="text-center text-muted py-4">No queries found.</p>
            @endforelse
          </div>
        </div>

        <div class="tab-pane fade" id="pending">
          <div class="doubts-list">
            @forelse($pendingDoubts as $doubt)
            {{-- Same card structure as above or specific pending style --}}
            <div class="card mb-3 {{ $doubt->is_urgent ? 'border-start border-danger border-4' : '' }}">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <div>
                    <h6 class="card-title mb-1">
                      {{ $doubt->title }}
                      @if($doubt->is_urgent) <span class="badge bg-danger small">Urgent</span> @endif
                    </h6>
                    <span class="badge bg-info text-dark me-2">{{ $doubt->subject->name ?? 'N/A' }}</span>
                    <small class="text-muted">Posted {{ $doubt->created_at->diffForHumans() }}</small>
                  </div>
                  <span class="badge {{ $doubt->status == 'resolved' ? 'bg-success' : 'bg-warning' }}">
                    {{ ucfirst($doubt->status) }}
                  </span>
                </div>
                <p class="card-text small text-truncate" style="max-width: auto;">{{ $doubt->description }}</p>
                <span class="badge bg-warning">Awaiting Response</span>
                <div class="d-flex justify-content-between align-items-center">
                  <small class="text-muted">
                    <i class="bi bi-paperclip"></i>{{ $doubt->image_path ? 'Attachment included' : 'No attachment' }}
                  </small>
                  @if($doubt->image_path)
                  <button class="btn btn-outline-primary btn-sm" onclick="window.open('{{ asset('storage/' . $doubt->image_path) }}', '_blank')">
                    <i class="bi bi-eye"></i> View Details
                  </button>
                  @else
                  <button class="btn btn-outline-secondary btn-sm" disabled>No File</button>
                  @endif
                </div>
              </div>
            </div>
            @empty
            <p class="text-center text-muted py-4">No pending queries.</p>
            @endforelse
          </div>
        </div>

        <div class="tab-pane fade" id="resolved">
          <div class="doubts-list">
            @forelse($resolvedDoubts as $doubt)
            <div class="card mb-3 border-success">
              <div class="card-body">
                <h6>{{ $doubt->title }}</h6>
                <p class="small text-muted">{{ Str::limit($doubt->description, 100) }}</p>
                <span class="badge bg-success">Resolved</span>
              </div>
            </div>

            <div class="card mb-3 {{ $doubt->is_urgent ? 'border-start border-danger border-4' : '' }}">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <div>
                    <h6 class="card-title mb-1">
                      {{ $doubt->title }}
                      @if($doubt->is_urgent) <span class="badge bg-danger small">Urgent</span> @endif
                    </h6>
                    <span class="badge bg-info text-dark me-2">{{ $doubt->subject->name ?? 'N/A' }}</span>
                    <small class="text-muted">Posted {{ $doubt->created_at->diffForHumans() }}</small>
                  </div>
                  <span class="badge {{ $doubt->status == 'resolved' ? 'bg-success' : 'bg-warning' }}">
                    {{ ucfirst($doubt->status) }}
                  </span>
                </div>
                <p class="card-text small text-truncate" style="max-width: auto;">{{ $doubt->description }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <small class="text-muted">
                    <i class="bi bi-paperclip"></i>{{ $doubt->image_path ? 'Attachment included' : 'No attachment' }}
                  </small>
                  @if($doubt->image_path)
                  <button class="btn btn-outline-primary btn-sm" onclick="window.open('{{ asset('storage/' . $doubt->image_path) }}', '_blank')">
                    <i class="bi bi-eye"></i> View Details
                  </button>
                  @else
                  <button class="btn btn-outline-secondary btn-sm" disabled>No File</button>
                  @endif
                </div>
                <hr>
                <div class="faculty-reply">
                  <h6 class="text-info"><i class="fa fa-reply" aria-hidden="true"></i> Response <span style="font-size: 13px;color:green;">{{ $doubt->updated_at->diffForHumans() }}</span></h6>
                  <p>{{$doubt->faculty_reply}}</p>

                  @if($doubt->faculty_attachment)
                  <button class="btn btn-outline-primary btn-sm" onclick="window.open('{{ asset('storage/' . $doubt->faculty_attachment) }}', '_blank')" style="float: right;">
                    <i class="bi bi-eye"></i> View Details
                  </button>
                  @else
                  <button class="btn btn-outline-secondary btn-sm" disabled>No File</button>
                  @endif
                </div>
              </div>
            </div>

            @empty
            <p class="text-center text-muted py-4">No resolved queries yet.</p>
            @endforelse
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="askDoubtModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ask New Doubt</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form method="POST" action="{{ route('student.doubts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label">Course</label>
                <select name="course_id" class="form-select" required>
                  <option value="" disabled selected>Choose Course</option>
                  @foreach($courses as $course)
                  <option value="{{ $course->id }}" @selected($course->id == auth()->user()->course_id)>
                    {{ $course->name }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label">Sub Category Course</label>
                <select name="sub_cat_course_id" class="form-select" required>
                  <option value="" disabled selected>Choose Sub Category</option>
                  @foreach($courseSubCategory as $category)
                  <option value="{{ $category->id }}" @selected($category->id == auth()->user()->sub_cat_course_id)>
                    {{ $category->name }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label">Subject</label>
                <select name="subject_id" class="form-select" required>
                  <option value="" disabled selected>Choose subject</option>
                  @foreach($subjects as $subject)
                  <option value="{{ $subject->id }}" @selected($subject->id == auth()->user()->subject_id)>
                    {{ $subject->name }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Question Title *</label>
            <input type="text" class="form-control" name="title" placeholder="Brief title" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Detailed Question *</label>
            <textarea class="form-control" name="description" rows="5" placeholder="Describe your doubt..." required></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Attach Image (Optional)</label>
            <input type="file" class="form-control" name="file" accept="image,pdf/*">
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="urgentDoubt" name="is_urgent" value="1">
            <label class="form-check-label" for="urgentDoubt">Mark as urgent</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-warning">Submit Doubt</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection