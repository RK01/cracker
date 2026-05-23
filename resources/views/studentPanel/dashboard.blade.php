@extends('layouts.student')
@section('content')<!-- Dashboard Content -->
<section class="section-padding section-c-i-j">
  <div class="container">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-lg-3 mb-4">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <!-- Profile Icon -->
            <div class="mb-3">
              <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2rem;">
                {{-- Extracting first letter of the name if no image exists --}}
                {{ strtoupper(substr($profile->name ?? 'S', 0, 1)) }}
              </div>
            </div>

            <!-- Student Name -->
            <h5 id="studentFullName" class="mb-1 text-capitalize">
              {{ $profile->name ?? 'Guest Student' }}
            </h5>

            <!-- Username / Email -->
            <p class="text-muted small mb-2">
              @<span>{{ $profile->username }}</span>
            </p>

            <!-- Course ID (or use a helper to get name) -->
            <div class="mb-3">
              <span class="badge bg-light text-dark border">
                Course Name: {{ getCourseNameById($profile->course_id) }}
              </span>
            </div>

            <!-- Progress Bar (Static logic or calculated) -->
            <div class="progress mb-2" style="height: 6px;">
              <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted">75% Course Progress</small>

            <hr>

            <!-- Additional Contact Info from JSON -->
            <div class="text-start mt-2">
              <small class="d-block text-muted"><i class="bi bi-telephone me-2"></i>{{ $profile->phone }}</small>
              <small class="d-block text-muted"><i class="bi bi-envelope me-2"></i>{{ $profile->email }}</small>
            </div>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="card shadow-sm mt-3">
          <div class="card-header bg-light">
            <h6 class="mb-0"><i class="bi bi-lightning"></i> Quick Actions</h6>
          </div>
          <div class="card-body p-0">
            <div class="list-group list-group-flush">
              <a href="live-classes.html" class="list-group-item list-group-item-action">
                <i class="bi bi-play-circle-fill text-success"></i> Join Live Class
              </a>
              <a href="assignments.html" class="list-group-item list-group-item-action">
                <i class="bi bi-clipboard-check text-warning"></i> Submit Assignment
              </a>
              <a href="exams.html" class="list-group-item list-group-item-action">
                <i class="bi bi-pencil-square text-danger"></i> Take Quiz
              </a>
              <a href="doubts.html" class="list-group-item list-group-item-action">
                <i class="bi bi-chat-dots text-info"></i> Ask Doubt
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-lg-9">
        <!-- Welcome Section -->
        <div class="card shadow-sm mb-4">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h4 class="mb-2">Welcome back, <span id="welcomeName">Student</span>! 👋</h4>
                <p class="text-muted mb-0">Continue your learning journey. You have 3 upcoming classes this week.</p>
              </div>
              <div class="col-md-4 text-end">
                <div class="d-flex justify-content-end gap-2">
                  <button class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-calendar-event"></i> Schedule
                  </button>
                  <button class="btn btn-warning btn-sm">
                    <i class="bi bi-play-circle"></i> Watch Now
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
          <div class="col-md-3 mb-3">
            <div class="card shadow-sm text-center h-100">
              <div class="card-body">
                <div class="text-warning mb-2" style="font-size: 2rem;"><i class="bi bi-play-circle"></i></div>
                <h3 class="mb-1">24</h3>
                <small class="text-muted">Classes Watched</small>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card shadow-sm text-center h-100">
              <div class="card-body">
                <div class="text-success mb-2" style="font-size: 2rem;"><i class="bi bi-clipboard-check"></i></div>
                <h3 class="mb-1">8</h3>
                <small class="text-muted">Assignments Done</small>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card shadow-sm text-center h-100">
              <div class="card-body">
                <div class="text-info mb-2" style="font-size: 2rem;"><i class="bi bi-trophy"></i></div>
                <h3 class="mb-1">92%</h3>
                <small class="text-muted">Average Score</small>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card shadow-sm text-center h-100">
              <div class="card-body">
                <div class="text-primary mb-2" style="font-size: 2rem;"><i class="bi bi-calendar-check"></i></div>
                <h3 class="mb-1">95%</h3>
                <small class="text-muted">Attendance</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Activity & Upcoming Classes -->
        <div class="row">
          <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
              <div class="card-header bg-light">
                <h6 class="mb-0"><i class="bi bi-clock"></i> Upcoming Classes</h6>
              </div>
              <div class="card-body">
                <div class="upcoming-class mb-3 p-3 border rounded">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <h6 class="mb-1">Physics: Mechanics</h6>
                      <small class="text-muted">Dr. Rajesh Kumar</small>
                    </div>
                    <span class="badge bg-warning">Live</span>
                  </div>
                  <div class="mt-2">
                    <small class="text-muted"><i class="bi bi-calendar"></i> Today, 3:00 PM</small>
                  </div>
                  <button class="btn btn-warning btn-sm mt-2">Join Class</button>
                </div>
                <div class="upcoming-class mb-3 p-3 border rounded">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <h6 class="mb-1">Chemistry: Organic Compounds</h6>
                      <small class="text-muted">Dr. Priya Sharma</small>
                    </div>
                    <span class="badge bg-secondary">Recorded</span>
                  </div>
                  <div class="mt-2">
                    <small class="text-muted"><i class="bi bi-calendar"></i> Tomorrow, 10:00 AM</small>
                  </div>
                  <button class="btn btn-outline-primary btn-sm mt-2">Watch Later</button>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
              <div class="card-header bg-light">
                <h6 class="mb-0"><i class="bi bi-activity"></i> Recent Activity</h6>
              </div>
              <div class="card-body">
                <div class="activity-item mb-3 pb-3 border-bottom">
                  <div class="d-flex align-items-center">
                    <div class="activity-icon bg-success text-white rounded-circle me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                      <i class="bi bi-check-circle"></i>
                    </div>
                    <div>
                      <p class="mb-0 small">Completed Physics Assignment #5</p>
                      <small class="text-muted">2 hours ago</small>
                    </div>
                  </div>
                </div>
                <div class="activity-item mb-3 pb-3 border-bottom">
                  <div class="d-flex align-items-center">
                    <div class="activity-icon bg-info text-white rounded-circle me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                      <i class="bi bi-play-circle"></i>
                    </div>
                    <div>
                      <p class="mb-0 small">Watched Mathematics Live Class</p>
                      <small class="text-muted">1 day ago</small>
                    </div>
                  </div>
                </div>
                <div class="activity-item">
                  <div class="d-flex align-items-center">
                    <div class="activity-icon bg-warning text-white rounded-circle me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                      <i class="bi bi-star"></i>
                    </div>
                    <div>
                      <p class="mb-0 small">Scored 95% in Chemistry Quiz</p>
                      <small class="text-muted">3 days ago</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="card shadow-sm">
          <div class="card-header bg-light">
            <h6 class="mb-0"><i class="bi bi-grid"></i> Quick Access</h6>
          </div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-3 col-sm-6">
                <a href="study-materials.html" class="text-decoration-none">
                  <div class="quick-link-card text-center p-3 border rounded h-100">
                    <div class="text-primary mb-2" style="font-size: 1.5rem;"><i class="bi bi-file-earmark-pdf"></i></div>
                    <h6 class="mb-1">Study Materials</h6>
                    <small class="text-muted">PDFs & PPTs</small>
                  </div>
                </a>
              </div>
              <div class="col-md-3 col-sm-6">
                <a href="assignments.html" class="text-decoration-none">
                  <div class="quick-link-card text-center p-3 border rounded h-100">
                    <div class="text-warning mb-2" style="font-size: 1.5rem;"><i class="bi bi-clipboard-check"></i></div>
                    <h6 class="mb-1">Assignments</h6>
                    <small class="text-muted">View & Submit</small>
                  </div>
                </a>
              </div>
              <div class="col-md-3 col-sm-6">
                <a href="exams.html" class="text-decoration-none">
                  <div class="quick-link-card text-center p-3 border rounded h-100">
                    <div class="text-danger mb-2" style="font-size: 1.5rem;"><i class="bi bi-pencil-square"></i></div>
                    <h6 class="mb-1">Exams</h6>
                    <small class="text-muted">Tests & Quizzes</small>
                  </div>
                </a>
              </div>
              <div class="col-md-3 col-sm-6">
                <a href="certificates.html" class="text-decoration-none">
                  <div class="quick-link-card text-center p-3 border rounded h-100">
                    <div class="text-success mb-2" style="font-size: 1.5rem;"><i class="bi bi-award"></i></div>
                    <h6 class="mb-1">Certificates</h6>
                    <small class="text-muted">Download</small>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection