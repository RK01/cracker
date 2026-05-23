@extends('layouts.faculty')
@section('content')
  <!-- Main Content -->
  <div class="faculty-main" id="facultyMain">
    <!-- Top Bar -->
    <div class="faculty-topbar">
      <div class="faculty-topbar-title">
        <h4><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h4>
        <small>Welcome back, Dr. Rahul!</small>
      </div>
      <div class="text-muted">
        <small id="currentDate"></small>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
      <div class="col-md-6 col-lg-3">
        <div class="stat-card">
          <div class="stat-icon primary">
            <i class="fas fa-users"></i>
          </div>
          <div class="stat-content">
            <h6>Total Students</h6>
            <p class="stat-value">245</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="stat-card">
          <div class="stat-icon accent">
            <i class="fas fa-book"></i>
          </div>
          <div class="stat-content">
            <h6>Active Courses</h6>
            <p class="stat-value">5</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="stat-card">
          <div class="stat-icon success">
            <i class="fas fa-video"></i>
          </div>
          <div class="stat-content">
            <h6>Video Lectures</h6>
            <p class="stat-value">42</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="stat-card">
          <div class="stat-icon danger">
            <i class="fas fa-file-alt"></i>
          </div>
          <div class="stat-content">
            <h6>Pending Tests</h6>
            <p class="stat-value">8</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="row">
      <div class="col-lg-8">
        <div class="form-section">
          <h5 class="form-section-title">
            <i class="fas fa-clock me-2"></i>Recent Activities
          </h5>

          <div class="activity-timeline">
            <div class="activity-item d-flex gap-3 mb-4">
              <div style="width: 40px; height: 40px; background: rgba(16, 185, 129, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--faculty-success); flex-shrink: 0;">
                <i class="fas fa-check"></i>
              </div>
              <div>
                <h6 class="mb-1">Test Evaluation Complete</h6>
                <p class="text-muted mb-0">Evaluated JEE Mains Mock Test - 45 submissions</p>
                <small class="text-muted">2 hours ago</small>
              </div>
            </div>

            <div class="activity-item d-flex gap-3 mb-4">
              <div style="width: 40px; height: 40px; background: rgba(233, 181, 40, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--faculty-accent); flex-shrink: 0;">
                <i class="fas fa-video"></i>
              </div>
              <div>
                <h6 class="mb-1">Video Lecture Uploaded</h6>
                <p class="text-muted mb-0">Calculus - Integration Techniques (45 min)</p>
                <small class="text-muted">5 hours ago</small>
              </div>
            </div>

            <div class="activity-item d-flex gap-3 mb-4">
              <div style="width: 40px; height: 40px; background: rgba(59, 130, 246, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--faculty-info); flex-shrink: 0;">
                <i class="fas fa-file"></i>
              </div>
              <div>
                <h6 class="mb-1">Assignment Created</h6>
                <p class="text-muted mb-0">Organic Chemistry - Chapter 5 (Due: 5 days)</p>
                <small class="text-muted">1 day ago</small>
              </div>
            </div>

            <div class="activity-item d-flex gap-3">
              <div style="width: 40px; height: 40px; background: rgba(239, 68, 68, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--faculty-danger); flex-shrink: 0;">
                <i class="fas fa-user"></i>
              </div>
              <div>
                <h6 class="mb-1">New Student Enrolled</h6>
                <p class="text-muted mb-0">Priya Kumar enrolled in NEET 2024 Batch</p>
                <small class="text-muted">2 days ago</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="col-lg-4">
        <div class="form-section">
          <h5 class="form-section-title">
            <i class="fas fa-lightning-bolt me-2"></i>Quick Actions
          </h5>

          <div class="d-grid gap-2">
            <a href="upload-video-lectures.html" class="btn btn-gold">
              <i class="fas fa-plus-circle me-2"></i>Upload Lecture
            </a>
            <a href="create-tests.html" class="btn btn-primary-faculty">
              <i class="fas fa-file-alt me-2"></i>Create Test
            </a>
            <a href="upload-resources.html" class="btn btn-outline-primary-faculty">
              <i class="fas fa-file-upload me-2"></i>Upload Resources
            </a>
            <a href="announcements.html" class="btn btn-outline-primary-faculty">
              <i class="fas fa-bullhorn me-2"></i>Post Announcement
            </a>
          </div>
        </div>

        <!-- Upcoming Classes -->
        <div class="form-section mt-4">
          <h5 class="form-section-title">
            <i class="fas fa-calendar-alt me-2"></i>Today's Classes
          </h5>

          <div class="mb-3 p-3" style="background: var(--faculty-bg); border-radius: 8px; border-left: 4px solid var(--faculty-accent);">
            <h6 class="mb-1">JEE Mains Physics</h6>
            <p class="text-muted mb-1"><i class="fas fa-clock me-2"></i>10:00 AM - 11:30 AM</p>
            <p class="text-muted mb-0"><i class="fas fa-users me-2"></i>45 Students</p>
          </div>

          <div class="mb-3 p-3" style="background: var(--faculty-bg); border-radius: 8px; border-left: 4px solid var(--faculty-accent);">
            <h6 class="mb-1">NEET Chemistry</h6>
            <p class="text-muted mb-1"><i class="fas fa-clock me-2"></i>2:00 PM - 3:30 PM</p>
            <p class="text-muted mb-0"><i class="fas fa-users me-2"></i>52 Students</p>
          </div>

          <div class="p-3" style="background: var(--faculty-bg); border-radius: 8px; border-left: 4px solid var(--faculty-accent);">
            <h6 class="mb-1">CA Foundation Mathematics</h6>
            <p class="text-muted mb-1"><i class="fas fa-clock me-2"></i>4:00 PM - 5:00 PM</p>
            <p class="text-muted mb-0"><i class="fas fa-users me-2"></i>38 Students</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection