@extends('layouts.faculty')
@section('content')
  <!-- Main Content -->
  <div class="faculty-main" id="facultyMain">
    <!-- Top Bar -->
    <div class="faculty-topbar">
      <div class="faculty-topbar-title">
        <h4><i class="fas fa-video me-2"></i>Live Class Scheduling</h4>
        <small>Schedule and manage live classes with video conferencing</small>
      </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
      <div class="col-md-6 col-lg-3">
        <div class="stat-card">
          <div class="stat-icon primary">
            <i class="fas fa-calendar-check"></i>
          </div>
          <div class="stat-content">
            <h6>Scheduled Classes</h6>
            <p class="stat-value">12</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="stat-card">
          <div class="stat-icon success">
            <i class="fas fa-play-circle"></i>
          </div>
          <div class="stat-content">
            <h6>Live Now</h6>
            <p class="stat-value">1</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="stat-card">
          <div class="stat-icon accent">
            <i class="fas fa-archive"></i>
          </div>
          <div class="stat-content">
            <h6>Completed</h6>
            <p class="stat-value">45</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="stat-card">
          <div class="stat-icon info">
            <i class="fas fa-users"></i>
          </div>
          <div class="stat-content">
            <h6>Total Attendance</h6>
            <p class="stat-value">1,856</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Schedule Class -->
    <div class="row">
      <div class="col-lg-8">
        <div class="form-section">
          <h5 class="form-section-title">
            <i class="fas fa-plus-circle me-2"></i>Schedule New Live Class
          </h5>

          <form id="liveClassForm">
            <div class="mb-3">
              <label class="form-label">Class Title</label>
              <input type="text" class="form-control" placeholder="e.g., JEE Physics - Mechanics Class 5" required>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Select Course</label>
                <select class="form-select" required>
                  <option selected disabled>Choose a course</option>
                  <option>IIT JEE - Physics</option>
                  <option>IIT JEE - Mathematics</option>
                  <option>NEET - Chemistry</option>
                  <option>NEET - Biology</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Platform</label>
                <select class="form-select" required>
                  <option selected>Google Meet</option>
                  <option>Zoom</option>
                  <option>Microsoft Teams</option>
                  <option>Custom Platform</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea class="form-control" rows="3" placeholder="Class topic and details..." required></textarea>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Date</label>
                <input type="date" class="form-control" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Time</label>
                <input type="time" class="form-control" required>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Duration (Minutes)</label>
              <input type="number" class="form-control" placeholder="e.g., 90" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Meeting Link / Room Code</label>
              <input type="url" class="form-control" placeholder="https://meet.google.com/..." required>
            </div>

            <div class="mb-3">
              <label class="form-label">Recording & Notes (Optional)</label>
              <input type="text" class="form-control" placeholder="Link to class materials">
            </div>

            <button type="submit" class="btn btn-gold">
              <i class="fas fa-calendar-plus me-2"></i>Schedule Class
            </button>
          </form>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="form-section">
          <h5 class="form-section-title">
            <i class="fas fa-info-circle me-2"></i>Class Guidelines
          </h5>

          <div class="alert alert-info">
            <strong>Before Starting:</strong>
            <ul class="mb-0 mt-2 small">
              <li>Test your audio & video</li>
              <li>Prepare presentation slides</li>
              <li>Notify students in advance</li>
              <li>Start 5 mins early</li>
              <li>Enable recording (if allowed)</li>
            </ul>
          </div>

          <div class="form-section mt-3">
            <h6 class="fw-bold mb-3">Supported Platforms</h6>
            <div class="mb-2 d-flex align-items-center gap-2">
              <i class="fas fa-check-circle" style="color: var(--faculty-success);"></i>
              <span class="small">Google Meet</span>
            </div>
            <div class="mb-2 d-flex align-items-center gap-2">
              <i class="fas fa-check-circle" style="color: var(--faculty-success);"></i>
              <span class="small">Zoom</span>
            </div>
            <div class="d-flex align-items-center gap-2">
              <i class="fas fa-check-circle" style="color: var(--faculty-success);"></i>
              <span class="small">Microsoft Teams</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Live Classes List -->
    <div class="form-section mt-4">
      <h5 class="form-section-title">
        <i class="fas fa-list me-2"></i>Scheduled & Live Classes
      </h5>

      <div class="row">
        <div class="col-lg-4 mb-3">
          <div class="card border-0 shadow-sm" style="border-top: 4px solid var(--faculty-success);">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <h6 class="card-title fw-bold mb-0">Physics Class - Live Now!</h6>
                <span class="badge bg-danger"><i class="fas fa-circle me-1"></i>LIVE</span>
              </div>
              <p class="text-muted mb-2 small">IIT JEE - Mechanics</p>
              <p class="mb-2 small"><i class="fas fa-users me-1"></i><strong>42 students</strong> connected</p>
              <button class="btn btn-sm btn-gold w-100">
                <i class="fas fa-video me-1"></i>Join Class
              </button>
            </div>
          </div>
        </div>

        <div class="col-lg-4 mb-3">
          <div class="card border-0 shadow-sm" style="border-top: 4px solid var(--faculty-accent);">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <h6 class="card-title fw-bold mb-0">Chemistry Class</h6>
                <span class="table-badge success">Scheduled</span>
              </div>
              <p class="text-muted mb-2 small">NEET - Organic Chemistry</p>
              <p class="mb-2 small"><i class="fas fa-calendar me-1"></i>May 4, 2024</p>
              <p class="mb-2 small"><i class="fas fa-clock me-1"></i>3:00 PM (90 min)</p>
              <button class="btn btn-sm btn-primary-faculty w-100">
                <i class="fas fa-edit me-1"></i>Edit
              </button>
            </div>
          </div>
        </div>

        <div class="col-lg-4 mb-3">
          <div class="card border-0 shadow-sm" style="border-top: 4px solid var(--faculty-info);">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <h6 class="card-title fw-bold mb-0">Mathematics Class</h6>
                <span class="table-badge success">Scheduled</span>
              </div>
              <p class="text-muted mb-2 small">IIT JEE - Calculus</p>
              <p class="mb-2 small"><i class="fas fa-calendar me-1"></i>May 5, 2024</p>
              <p class="mb-2 small"><i class="fas fa-clock me-1"></i>10:00 AM (120 min)</p>
              <button class="btn btn-sm btn-primary-faculty w-100">
                <i class="fas fa-edit me-1"></i>Edit
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Completed Sessions -->
    <div class="form-section mt-4">
      <h5 class="form-section-title">
        <i class="fas fa-history me-2"></i>Completed Sessions
      </h5>

      <div class="faculty-table-container">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Class Name</th>
              <th>Course</th>
              <th>Date</th>
              <th>Attendance</th>
              <th>Duration</th>
              <th>Recording</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Physics - Mechanics</strong></td>
              <td>IIT JEE</td>
              <td>May 2, 2024</td>
              <td>45/50 (90%)</td>
              <td>95 min</td>
              <td>
                <a href="#" class="btn btn-sm btn-outline-primary-faculty">
                  <i class="fas fa-download me-1"></i>Download
                </a>
              </td>
              <td>
                <button class="btn btn-sm btn-outline-primary-faculty">View</button>
              </td>
            </tr>
            <tr>
              <td><strong>Chemistry - Organic</strong></td>
              <td>NEET</td>
              <td>May 1, 2024</td>
              <td>52/56 (93%)</td>
              <td>88 min</td>
              <td>
                <a href="#" class="btn btn-sm btn-outline-primary-faculty">
                  <i class="fas fa-download me-1"></i>Download
                </a>
              </td>
              <td>
                <button class="btn btn-sm btn-outline-primary-faculty">View</button>
              </td>
            </tr>
            <tr>
              <td><strong>Mathematics - Calculus</strong></td>
              <td>IIT JEE</td>
              <td>Apr 29, 2024</td>
              <td>48/50 (96%)</td>
              <td>120 min</td>
              <td>
                <a href="#" class="btn btn-sm btn-outline-primary-faculty">
                  <i class="fas fa-download me-1"></i>Download
                </a>
              </td>
              <td>
                <button class="btn btn-sm btn-outline-primary-faculty">View</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection