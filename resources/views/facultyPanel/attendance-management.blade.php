@extends('layouts.faculty')

@section('content')

<div class="faculty-main" id="facultyMain">

  <!-- Top Bar -->
  <div class="faculty-topbar">
    <div class="faculty-topbar-title">
      <h4> <i class="fas fa-clipboard-list me-2"></i> Attendance Management </h4>

      <small>Track and manage student attendance</small>
    </div>
  </div>

  <!-- Stats -->
  <div class="row mb-4">

    <div class="col-md-6 col-lg-3">
      <div class="stat-card">
        <div class="stat-icon primary">
          <i class="fas fa-users"></i>
        </div>

        <div class="stat-content">
          <h6>Total Students</h6>
          <p class="stat-value">{{ $totalStudents }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="stat-card">
        <div class="stat-icon success">
          <i class="fas fa-check-circle"></i>
        </div>

        <div class="stat-content">
          <h6>Present</h6>
          <p class="stat-value">{{ $presentCount }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="stat-card">
        <div class="stat-icon danger">
          <i class="fas fa-times-circle"></i>
        </div>

        <div class="stat-content">
          <h6>Absent</h6>
          <p class="stat-value">{{ $absentCount }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="stat-card">
        <div class="stat-icon accent">
          <i class="fas fa-percent"></i>
        </div>

        <div class="stat-content">
          <h6>Attendance %</h6>
          <p class="stat-value">{{ $attendancePercentage }}%</p>
        </div>
      </div>
    </div>

  </div>

  <!-- Attendance Records -->
  <div class="row">
    <div class="form-section">

      <h5 class="form-section-title">
        <i class="fas fa-check me-2"></i>
        Attendance Mark
      </h5>

      <form method="GET" class="row mb-3">

        <div class="col-md-4">
          <input type="date" name="date" value="{{ $selectedDate }}" class="form-control">
        </div>

        <div class="col-md-6">
         
        </div>

        <div class="col-md-2">
          <button class="btn btn-primary-faculty w-100">Filter</button>
        </div>

      </form>
      <form action="{{ route('faculty.attendance.store') }}" method="POST">
        @csrf
        <input type="hidden" name="date" value="{{ $selectedDate }}">
        <input type="hidden" name="subject" value="{{ $subject }}">
        <div class="faculty-table-container">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Student Name</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Attendance</th>
              </tr>
            </thead>
            <tbody>
              @forelse($students as $student)
                @php
                  $existing = $attendances[$student->id]->status ?? '';
                @endphp
                <tr>
                  <td>{{ ucwords($student->name) }}</td>
                  <td>{{ $subject }}</td>
                  <td>
                    {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}
                  </td>
                  <td>
                    <select name="status[{{ $student->id }}]"class="form-control">
                      <option value="">Select</option>
                      <option value="present" {{ $existing == 'present' ? 'selected' : '' }}>Present</option>
                      <option value="absent" {{ $existing == 'absent' ? 'selected' : '' }}>Absent</option>
                    </select>
                  </td>
                </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center">
                  No Students Found
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <button class="btn btn-success mt-3">Save Attendance</button>
      </form>
    </div>
    <div class="col-lg-8">
      <div class="form-section">
        <h5 class="form-section-title">
          <i class="fas fa-chart-bar me-2"></i>
          Student Attendance Report
        </h5>
        <div class="faculty-table-container">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Student</th>
                <th>Total Classes</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Percentage</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($reportData as $report)
              <tr>
                <td>{{ ucwords($report['student_name']) }}</td>
                <td>{{ $report['total_classes'] }}</td>
                <td>{{ $report['present'] }}</td>
                <td>{{ $report['absent'] }}</td>
                <td>{{ $report['percentage'] }}%</td>
                <td>
                  <span class="table-badge {{ $report['badge'] }}">
                    {{ $report['status'] }}
                  </span>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center text-muted">
                  No report data found.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Right Side -->
    <div class="col-lg-4">

      <div class="form-section">

        <h5 class="form-section-title">
          <i class="fas fa-calendar me-2"></i>
          Select Date
        </h5>

        <form method="GET">

          <input
            type="date"
            name="date"
            class="form-control"
            value="{{ $selectedDate }}">

          <button class="btn btn-primary-faculty w-100 mt-3">
            Filter
          </button>

        </form>

      </div>

      <!-- Summary -->
      <div class="form-section mt-3">

        <h5 class="form-section-title">
          <i class="fas fa-history me-2"></i>
          Attendance Summary
        </h5>

        <div class="mb-3 p-3"
          style="background: var(--faculty-bg); border-radius: 8px;">

          <p class="mb-1 small">
            <strong>Total Records:</strong>

          </p>

          <p class="mb-1 small">
            <strong>Present:</strong>
            {{ $presentCount }}
          </p>

          <p class="mb-1 small">
            <strong>Absent:</strong>
            {{ $absentCount }}
          </p>

          <p class="mb-0 small">
            <strong>Average Attendance:</strong>
            {{ $attendancePercentage }}%
          </p>

        </div>

      </div>

    </div>

  </div>

  <!-- Report -->


</div>

@endsection