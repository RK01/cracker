@extends('layouts.faculty')
@section('content')
  <!-- Main Content -->
  <div class="faculty-main" id="facultyMain">
    <!-- Top Bar -->
    <div class="faculty-topbar">
      <div class="faculty-topbar-title">
        <h4><i class="fas fa-chart-line me-2"></i>Student Performance Tracking</h4>
        <small>Monitor and analyze student progress</small>
      </div>
    </div>

    <!-- Performance Stats -->
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
          <div class="stat-icon success">
            <i class="fas fa-star"></i>
          </div>
          <div class="stat-content">
            <h6>Top Performers</h6>
            <p class="stat-value">45</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="stat-card">
          <div class="stat-icon warning">
            <i class="fas fa-exclamation-circle"></i>
          </div>
          <div class="stat-content">
            <h6>Need Support</h6>
            <p class="stat-value">38</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="stat-card">
          <div class="stat-icon accent">
            <i class="fas fa-line-chart"></i>
          </div>
          <div class="stat-content">
            <h6>Class Average</h6>
            <p class="stat-value">75.8%</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Filter -->
    <div class="form-section mb-3">
      <div class="row">
        <div class="col-md-4">
          <select class="form-select">
            <option selected>All Courses</option>
            <option>IIT JEE - Physics</option>
            <option>NEET - Chemistry</option>
          </select>
        </div>
        <div class="col-md-4">
          <select class="form-select">
            <option selected>Sort By Performance</option>
            <option>Highest Score</option>
            <option>Lowest Score</option>
            <option>Most Improved</option>
          </select>
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control" placeholder="Search student...">
        </div>
      </div>
    </div>

    <!-- Performance Table -->
    <div class="form-section">
      <h5 class="form-section-title">
        <i class="fas fa-list me-2"></i>Student Performance Report
      </h5>

      <div class="faculty-table-container">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Roll No.</th>
              <th>Tests Taken</th>
              <th>Avg. Score</th>
              <th>Best Score</th>
              <th>Attendance</th>
              <th>Grade</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Aman Singh</strong></td>
              <td>101</td>
              <td>8</td>
              <td>85.5%</td>
              <td>92%</td>
              <td>93%</td>
              <td><span class="table-badge success">A+</span></td>
              <td>
                <button class="btn btn-sm btn-outline-primary-faculty">View</button>
              </td>
            </tr>
            <tr>
              <td><strong>Priya Kumar</strong></td>
              <td>102</td>
              <td>8</td>
              <td>78.2%</td>
              <td>86%</td>
              <td>84%</td>
              <td><span class="table-badge success">A</span></td>
              <td>
                <button class="btn btn-sm btn-outline-primary-faculty">View</button>
              </td>
            </tr>
            <tr>
              <td><strong>Rajesh Patel</strong></td>
              <td>103</td>
              <td>7</td>
              <td>62.5%</td>
              <td>71%</td>
              <td>78%</td>
              <td><span class="table-badge warning">B</span></td>
              <td>
                <button class="btn btn-sm btn-outline-primary-faculty">View</button>
              </td>
            </tr>
            <tr>
              <td><strong>Neha Verma</strong></td>
              <td>104</td>
              <td>6</td>
              <td>45.8%</td>
              <td>58%</td>
              <td>69%</td>
              <td><span class="table-badge danger">C</span></td>
              <td>
                <button class="btn btn-sm btn-outline-primary-faculty">View</button>
              </td>
            </tr>
            <tr>
              <td><strong>Vikram Singh</strong></td>
              <td>105</td>
              <td>8</td>
              <td>88.3%</td>
              <td>95%</td>
              <td>91%</td>
              <td><span class="table-badge success">A+</span></td>
              <td>
                <button class="btn btn-sm btn-outline-primary-faculty">View</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Individual Student Performance -->
    <div class="row mt-4">
      <div class="col-lg-8">
        <div class="form-section">
          <h5 class="form-section-title">
            <i class="fas fa-user me-2"></i>Performance Trend - Aman Singh
          </h5>

          <div style="background: var(--faculty-bg); padding: 20px; border-radius: 8px; height: 300px; display: flex; align-items: center; justify-content: center;">
            <p class="text-muted">
              <i class="fas fa-chart-line me-2"></i>Chart placeholder - Integration with chart library recommended
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="form-section">
          <h5 class="form-section-title">
            <i class="fas fa-bar-chart me-2"></i>Score Breakdown
          </h5>

          <div class="mb-3">
            <div class="d-flex justify-content-between mb-2">
              <span>Tests: 85.5%</span>
            </div>
            <div class="progress" style="height: 8px;">
              <div class="progress-bar bg-success" style="width: 85.5%"></div>
            </div>
          </div>

          <div class="mb-3">
            <div class="d-flex justify-content-between mb-2">
              <span>Assignments: 92%</span>
            </div>
            <div class="progress" style="height: 8px;">
              <div class="progress-bar bg-success" style="width: 92%"></div>
            </div>
          </div>

          <div class="mb-3">
            <div class="d-flex justify-content-between mb-2">
              <span>Class Participation: 78%</span>
            </div>
            <div class="progress" style="height: 8px;">
              <div class="progress-bar bg-info" style="width: 78%"></div>
            </div>
          </div>

          <hr>

          <div class="p-3" style="background: var(--faculty-bg); border-radius: 8px;">
            <p class="mb-1 small"><strong>Overall Grade:</strong> A+</p>
            <p class="mb-1 small"><strong>Attendance:</strong> 93%</p>
            <p class="mb-0 small"><strong>Trend:</strong> Improving</p>
          </div>
        </div>

        <div class="form-section mt-3">
          <button class="btn btn-gold w-100 mb-2">
            <i class="fas fa-comment me-2"></i>Send Feedback
          </button>
          <button class="btn btn-outline-primary-faculty w-100">
            <i class="fas fa-download me-2"></i>Download Report
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection