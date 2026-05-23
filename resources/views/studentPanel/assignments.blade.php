@extends('layouts.student')
@section('content')
<!-- Assignments Content -->
<div class="container py-4">
  <div class="faculty-topbar">
    <div class="faculty-topbar-title">
      <h4><i class="fas fa-video me-2"></i>assignments</h4>
      <small>Add new video lectures to your courses</small>
    </div>
  </div>
  <!-- Assignment Stats -->
  <div class="row mb-4">
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-warning mb-2" style="font-size: 2rem;"><i class="bi bi-clipboard-check"></i></div>
          <h4 class="mb-1">{{ $stats['completed_count'] }}</h4>
          <small class="text-muted">Completed</small>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-danger mb-2" style="font-size: 2rem;"><i class="bi bi-clock"></i></div>
          <h4 class="mb-1">{{ $stats['pending_count'] }}</h4>
          <small class="text-muted">Pending</small>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-success mb-2" style="font-size: 2rem;"><i class="bi bi-check-circle"></i></div>
          <h4 class="mb-1">{{ number_format($stats['avg_score'], 2) }}%</h4>
          <small class="text-muted">Avg Score</small>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-info mb-2" style="font-size: 2rem;"><i class="bi bi-calendar-event"></i></div>
          <h4 class="mb-1">{{ $stats['due_today'] }}</h4>
          <small class="text-muted">Due Today</small>
        </div>
      </div>
    </div>
  </div>

  <!-- Assignment Tabs -->
  <div class="card shadow-sm">
    <div class="card-header bg-light">
      <ul class="nav nav-tabs card-header-tabs" id="assignmentTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">Pending <span class="badge bg-danger ms-1">{{ $stats['pending_count'] }}</span></button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="submitted-tab" data-bs-toggle="tab" data-bs-target="#submitted" type="button" role="tab">Submitted <span class="badge bg-warning ms-1">{{ $stats['submitted_count'] }}</span></button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab">Completed <span class="badge bg-success ms-1">{{ $stats['completed_count'] }}</span></button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <div class="tab-content" id="assignmentTabContent">
        <!-- Pending Assignments -->
        <div class="tab-pane fade show active" id="pending" role="tabpanel">
          <div class="assignment-list">
            <!-- Urgent Assignment -->
            @foreach($pending as $item)
            @php
            $isUrgent = \Carbon\Carbon::parse($item->due_date)->isToday();
            @endphp

            <div class="card {{ $isUrgent ? 'border-danger' : '' }} mb-3">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-md-8">
                    <div class="d-flex align-items-start">
                      <div class="text-danger me-3" style="font-size: 1.5rem;"><i class="bi bi-exclamation-triangle"></i></div>
                      <div>
                        <h6 class="card-title mb-1">{{ $item->title }}</h6>
                        <p class="card-text small text-muted mb-2">{{ $item->description }}</p>
                        <div class="mb-2">
                          <span class="badge bg-primary"> {{ getCourseNameById($item->course_id) }}</span>
                          <span class="badge bg-secondary"> {{ getCourseSubCategoriesByPurchase($item->sub_cat_course_id)->name }}</span>
                          <span class="badge bg-success me-2">{{ getSubjectNameById($item->subject_id) }}</span>
                          <small class="text-muted ms-2"><i class="bi bi-calendar"></i> Due: {{ \Carbon\Carbon::parse($item->due_date)->format('d M, h:i A') }}</small>
                        </div>

                        <small class="text-muted">Posted by: {{ userNameById($item->posted_by) }} • {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 text-end">
                    @if($isUrgent)
                    <span class="badge bg-danger mb-2">Due Today</span><br>
                    @endif
                    <button class="btn btn-warning btn-sm">
                      <i class="bi bi-eye"></i> &nbsp<a href="{{ asset('storage/' . $item->file_path) }}" class="text-decoration-none text-white" target="_blank">View Document</a>
                    </button>

                    <button class="btn btn-warning btn-sm" onclick="openSubmitModal({{ $item->id }}, '{{ $item->title }}')">
                      <i class="bi bi-upload"></i> Submit Now
                    </button>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="d-flex justify-content-end mt-3">
            {{ $pending->withQueryString()->links('pagination::bootstrap-5') }}
          </div>
        </div>

        <!-- Submitted Assignments -->
        <div class="tab-pane fade" id="submitted" role="tabpanel">
          <div class="assignment-list">
           
            @foreach($submitted as $item)
            @php
            $isUrgent = \Carbon\Carbon::parse($item->assignment->due_date)->isToday();
            @endphp
            <div class="card {{ $isUrgent ? 'border-danger' : '' }} mb-3">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-md-8">
                    <div class="d-flex align-items-start">
                      <div class="text-danger me-3" style="font-size: 1.5rem;"><i class="bi bi-exclamation-triangle"></i></div>
                      <div>
                        <h6 class="card-title mb-1">{{ $item->assignment->title }}</h6>
                        <p class="card-text small text-muted mb-2">{{ $item->assignment->description }}</p>
                        <div class="mb-2">
                          <span class="badge bg-secondary">{{ getSubCatCourseNameById($item->assignment->sub_cat_course_id) }}</span>
                          <span class="badge bg-primary me-2">{{ getSubjectNameById($item->assignment->subject_id) }}</span>
                          <small class="text-muted ms-2"><i class="bi bi-calendar"></i> Due Date: {{ \Carbon\Carbon::parse($item->assignment->due_date)->format('M d, h:i A') }}</small>
                        </div>

                        <small class="text-muted">Posted by: {{ userNameById($item->assignment->posted_by) }} • {{ \Carbon\Carbon::parse($item->assignment->created_at)->diffForHumans() }}</small><br>
                        <small class="text-muted">Submmited at: {{ \Carbon\Carbon::parse($item->assignment->submitted_at_user)->format('M d, h:i A') }}</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 text-end">
                    @if($isUrgent)
                    <span class="badge bg-danger mb-2">Due Today</span><br>
                    @endif
                    
                    <button class="btn btn-warning btn-sm">
                      <i class="bi bi-eye"></i> &nbsp<a href="{{ asset('storage/' . $item->file_path) }}" class="text-decoration-none text-white" target="_blank">View Document</a>
                    </button>
                  
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="d-flex justify-content-end mt-3">
            {{ $submitted->withQueryString()->links('pagination::bootstrap-5') }}
          </div>
        </div>

        <!-- Completed Assignments -->
        <div class="tab-pane fade" id="completed" role="tabpanel">
          <div class="assignment-list">
            @foreach($completed as $item)
            @php
            $isUrgent = \Carbon\Carbon::parse($item->due_date)->isToday();
            @endphp
            <div class="card border-success mb-3">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-md-8">
                    <div class="d-flex align-items-start">
                      <div class="text-danger me-3" style="font-size: 1.5rem;"><i class="bi bi-exclamation-triangle"></i></div>
                      <div>
                        <h6 class="card-title mb-1">{{ $item->assignment->title }}</h6>
                        <p class="card-text small text-muted mb-2">{{ $item->assignment->description }}</p>
                        <div class="mb-2">
                          <span class="badge bg-secondary">{{ getSubCatCourseNameById($item->assignment->sub_cat_course_id) }}</span>
                          <span class="badge bg-primary me-2">{{ getSubjectNameById($item->assignment->subject_id) }}</span>
                          <small class="text-muted ms-2"><i class="bi bi-calendar"></i> Due Date: {{ \Carbon\Carbon::parse($item->assignment->due_date)->format('M d, h:i A') }}</small>
                        </div>

                        <small class="text-muted">Posted by: {{ userNameById($item->assignment->posted_by) }} • {{ \Carbon\Carbon::parse($item->assignment->created_at)->diffForHumans() }}</small><br>
                        <small class="text-muted">Complited at: {{ \Carbon\Carbon::parse($item->assignment->completed_at_faculty)->format('M d, h:i A') }}</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 text-end">
                      <button class="btn btn-warning btn-sm">
                        <i class="bi bi-eye"></i> &nbsp<a href="{{ asset('storage/' . $item->file_path) }}" class="text-decoration-none text-white" target="_blank">View Document</a>
                      </button>
                    
                    <p><span class="badge text-bg-success my-2 px-4 py-2">Complited</span></p><br>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="d-flex justify-content-end mt-3">
            {{ $submitted->withQueryString()->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Submit Assignment Modal -->
<div class="modal fade" id="submitModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Submit Assignment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="submitForm" method="POST" action="{{ route('student.assignments.submit') }}" enctype="multipart/form-data">
          @csrf

          <input type="hidden" name="assignment_id" id="assignment_id">

          <div class="mb-3">
            <label class="form-label">Upload Solution *</label>
            <input type="file" name="file" class="form-control" id="assignmentFile"
              accept=".pdf,.doc,.docx,.jpg,.png" required>
            <small class="text-muted">
              Accepted formats: PDF, DOC, DOCX, JPG, PNG (Max 10MB)
            </small>
          </div>

          <div class="mb-3">
            <label class="form-label">Additional Comments (Optional)</label>
            <textarea class="form-control" name="comments_by_user" rows="3"
              placeholder="Any additional notes or explanations..."></textarea>
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" required>
            <label class="form-check-label">
              I confirm that this is my original work.
            </label>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-warning">
              Submit Assignment
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<script>
  function openSubmitModal(id, title) {
    document.getElementById('assignment_id').value = id;
    document.querySelector('#submitModal .modal-title').innerText = "Submit: " + title;

    let modal = new bootstrap.Modal(document.getElementById('submitModal'));
    modal.show();
  }
</script>
@endsection