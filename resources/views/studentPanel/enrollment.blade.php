@extends('layouts.student')
@section('content')
<!-- Enrollment Content -->
<div class="container py-4">
  <!-- Current Enrollment Status -->
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-light">
      <h5 class="mb-0"><i class="bi bi-book"></i> Current Enrollment Status</h5>
    </div>
    <div class="card-body">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h6 id="currentCourse">{{ $currentEnrollment->course->title ?? 'No course enrolled' }}</h6>
          <p class="text-muted mb-2" id="enrollmentDate">Enrollment Date: {{ $currentEnrollment ? $currentEnrollment->enrolled_at->format('d M, Y') : 'Not enrolled' }}</p>
          <div class="progress mb-2" style="height: 8px;">
            <div class="progress-bar bg-warning" id="courseProgress" style="width: {{ $currentEnrollment->progress ?? 0 }}%"></div>
          </div>
          <small class="text-muted">Course Progress: <span id="progressPercent">{{ $currentEnrollment->progress ?? 0 }}%</span></small>
        </div>
        <div class="col-md-4 text-end">
          <span class="badge bg-success fs-6" id="enrollmentStatus">Not Enrolled</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Available Courses -->
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-light d-flex justify-content-between align-items-center flex-wrap">
      <h5 class="mb-0"><i class="bi bi-grid"></i> Available Courses</h5>
      <div class="btn-group btn-group-sm mt-2" role="group">
        <input type="radio" class="btn-check" name="courseFilter" id="allCourses" autocomplete="off" checked onclick="filterCourses('all')">
        <label class="btn btn-outline-primary btn-sm" for="allCourses">All</label>

        <input type="radio" class="btn-check" name="courseFilter" id="engineering" autocomplete="off" onclick="filterCourses('engineering')">
        <label class="btn btn-outline-primary btn-sm" for="engineering">Engineering</label>

        <input type="radio" class="btn-check" name="courseFilter" id="medical" autocomplete="off" onclick="filterCourses('medical')">
        <label class="btn btn-outline-primary btn-sm" for="medical">Medical</label>

        <input type="radio" class="btn-check" name="courseFilter" id="other" autocomplete="off" onclick="filterCourses('other')">
        <label class="btn btn-outline-primary btn-sm" for="other">Other</label>
      </div>
    </div>
    <div class="card-body">
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-4">
              <input type="text" class="form-control" placeholder="Search classes..." id="searchInput">
            </div>
            <div class="col-md-3">
              <select class="form-select" id="subjectFilter">
                <option value="">All course categories</option>
                <option value="physics">Physics</option>
                <option value="chemistry">Chemistry</option>
                <option value="mathematics">Mathematics</option>
                <option value="biology">Biology</option>
              </select>
            </div>
            <div class="col-md-3">
              <select class="form-select" id="facultyFilter">
                <option value="">All Faculty</option>
                <option value="rajesh">Dr. Rajesh Kumar</option>
                <option value="priya">Dr. Priya Sharma</option>
                <option value="amit">Prof. Amit Singh</option>
                <option value="meera">Dr. Meera Patel</option>
              </select>
            </div>
            <div class="col-md-2">
              <select class="form-select" id="sortBy">
                <option value="date">Sort by Date</option>
                <option value="subject">Sort by Subject</option>
                <option value="views">Sort by Views</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="row" id="coursesContainer">
        @foreach($availableCourses as $course)
        <!-- JEE Advanced Course -->
        <div class="col-lg-6 mb-4" data-category="{{ $course->category }}">
          <div class="card h-100 border">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                  <h6 class="card-title mb-1">{{ $course->title }}</h6>
                  <small class="text-muted">{{ $course->subtitle }}</small>
                </div>
                <span class="{{ $course->category == 'engineering' ? 'badge bg-primary' : ($course->category == 'medical' ? 'badge bg-success' : 'badge bg-info') }}">
                  {{ ucfirst($course->category) }}
                </span>
              </div>
              <p class="card-text small text-muted mb-3">
                {{ Str::limit($course->description, 100) }}
              </p>
              <div class="row text-center mb-3">
                <div class="col-4">
                  <div class="text-primary mb-1"><i class="bi bi-calendar"></i></div>
                  <small>{{ $course->duration }}</small>
                </div>
                <div class="col-4">
                  <div class="text-success mb-1"><i class="bi bi-people"></i></div>
                  <small>{{ $course->student_count }}+ Students</small>
                </div>
                <div class="col-4">
                  <div class="text-warning mb-1"><i class="bi bi-star"></i></div>
                  <small>{{ $course->rating }} Rating</small>
                </div>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <span class="fw-bold text-primary">₹{{ number_format($course->discount_price) }}</span>
                  <small class="text-muted text-decoration-line-through">₹{{ number_format($course->price) }}</small>
                </div>
                <button class="btn btn-warning btn-sm" onclick="enrollCourse('{{ $course->title }}')">Enroll Now</button>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        <div class="d-flex justify-content-end mt-3">
          {{ $availableCourses->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>

  <!-- Enrollment History -->
  <div class="card shadow-sm">
    <div class="card-header bg-light">
      <h5 class="mb-0"><i class="bi bi-clock-history"></i> Enrollment History</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Course</th>
              <th>Enrollment Date</th>
              <th>Status</th>
              <th>Progress</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="enrollmentHistory">
            @forelse($history as $historyd)
            <tr>
              <td>{{ $historyd->course->title }}</td>
              <td>{{ $historyd->enrolled_at->format('d M, Y') }}</td>
              <td>
                @if($historyd->status == 'active')
                <span class="badge bg-success">Active</span>
                @elseif($historyd->status == 'completed')
                <span class="badge bg-primary">Completed</span>
                @else
                <span class="badge bg-secondary">Inactive</span>
                @endif
              </td>
              <td>
                <div class="progress" style="height: 8px;">
                  <div class="progress-bar bg-warning" style="width: {{ $historyd->progress }}%"></div>
                </div>
                <small class="text-muted">{{ $historyd->progress }}% completed</small>
              </td>
              @empty
            <tr>
              <td colspan="5" class="text-center text-muted">No enrollment history available</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Enrollment Modal -->
<div class="modal fade" id="enrollmentModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Enrollment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="enrollmentDetails"></div>
        <div class="alert alert-info">
          <small><i class="bi bi-info-circle"></i> By enrolling, you agree to our terms and conditions. Payment will be processed securely.</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-warning" onclick="confirmEnrollment()">Confirm Enrollment</button>
      </div>
    </div>
  </div>
</div>
<script>
  function filterCourses(category) {
    const cards = document.querySelectorAll('#coursesContainer .col-lg-6');
    cards.forEach(card => {
      const cardCategory = card.getAttribute('data-category');

      if (category === 'all') {
        card.style.display = 'block';
      } else if (cardCategory === category) {
        card.style.display = 'block';
      } else {
        card.style.display = 'none';
      }
    });
  }
</script>
@endsection