@extends('layouts.faculty')

@section('content')
<style>
    .w-fit { width: fit-content; }
    .transition-icon { transition: transform 0.3s; }
    .accordion-toggle[aria-expanded="true"] .transition-icon {
        transform: rotate(90deg);
        color: #0d6efd !important;
    }
    .table-hover tbody tr.accordion-toggle:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
</style>
<div class="faculty-main" id="facultyMain">
  <div class="faculty-topbar">
    <div class="faculty-topbar-title">
      <h4><i class="fas fa-comments me-2"></i>Student Queries & Doubts</h4>
      <small>Respond to student queries and concerns</small>
    </div>
  </div>
  <div class="form-section">
    <h5 class="form-section-title text-warning"><i class="fas fa-hourglass-half me-2"></i>Pending Queries</h5>
    <div class="faculty-table-container mt-3">
      <table class="table table-hover border">
        <thead class="table-light">
          <tr>
            <th>Student Name</th>
            <th>Subject/Topic</th>
            <th>Query Title</th>
            <th>Posted At</th>
            <th>Priority</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($queries->where('status', 'open') as $item)
          <tr>
            <td>
              <strong> {{ ucwords(userNameById($item->user_id)) }}</strong>
            </td>
            <td>
              <span class="badge bg-info text-dark">
                {{ $item->subject->name ?? 'General' }}
              </span>
            </td>

            <td>
              {{ Str::limit($item->title, 40) }}
            </td>

            <td>
              {{ $item->created_at->diffForHumans() }}
            </td>

            <td>
              @if($item->is_urgent)
              <span class="badge bg-danger">
                Urgent
              </span>
              @else
              <span class="badge bg-secondary">
                Normal
              </span>
              @endif
            </td>

            <td>
              <button class="btn btn-sm btn-gold" data-bs-toggle="modal" data-bs-target="#replyModal{{ $item->id }}"><i class="fas fa-reply me-1"></i> Reply </button>
            </td>
          </tr>
          <!-- Modal -->
          <div class="modal fade" id="replyModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title">
                    <i class="fas fa-reply me-2"></i>
                    Reply to Student Query
                  </h5>
                  <button type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                  </button>
                </div>
                <!-- IMPORTANT -->
                <form action="{{ route('faculty.queries.reply', $item->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <div class="mb-3 p-3 bg-light rounded">
                      <h6 class="fw-bold mb-2">
                        Student :{{ userNameById($item->user_id) }} </h6>
                      <p class="mb-1"> <strong>Title :</strong> {{ $item->title }} </p>
                      <p class="mb-0 text-muted">{{ $item->description }}</p>
                    </div>
                    <div class="mb-3">
                      <label class="form-label fw-bold">Faculty Response </label>
                      <input type="hidden" name="query_id">
                      <textarea name="response" class="form-control" rows="5" required placeholder="Write your response here..."></textarea>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">
                        Attachment (Optional)
                      </label>
                      <input type="file" name="attachment" class="form-control">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel </button>
                    <button type="submit" class="btn btn-gold"> <i class="fas fa-paper-plane me-2"></i> Send Reply </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          @empty
          <tr>
            <td colspan="6" class="text-center text-muted"> No pending queries found. </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!-- Query Response -->
  {{--<div class="row mt-4">
    <div class="col-lg-8">
      <div class="form-section">
        <h5 class="form-section-title">
          <i class="fas fa-reply me-2"></i>Respond to Query
        </h5>

        <div style="background: var(--faculty-bg); padding: 20px; border-radius: 8px; margin-bottom: 20px;">
          <h6 class="fw-bold mb-2">Query from: Aman Singh</h6>
          <p class="mb-0"><strong>Question:</strong> How to solve integration by parts?</p>
          <p class="text-muted mb-0"><small>Posted 30 minutes ago</small></p>
        </div>

        <form id="replyForm">
          <div class="mb-3">
            <label class="form-label">Your Response</label>
            <textarea class="form-control" rows="5" placeholder="Type your detailed response here..."></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Attach Resources (Optional)</label>
            <input type="file" class="form-control">
          </div>

          <button type="submit" class="btn btn-gold">
            <i class="fas fa-send me-2"></i>Send Reply
          </button>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-section">
        <h5 class="form-section-title">
          <i class="fas fa-lightbulb me-2"></i>Response Tips
        </h5>

        <div class="alert alert-info">
          <ul class="mb-0 small">
            <li>Be clear and concise</li>
            <li>Provide step-by-step explanation</li>
            <li>Include relevant examples</li>
            <li>Attach helpful resources</li>
            <li>Encourage follow-up questions</li>
          </ul>
        </div>
      </div>

      <div class="form-section mt-3">
        <h6 class="fw-bold mb-3">Quick Templates</h6>
        <button class="btn btn-outline-primary-faculty w-100 mb-2 text-start text-truncate">
          <i class="fas fa-plus me-1"></i>General Concept Explanation
        </button>
        <button class="btn btn-outline-primary-faculty w-100 mb-2 text-start text-truncate">
          <i class="fas fa-plus me-1"></i>Problem-Solving Guide
        </button>
        <button class="btn btn-outline-primary-faculty w-100 text-start text-truncate">
          <i class="fas fa-plus me-1"></i>Topic Summary
        </button>
      </div>
    </div>
  </div>--}}

  <!-- Resolved Queries -->
  <div class="form-section mt-4">
    <h5 class="form-section-title">
      <i class="fas fa-question-circle me-2"></i>Recently Received Queries
    </h5>

    <div class="faculty-table-container">
      <table class="table table-hover align-middle" style="border-collapse: collapse;">
        <thead class="bg-light">
          <tr>
            <th style="width: 5%"></th> <!-- Icon Column -->
            <th style="width: 25%">Student Info</th>
            <th style="width: 40%">Query Title & Details</th>
            <th style="width: 15%">Status & Urgency</th>
            <th style="width: 15%">Posted Date</th>
          </tr>
        </thead>
        <tbody>
          @forelse($queries as $query)
          <!-- Main Information Row -->
          <tr data-bs-toggle="collapse" data-bs-target="#details-{{ $query['id'] }}" class="accordion-toggle" style="cursor: pointer;">
            <td class="text-center">
              <i class="fas fa-chevron-right text-muted transition-icon"></i>
            </td>
            <td>
              <div class="fw-bold text-dark">{{ ucwords(userNameById($query['posted_by'])) }}</div>
              <small class="text-muted">Subject: {{ getSubjectNameById($query['subject_id']) }}</small>
            </td>
            <td>
              <div class="fw-bold text-primary">{{ ucwords($query['title']) }}</div>
              <small class="text-muted text-truncate d-block" style="max-width: 300px;">
                {{ $query['description'] }}
              </small>
            </td>
            <td>
              @if($query['is_urgent'])
              <span class="badge bg-danger mb-1">Urgent</span>
              @endif

              @if($query['status'] == 'resolved')
              <span class="badge bg-soft-success text-success border border-success d-block w-fit">Resolved</span>
              @else
              <span class="badge bg-soft-warning text-warning border border-warning d-block w-fit">Open</span>
              @endif
            </td>
            <td>
              <div class="small">
                {{ \Carbon\Carbon::parse($query['created_at'])->format('d M, Y') }}<br>
                <small class="text-muted">{{ \Carbon\Carbon::parse($query['created_at'])->format('h:i A') }}</small>
              </div>
            </td>
          </tr>

          <!-- Hidden Detail Row (Faculty Info) -->
          <tr>
            <td colspan="5" class="p-0 border-0">
              <div class="collapse" id="details-{{ $query['id'] }}">
                <div class="p-4 bg-light border-start border-4 {{ $query['status'] == 'resolved' ? 'border-success' : 'border-warning' }} m-2 rounded shadow-sm">
                  <div class="row">
                    <div class="col-md-6">
                      <label class="fw-bold text-secondary small text-uppercase">Student Query Detail</label>
                      <p class="text-dark">{{ $query['description'] }}</p>
                      @if($query['image_path'])
                      <a href="{{ asset('storage/' . $query['image_path']) }}" target="_blank" class="btn btn-sm btn-outline-info mt-2">
                        <i class="fas fa-image me-1"></i> View Student Attachment
                      </a>
                      @endif
                    </div>

                    @if($query['status'] == 'resolved')
                    <div class="col-md-6 border-start">
                      <label class="fw-bold text-success small text-uppercase">Faculty Resolution</label>
                      <div class="p-2 bg-white border rounded">
                        <p class="mb-2"><strong>Reply:</strong> {{ $query['faculty_reply'] }}</p>
                        @if($query['faculty_attachment'])
                        <a href="{{ asset('storage/' . $query['faculty_attachment']) }}" target="_blank" class="btn btn-sm btn-success">
                          <i class="fas fa-paperclip me-1"></i> Download Solution
                        </a>
                        @endif
                      </div>
                      <small class="text-muted d-block mt-2">Updated: {{ \Carbon\Carbon::parse($query['updated_at'])->format('d M, Y | h:i A') }}</small>
                    </div>
                    @else
                    <div class="col-md-6 border-start d-flex align-items-center justify-content-center">
                      <span class="text-muted italic">Waiting for faculty response...</span>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center py-5 text-muted">No queries found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection