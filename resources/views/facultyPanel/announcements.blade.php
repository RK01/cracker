@extends('layouts.faculty')
@section('content')
<div class="faculty-main" id="facultyMain">
  <!-- Top Bar -->
  <div class="faculty-topbar">
    <div class="faculty-topbar-title">
      <h4><i class="fas fa-bullhorn me-2"></i>Announcements</h4>
      <small>Communicate important updates to students</small>
    </div>
  </div>

  <!-- Create Announcement -->
  <div class="row">
    <div class="col-lg-8">
      <div class="form-section">
        <h5 class="form-section-title">
          <i class="fas fa-plus-circle me-2"></i>Create New Announcement
        </h5>
        <form action="{{ route('faculty.announcement.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- Announcement Title -->
          <div class="mb-3">
            <label class="form-label">Announcement Title</label>
            <input type="text" name="announcement_title" value="{{ old('announcement_title') }}" class="form-control @error('announcement_title') is-invalid @enderror" placeholder="e.g., Test Schedule Announcement" required>
            @error('announcement_title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="row">
            <!-- Select Course -->
            <div class="col-4">
              <div class="mb-3">
                <label class="form-label">Select Course</label>
                <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                  <option value="">Select Course</option>
                  @foreach($courses as $course)
                  <option value="{{ $course->id }}" @selected(old('course_id')==$course->id)> {{ $course->name }}</option>
                  @endforeach
                </select>
                @error('course_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Select Sub Course -->
            <div class="col-4">
              <div class="mb-3">
                <label class="form-label">Select Sub Course</label>
                <select name="sub_cat_course_id" class="form-select @error('sub_cat_course_id') is-invalid @enderror" required>
                  <option value="">Select Sub Course</option>
                  @foreach(mySubCourestIds() as $CategoryName)
                  <option value="{{ $CategoryName }}" {{ old('sub_cat_course_id') == $CategoryName ? 'selected' : '' }}> {{ getSubCatCourseNameById($CategoryName) }}</option>
                  @endforeach
                </select>
                @error('sub_cat_course_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Select Subject -->
            <div class="col-4">
              <div class="mb-3">
                <label class="form-label">Select Subject </label>
                <select name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                  <option value="">Select Subject</option>
                  <option value="{{ mySubjectId() }}" {{ old('subject_id', mySubjectId()) == mySubjectId() ? 'selected' : '' }}>
                    {{ getSubjectNameById(mySubjectId()) }}
                  </option>
                </select>
                @error('subject_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <!-- Announcement Message -->
          <div class="mb-3">
            <label class="form-label">Announcement Message</label>
            <textarea name="announcement_message" class="form-control @error('announcement_message') is-invalid @enderror" rows="5" placeholder="Type your announcement here..." required>{{ old('announcement_message') }}</textarea>
            @error('announcement_message')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="row">
            <!-- Priority Level -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Priority Level</label>
              <select name="priority" class="form-select @error('priority') is-invalid @enderror" required>
                <option value="normal" @selected(old('priority')=='normal' )>Normal</option>
                <option value="high" @selected(old('priority')=='high' )>High</option>
              </select>
              @error('priority')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Posted By -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Posted By</label>
              <input type="text" name="posted_by" class="form-control" value="{{ auth()->user()->name }}" readonly>
            </div>
          </div>

          <!-- Attach File -->
          <div class="mb-3">
            <label class="form-label">Attach File</label>
            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
            @error('file')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <button type="submit" class="btn btn-gold">
            <i class="fas fa-send me-2"></i>Publish Announcement
          </button>

          <!-- Active Clear Button -->
          <button type="reset" class="btn btn-outline-primary-faculty ms-2" onclick="return confirm('Are you sure you want to clear the form?')">
            <i class="fas fa-undo me-2"></i>Clear
          </button>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-section" style="height: 95%;">
        <h5 class="form-section-title">
          <i class="fas fa-lightbulb me-2"></i>Announcement Tips
        </h5>

        <div class="alert alert-info">
          <strong>Best Practices:</strong>
          <ul class="mb-0 mt-2 small">
            <li>Use clear subject lines</li>
            <li>Keep messages concise</li>
            <li>Include important dates/times</li>
            <li>Mark urgent items clearly</li>
            <li>Proofread before publishing</li>
          </ul>
        </div>

        <div class="form-section mt-3">
          <h6 class="fw-bold mb-2">Statistics</h6>
          <div class="mb-2 p-2" style="background: var(--faculty-bg); border-radius: 6px;">
            <p class="mb-1 small"><strong>Total Announcements:</strong> 24</p>
            <p class="mb-0 small"><strong>This Month:</strong> 8</p>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Announcement Statistics -->
  <div class="row mt-4">
    <div class="col-lg-12">
      <!-- Recent Announcements -->
      <div class="form-section">
        <h5 class="form-section-title">
          <i class="fas fa-list me-2"></i>Recent Announcements
        </h5>
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-hover align-middle shadow-sm border">
                <thead class="table-info">
                  <tr>
                    <th>Date & Time</th>
                    <th>Announcement Title</th>
                    <th>Message</th>
                    <th>Priority</th>
                    <th>Attachment</th>
                    {{-- <th class="text-center">Action</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @forelse($announcements as $announcement)
                  <tr>
                    <!-- Date & Time -->
                    <td style="white-space: nowrap;">
                      <div class="fw-bold">{{ \Carbon\Carbon::parse($announcement->created_at)->format('d M, Y') }}</div>
                      <small class="text-muted"><i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($announcement->created_at)->format('h:i A') }}</small>
                    </td>

                    <!-- Title -->
                    <td>
                      <span class="fw-bold text-dark">{{ ucwords($announcement->announcement_title) }}</span>
                    </td>

                    <!-- Message -->
                    <td>
                      <div title="{{ $announcement->announcement_message }}" style="cursor: pointer;">
                        {{ Str::limit($announcement->announcement_message, 50) }}
                      </div>
                    </td>

                    <!-- Priority Badge -->
                    <td>
                      @if($announcement->priority == 'high')
                      <span class="badge bg-danger">
                        <i class="fas fa-exclamation-circle me-1"></i>High
                      </span>
                      @else
                      <span class="badge bg-success">
                        <i class="fas fa-info-circle me-1"></i>Normal
                      </span>
                      @endif
                    </td>

                    <!-- File Attachment -->
                    <td>
                      @if($announcement->file)
                      <a href="{{ asset('storage/announcements/' . $announcement->file) }}" target="_blank" class="text-decoration-none">
                        @if(Str::endsWith($announcement->file, '.pdf'))
                        <i class="fas fa-file-pdf text-danger fa-lg"></i>
                        @else
                        <i class="fas fa-file-image text-primary fa-lg"></i>
                        @endif
                        <small class="ms-1 text-muted">View File</small>
                      </a>
                      @else
                      <span class="text-muted small">No File</span>
                      @endif
                    </td>

                    <!-- Action Buttons -->
                    {{--<td class="text-center">
                      <div class="btn-group">
                        <button class="btn btn-sm btn-outline-primary" title="Edit">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger" title="Delete">
                          <i class="fas fa-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>--}}
                  @empty
                  <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                      <i class="fas fa-bullhorn d-block mb-2 fa-3x"></i>
                      <h5>No announcements found</h5>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{--<div class="col-lg-4">
      <div class="form-section">
        <h5 class="form-section-title">
          <i class="fas fa-info-circle me-2"></i>Engagement Stats
        </h5>

        <div class="mb-3 p-3" style="background: var(--faculty-bg); border-radius: 8px;">
          <p class="mb-1"><strong>Total Announcements:</strong> 24</p>
          <p class="mb-1"><strong>Average Views:</strong> 210</p>
          <p class="mb-0"><strong>Avg. View Rate:</strong> 85.7%</p>
        </div>

        <div class="mb-3">
          <p class="mb-2"><strong>Most Viewed (This Month):</strong></p>
          <div class="p-2" style="background: var(--faculty-bg); border-radius: 6px;">
            <p class="mb-0 small">JEE Mains Mock Test Schedule</p>
          </div>
        </div>

        <button class="btn btn-gold w-100">
          <i class="fas fa-download me-2"></i>View Analytics
        </button>
      </div>
    </div>--}}
  </div>
</div>
@endsection