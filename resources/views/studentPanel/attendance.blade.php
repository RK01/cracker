@extends('layouts.student')
@section('content')
<!-- Attendance Content -->
<div class="container py-4">
  <!-- Attendance Overview -->
  <div class="row mb-4">
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-success mb-2" style="font-size: 2rem;"><i class="bi bi-check-circle"></i></div>
          <h4 class="mb-1">{{ $overallPercentage }}%</h4>
          <small class="text-muted">Overall Attendance</small>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-primary mb-2" style="font-size: 2rem;"><i class="bi bi-calendar-event"></i></div>
          <h4 class="mb-1">{{ $totalClasses }}</h4>
          <small class="text-muted">Total Classes</small>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-success mb-2" style="font-size: 2rem;"><i class="bi bi-check2-all"></i></div>
          <h4 class="mb-1">{{ $presentCount }}</h4>
          <small class="text-muted">Present</small>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-danger mb-2" style="font-size: 2rem;"><i class="bi bi-x-circle"></i></div>
          <h4 class="mb-1">{{ $absentCount }}</h4>
          <small class="text-muted">Absent</small>
        </div>
      </div>
    </div>
  </div>

  <!-- Monthly Attendance Chart -->
  <div class="card shadow-sm mb-4 monthly-attendance-chart">
    <div class="card-header bg-light">
      <h6 class="mb-0"><i class="bi bi-bar-chart"></i> Monthly Attendance Overview</h6>
    </div>

    <div class="card-body">
      <div class="row text-center">
        @foreach(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'] as $month)
        <div class="col-2 mb-3">
          <div class="p-2 border rounded {{ now()->format('M') == $month ? 'bg-primary text-white' : '' }}">
            <div class="fw-bold">{{ $month }}</div>
            <small>{{ $monthlyData[$month] ?? '-' }}{{ isset($monthlyData[$month]) ? '%' : '' }}</small>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Subject-wise Attendance -->
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-light">
      <h6 class="mb-0"><i class="bi bi-book"></i> Subject-wise Attendance</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Subject</th>
              <th>Total Classes</th>
              <th>Present</th>
              <th>Absent</th>
              <th>Attendance %</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($subjectWise as $subject => $data)
            <tr>
              <td><span class="badge bg-primary me-2">{{ $subject }}</span></td>
              <td>{{ $data['total'] }}</td>
              <td>{{ $data['present'] }}</td>
              <td>{{ $data['absent'] }}</td>
              <td>{{ $data['percentage'] }}%</td>
              <td>
                @if($data['percentage'] >= 85)
                <span class="badge bg-success">Excellent</span>
                @else
                <span class="badge bg-warning">Good</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- {{$monthlyData}} --}}
  <!-- Recent Attendance -->
  <div class="card shadow-sm">
    <div class="card-header bg-light">
      <h6 class="mb-0"><i class="bi bi-clock-history"></i> Recent Attendance (Last 30 Days)</h6>
    </div>
    <div class="card-body">
      <div class="row">
        <!-- Calendar View -->
        <div class="col-md-8">
          <div class="calendar-container">
            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
              <h6 class="mb-0"><strong>May 2026</strong></h6>
              <div>
                <button class="btn btn-sm btn-outline-primary me-2" onclick="previousMonth()"><i class="bi bi-chevron-left"></i></button>
                <button class="btn btn-sm btn-outline-primary" onclick="nextMonth()"><i class="bi bi-chevron-right"></i></button>
              </div>
            </div>

            <!-- Calendar Grid -->
            <div class="calendar-grid" id="calendarGrid">
              <!-- JavaScript will dynamically generate calendar days here -->
            </div>
          </div>
        </div>

        <!-- Legend and Summary -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h6 class="mb-0">Legend</h6>
            </div>
            <div class="card-body">
              <div class="d-flex align-items-center mb-2">
                <div class="calendar-day present me-2" style="width: 20px; height: 20px;"></div>
                <small>Present</small>
              </div>
              <div class="d-flex align-items-center mb-2">
                <div class="calendar-day absent me-2" style="width: 20px; height: 20px;"></div>
                <small>Absent</small>
              </div>
              <div class="d-flex align-items-center mb-2">
                <div class="calendar-day holiday me-2" style="width: 20px; height: 20px;"></div>
                <small>Holiday</small>
              </div>
              <div class="d-flex align-items-center mb-3">
                <div class="calendar-day empty me-2" style="width: 20px; height: 20px;"></div>
                <small>No Class</small>
              </div>

              <hr>

              <h6>This Month</h6>
              <div class="row text-center">
                <div class="col-6">
                  <div class="text-success fw-bold">{{ $thisMonthPresent }}</div>
                  <small>Present</small>
                </div>
                <div class="col-6">
                  <div class="text-danger fw-bold">{{ $thisMonthAbsent }}</div>
                  <small>Absent</small>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
         {{-- <div class="card mt-3">
            <div class="card-header">
              <h6 class="mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
              <button class="btn btn-outline-primary btn-sm w-100 mb-2" onclick="downloadAttendanceReport()">
                <i class="bi bi-download"></i> Download Report
              </button>
              <button class="btn btn-outline-success btn-sm w-100 mb-2" onclick="requestAttendanceCorrection()">
                <i class="bi bi-pencil-square"></i> Request Correction
              </button>
              <button class="btn btn-outline-info btn-sm w-100" onclick="viewAttendanceHistory()">
                <i class="bi bi-clock-history"></i> View History
              </button>
            </div>
          </div>--}}
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    // PHP array ko JS object mein convert karein
    const attendanceData = @json($recentAttendance);
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();


    function renderCalendar(month, year) {
    const grid = document.getElementById('calendarGrid');
    grid.innerHTML = ''; // Purana data clear karein

    // Headers dubara add karein
    const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    days.forEach(day => {
        grid.innerHTML += `<div class="calendar-header">${day}</div>`;
    });

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    // 1. Empty slots (Pichle mahine ke din)
    for (let i = 0; i < firstDay; i++) {
        grid.innerHTML += '<div class="calendar-day empty"></div>';
    }

    // 2. Mahine ke actual din
    for (let day = 1; day <= daysInMonth; day++) {
        // Date format: YYYY-MM-DD
        let fullDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        
        let statusClass = '';
        let title = 'No Class';

        // Check karein agar is date ka data backend se aaya hai
        if (attendanceData[fullDate]) {
            statusClass = attendanceData[fullDate].status; // 'present', 'absent', 'holiday'
            title = `${attendanceData[fullDate].status.toUpperCase()} - ${attendanceData[fullDate].subject}`;
        }

        grid.innerHTML += `
            <div class="calendar-day ${statusClass}" title="${title}">
                <span>${day}</span>
            </div>
        `;
    }
}

// Page load par calendar chalayein
document.addEventListener('DOMContentLoaded', () => {
    renderCalendar(currentMonth, currentYear);
});

function previousMonth() {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    updateCalendar();
}

function nextMonth() {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    updateCalendar();
}

function updateCalendar() {
    // Yahan aap AJAX call bhi kar sakte hain agar naye mahine ka data chahiye
    // Filhal ye current loaded data ko hi render karega
    renderCalendar(currentMonth, currentYear);
    document.querySelector('h6 strong').innerText = new Date(currentYear, currentMonth).toLocaleString('default', { month: 'long', year: 'numeric' });
}
</script>
@endsection