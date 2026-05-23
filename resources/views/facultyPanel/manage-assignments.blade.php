@extends('layouts.faculty')

@section('content')
<div class="faculty-main" id="facultyMain">

  <div class="faculty-topbar d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="mb-0"><i class="fas fa-tasks me-2"></i> Manage Assignments</h4>
      <p class="text-muted small mb-0">Track student progress and evaluate submissions</p>
    </div>
  </div>

  <!-- Stats Cards -->

  <div class="row g-3 mb-4">
    <div class="col-md-3">
      <div class="card border-0 shadow-sm p-3">
        <div class="d-flex align-items-center">
          <div class="bg-primary text-white p-3 rounded me-3"><i class="fas fa-tasks"></i></div>
          <div><small class="text-muted">Total</small>
            <h5 class="mb-0 fw-bold">{{ $stats['total'] }}</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 shadow-sm p-3">
        <div class="d-flex align-items-center">
          <div class="bg-success text-white p-3 rounded me-3"><i class="fas fa-check-circle"></i></div>
          <div><small class="text-muted">Active</small>
            <h5 class="mb-0 fw-bold">{{ $stats['active'] }}</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 shadow-sm p-3">
        <div class="d-flex align-items-center">
          <div class="bg-warning text-white p-3 rounded me-3"><i class="fas fa-book"></i></div>
          <div><small class="text-muted">Notes</small>
            <h5 class="mb-0 fw-bold">{{ $stats['notes'] }}</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 shadow-sm p-3">
        <div class="d-flex align-items-center">
          <div class="bg-danger text-white p-3 rounded me-3"><i class="fas fa-clock"></i></div>
          <div><small class="text-muted">Expired</small>
            <h5 class="mb-0 fw-bold">{{ $stats['expired'] }}</h5>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Assignment Table -->
  <div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 py-3">
      <form method="GET">
        <div class="row g-2">
          <div class="col-md-5">
            <input type="text" class="form-control" placeholder="Search assignments..." name="search" value="{{ request('search') }}">
          </div>
          <div class="col-md-3">
            <select class="form-select" name="type">
              <option value="">All Types</option>
              <option value="assignment">Assignment</option>
              <option value="notes">Notes</option>
            </select>
          </div>
          <div class="col-md-3">
            <select class="form-select" name="status">
              <option value="">All Status</option>
              <option value="active">Active</option>
              <option value="expired">Expired</option>
            </select>
          </div>
          <div class="col-md-1">
            <input type="submit" value="filter" class="btn btn-warning">
          </div>
        </div>

      </form>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-info" style="background-color: #123c6e;">
          <tr>
            <th class="ps-4">Title</th>
            <th>Type</th>
            <th>Due Date</th>
            <th>Size</th>
            <th>Status</th>
            <th class="text-end pe-4">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($assignments as $assignment)
          @php
          $isExpired = \Carbon\Carbon::parse($assignment->due_date)->isPast();
          @endphp
          <tr>
            <td class="ps-4">
              <span class="fw-bold">{{ $assignment->title }}</span>
              <div class="small text-muted text-truncate" style="max-width: 200px;">{{ $assignment->description }}</div>
            </td>
            <td>
              <span class="badge {{ $assignment->type == 'assignment' ? 'bg-warning text-dark' : 'bg-success' }}">
                {{ ucfirst($assignment->type) }}
              </span>
            </td>
            <td>{{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y') }}</td>
            <td>{{ number_format($assignment->file_size / 1024, 2) }} KB</td>
            <td>
              <span class="badge {{ $isExpired ? 'bg-soft-danger text-danger' : 'bg-soft-success text-success' }}"
                style="background-color: {{ $isExpired ? '#f8d7da' : '#d1e7dd' }}">
                {{ $isExpired ? 'Expired' : 'Active' }}
              </span>
            </td>
            <td class="text-end pe-4">
              <div class="btn-group">
                <a href="{{ asset('storage/' . $assignment->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary border">
                  <i class="fas fa-eye"></i>
                </a>
                <button class="btn btn-sm btn-outline-success border" type="button" data-bs-toggle="collapse" data-bs-target="#subTable{{ $assignment->id }}">
                  <i class="fas fa-users me-1"></i> ({{ $assignment->student->count() }})
                </button>
              </div>
            </td>
          </tr>

          <!-- Accordion Submissions Table -->
          <tr class="collapse" id="subTable{{ $assignment->id }}">
            <td colspan="6" class="p-0 border-0">
              <div class="p-4 bg-light rounded-bottom mx-2 mb-2">
                <h6 class="fw-bold text-primary mb-3"><i class="fas fa-user-graduate me-2"></i>Student Submissions</h6>
                @if($assignment->student->isNotEmpty())
                <div class="table-responsive">
                  <table class="table table-sm table-borderless align-middle bg-white rounded shadow-sm">
                    <thead class="border-bottom">
                      <tr class="text-muted small">
                        <th class="ps-3">STUDENT</th>
                        <th>FILE</th>
                        <th>SUBMITTED AT</th>
                        <th>STATUS</th>
                        <th class="text-end pe-3">ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($assignment->student as $student)
                      <tr>
                        <td class="ps-3 fw-bold">{{ userNameById($student->user_id) }}</td>
                        <td>
                          <a href="{{ asset('storage/' . $student->file_path) }}" target="_blank" class="btn btn-link btn-sm p-0 text-decoration-none">
                            <i class="fas fa-file-download me-1"></i> View File
                          </a>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($student->submitted_at_user)->format('d M, h:i A') }}</td>
                        <td>
                          <span class="badge rounded-pill {{ $student->status == 'accepted' ? 'bg-success' : ($student->status == 'rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                            {{ ucfirst($student->status) }}
                          </span>
                        </td>
                        <td class="text-end pe-3">
                          <!-- Review Button -->
                          <button class="btn btn-sm btn-primary rounded-pill px-3"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#reviewModal{{ $student->id }}">
                            Review
                          </button>
                        </td>
                      </tr>

                      <!-- Review Modal (Inside the loop, but as a direct child of body or table-container is safer) -->
                      <div class="modal fade" id="reviewModal{{ $student->id }}" tabindex="-1" aria-labelledby="reviewModalLabel{{ $student->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content text-start border-0 shadow">
                            <form action="{{ route('faculty.assignment-review') }}" method="POST">
                              @csrf
                              <div class="modal-header border-bottom-0">
                                <h5 class="modal-title fw-bold" id="reviewModalLabel{{ $student->id }}">Evaluate Submission</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <input type="hidden" name="submission_id" value="{{ $student->id }}">

                                <div class="mb-3 bg-light p-2 rounded">
                                  <small class="text-muted d-block">Student Name:</small>
                                  <span class="fw-bold text-dark">{{ userNameById($student->user_id) }}</span>
                                </div>

                                <div class="row g-3">
                                  <div class="col-md-6">
                                    <label class="form-label small fw-bold">Score (1 - 10)</label>
                                    <input type="number" name="score_by_faculty" class="form-control" min="0" max="100" required placeholder="0">
                                  </div>
                                  <div class="col-md-6">
                                    <label class="form-label small fw-bold">Decision</label>
                                    <select name="status" class="form-select" required>
                                      <option value="accepted">Accepted / Pass</option>
                                      <option value="rejected">Rejected / Fail</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="mt-3">
                                  <label class="form-label small fw-bold">Faculty Feedback</label>
                                  <textarea name="comments_by_faculty" class="form-control" rows="4" required placeholder="Write your comments here..."></textarea>
                                </div>
                              </div>
                              <div class="modal-footer border-top-0 pt-0">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary px-4">Submit Review</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                @else
                <div class="text-center py-3 text-muted small">No submissions found for this task.</div>
                @endif
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center py-5 text-muted">No assignments found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Bottom Section -->
  <div class="row mt-4">
    <!-- Assignment Details -->
    <div class="col-lg-8">
      <div class="form-section">
        <h5 class="form-section-title">
          <i class="fas fa-user me-2"></i>Student Submissions - Weekly Practice Sheet
        </h5>

        <div class="faculty-table-container">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>Student Info</th>
                <th>Contact Details</th>
                <th>Submission Status</th>
                <th>Submitted File</th>
                <th>Score/Marks</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>

            <tbody>
              @forelse($getAllStudents as $student)
              @php
              // Check if student has any submission
              $submission = $student->submissions[0] ?? null;
              @endphp
              <tr>
                <!-- Student Info -->
                <td>
                  <div class="d-flex align-items-center">
                    <div class="avatar-sm me-2 bg-light rounded-circle text-center" style="width: 35px; height: 35px; line-height: 35px;">
                      <i class="fas fa-user text-secondary"></i>
                    </div>
                    <div>
                      <div class="fw-bold text-dark">{{ ucwords($student->name) }}</div>
                      <small class="text-primary">{{ $student->username }}</small>
                    </div>
                  </div>
                </td>

                <!-- Contact -->
                <td>
                  <small><i class="fas fa-envelope text-muted"></i> {{ $student->email }}</small><br>
                  <small><i class="fas fa-phone text-muted"></i> {{ $student->phone }}</small>
                </td>

                <!-- Submission Status -->
                <td>
                  @if($submission)
                  <span class="badge bg-success-soft text-success border border-success">
                    <i class="fas fa-check-circle me-1"></i> Submitted
                  </span>
                  <div class="small text-muted mt-1">
                    {{ \Carbon\Carbon::parse($submission['submitted_at_user'])->format('d M, h:i A') }}
                  </div>
                  @else
                  <span class="badge bg-danger-soft text-danger border border-danger">
                    <i class="fas fa-times-circle me-1"></i> Not Submitted
                  </span>
                  @endif
                </td>

                <!-- Submitted File -->
                {{$submission['file_path']}}
                <td>
                  @if($submission && $submission['file_path'])
                  <a href="{{ asset('storage/assignment/' . $submission['file_path']) }}" target="_blank" class="text-decoration-none">
                    <i class="fas fa-file-pdf text-danger fa-lg"></i>
                    <span class="small ms-1 text-truncate" style="max-width: 100px; display: inline-block;">View PDFs</span>
                  </a>
                  @else
                  <span class="text-muted small">---</span>
                  @endif
                </td>

                <!-- Score -->
                <td>
                  @if($submission && $submission['score_by_faculty'])
                  <span class="fw-bold text-success">{{ $submission['score_by_faculty'] }}</span>
                  @elseif($submission)
                  <span class="text-warning small italic">Not Graded</span>
                  @else
                  <span class="text-muted">---</span>
                  @endif
                </td>

                <!-- Action Button -->
                <td class="text-center">
                  @if($submission)
                  <button class="btn btn-sm btn-primary shadow-sm" title="Review Submission">
                    <i class="fas fa-edit"></i> Grade
                  </button>
                  @else
                  <button class="btn btn-sm btn-outline-secondary disabled">
                    <i class="fas fa-bell"></i> Remind
                  </button>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center py-5 text-muted">
                  <i class="fas fa-users-slash d-block mb-2 fa-3x"></i>
                  No records found.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    @php
    $total = $stats['total'] > 0 ? $stats['total'] : 1; // Zero division error se bachne ke liye
    $activeWidth = ($stats['active'] / $total) * 100;
    $expiredWidth = ($stats['expired'] / $total) * 100;
    $notesWidth = ($stats['notes'] / $total) * 100;
    @endphp

    <!-- Submission Stats -->
    <div class="col-lg-4">
      <div class="form-section">
        <h5 class="form-section-title">
          <i class="fas fa-bar-chart me-2"></i>
          Submission Stats
        </h5>
        <!-- Active -->
        <div class="mb-4">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="small text-muted">Active Assignments</span>
            <span class="fw-bold small">{{ $stats['active'] }}</span>
          </div>
          <div class="progress" style="height:8px; background-color: #e9ecef;">
            <div class="progress-bar bg-success"
              role="progressbar"
              style="width: {{ $activeWidth }}%"
              aria-valuenow="{{ $activeWidth }}"
              aria-valuemin="0"
              aria-valuemax="100">
            </div>
          </div>
        </div>

        <!-- Expired -->
        <div class="mb-4">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="small text-muted">Expired Tasks</span>
            <span class="fw-bold small">{{ $stats['expired'] }}</span>
          </div>
          <div class="progress" style="height:8px; background-color: #e9ecef;">
            <div class="progress-bar bg-danger"
              role="progressbar"
              style="width: {{ $expiredWidth }}%"
              aria-valuenow="{{ $expiredWidth }}"
              aria-valuemin="0"
              aria-valuemax="100">
            </div>
          </div>
        </div>
        <!-- Notes -->
        <div class="mb-3">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="small text-muted">Study Notes</span>
            <span class="fw-bold small">{{ $stats['notes'] }}</span>
          </div>
          <div class="progress" style="height:8px; background-color: #e9ecef;">
            <div class="progress-bar bg-warning"
              role="progressbar"
              style="width: {{ $notesWidth }}%"
              aria-valuenow="{{ $notesWidth }}"
              aria-valuemin="0"
              aria-valuemax="100">
            </div>
          </div>
        </div>
      </div>
      <hr>
      <!-- Summary -->
      <div class="mb-3 p-3"
        style="background: var(--faculty-bg); border-radius: 8px;">
        <p class="mb-1">
          <strong>Total Assignments:</strong>
          {{ $stats['total'] }}
        </p>
        <p class="mb-1">
          <strong>Latest Due Date:</strong>
          @if($assignments->count())
          {{-- {{ Carbon::parse($assignments->max('due_date'))->format('d M Y') }} --}}
          @else
          N/A
          @endif
        </p>
        <p class="mb-0">
          <strong>Total Notes:</strong>
          {{ $stats['total'] }}
        </p>
      </div>
      {{--<button class="btn btn-gold w-100">
        <i class="fas fa-download me-2"></i>
        Export Results
      </button>--}}
    </div>
  </div>

</div>

</div>
@endsection