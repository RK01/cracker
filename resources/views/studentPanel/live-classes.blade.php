@extends('layouts.student')
@section('content')
<!-- Live Classes Content -->
<div class="container py-4">
  <!-- Today's Live Classes -->
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-play-circle-fill text-danger"></i> Live Classes Today</h5>
      <span class="badge bg-danger">LIVE</span>
    </div>
    <div class="card-body">
      <div class="row" id="todayClasses">
        <div class="col-lg-6 mb-3">
          <div class="card border-danger h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                  <h6 class="card-title mb-1">Physics: Mechanics</h6>
                  <small class="text-muted">Dr. Rajesh Kumar</small>
                </div>
                <span class="badge bg-danger">Starting Soon</span>
              </div>
              <div class="row text-center mb-3">
                <div class="col-4">
                  <div class="text-primary mb-1"><i class="bi bi-clock"></i></div>
                  <small>3:00 PM</small>
                </div>
                <div class="col-4">
                  <div class="text-success mb-1"><i class="bi bi-clock-history"></i></div>
                  <small>2 Hours</small>
                </div>
                <div class="col-4">
                  <div class="text-warning mb-1"><i class="bi bi-people"></i></div>
                  <small>45 Students</small>
                </div>
              </div>
              <div class="d-flex gap-2">
                <button class="btn btn-danger btn-sm flex-fill" onclick="joinLiveClass('Physics: Mechanics')">
                  <i class="bi bi-play-circle"></i> Join Now
                </button>
                <button class="btn btn-outline-primary btn-sm" onclick="setReminder('Physics: Mechanics')">
                  <i class="bi bi-bell"></i> Remind Me
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 mb-3">
          <div class="card border-secondary h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                  <h6 class="card-title mb-1">Chemistry: Organic Compounds</h6>
                  <small class="text-muted">Dr. Priya Sharma</small>
                </div>
                <span class="badge bg-secondary">Upcoming</span>
              </div>
              <div class="row text-center mb-3">
                <div class="col-4">
                  <div class="text-primary mb-1"><i class="bi bi-clock"></i></div>
                  <small>6:00 PM</small>
                </div>
                <div class="col-4">
                  <div class="text-success mb-1"><i class="bi bi-clock-history"></i></div>
                  <small>1.5 Hours</small>
                </div>
                <div class="col-4">
                  <div class="text-warning mb-1"><i class="bi bi-people"></i></div>
                  <small>38 Students</small>
                </div>
              </div>
              <div class="d-flex gap-2">
                <button class="btn btn-outline-danger btn-sm flex-fill" disabled>
                  <i class="bi bi-clock"></i> Starts at 6:00 PM
                </button>
                <button class="btn btn-outline-primary btn-sm" onclick="setReminder('Chemistry: Organic Compounds')">
                  <i class="bi bi-bell"></i> Remind Me
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Weekly Schedule -->
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-light">
      <h5 class="mb-0"><i class="bi bi-calendar-week"></i> This Week's Schedule</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Day</th>
              <th>Time</th>
              <th>Subject</th>
              <th>Faculty</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr class="table-danger">
              <td><strong>Today</strong></td>
              <td>3:00 PM</td>
              <td>Physics: Mechanics</td>
              <td>Dr. Rajesh Kumar</td>
              <td><span class="badge bg-danger">Live Now</span></td>
              <td><button class="btn btn-danger btn-sm" onclick="joinLiveClass('Physics: Mechanics')">Join</button></td>
            </tr>
            <tr class="table-danger">
              <td><strong>Today</strong></td>
              <td>6:00 PM</td>
              <td>Chemistry: Organic Compounds</td>
              <td>Dr. Priya Sharma</td>
              <td><span class="badge bg-warning">Starting Soon</span></td>
              <td><button class="btn btn-outline-danger btn-sm" onclick="setReminder('Chemistry: Organic Compounds')">Remind</button></td>
            </tr>
            <tr>
              <td>Tomorrow</td>
              <td>10:00 AM</td>
              <td>Mathematics: Calculus</td>
              <td>Prof. Amit Singh</td>
              <td><span class="badge bg-secondary">Scheduled</span></td>
              <td><button class="btn btn-outline-primary btn-sm" onclick="setReminder('Mathematics: Calculus')">Remind</button></td>
            </tr>
            <tr>
              <td>Tomorrow</td>
              <td>2:00 PM</td>
              <td>Biology: Cell Structure</td>
              <td>Dr. Meera Patel</td>
              <td><span class="badge bg-secondary">Scheduled</span></td>
              <td><button class="btn btn-outline-primary btn-sm" onclick="setReminder('Biology: Cell Structure')">Remind</button></td>
            </tr>
            <tr>
              <td>Wednesday</td>
              <td>4:00 PM</td>
              <td>Physics: Thermodynamics</td>
              <td>Dr. Rajesh Kumar</td>
              <td><span class="badge bg-secondary">Scheduled</span></td>
              <td><button class="btn btn-outline-primary btn-sm" onclick="setReminder('Physics: Thermodynamics')">Remind</button></td>
            </tr>
            <tr>
              <td>Thursday</td>
              <td>11:00 AM</td>
              <td>Chemistry: Chemical Bonding</td>
              <td>Dr. Priya Sharma</td>
              <td><span class="badge bg-secondary">Scheduled</span></td>
              <td><button class="btn btn-outline-primary btn-sm" onclick="setReminder('Chemistry: Chemical Bonding')">Remind</button></td>
            </tr>
            <tr>
              <td>Friday</td>
              <td>9:00 AM</td>
              <td>Mathematics: Vectors</td>
              <td>Prof. Amit Singh</td>
              <td><span class="badge bg-secondary">Scheduled</span></td>
              <td><button class="btn btn-outline-primary btn-sm" onclick="setReminder('Mathematics: Vectors')">Remind</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Class Recordings -->
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-camera-video"></i> Recent Class Recordings</h5>
      <a href="recorded-classes.html" class="btn btn-outline-primary btn-sm">View All</a>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 mb-3">
          <div class="card h-100">
            <div class="ratio ratio-16x9">
              <div class="bg-secondary d-flex align-items-center justify-content-center text-white">
                <i class="bi bi-play-circle" style="font-size: 3rem;"></i>
              </div>
            </div>
            <div class="card-body">
              <h6 class="card-title">Physics: Kinematics</h6>
              <p class="card-text small text-muted">Dr. Rajesh Kumar • 2 days ago • 1.5 hours</p>
              <button class="btn btn-outline-primary btn-sm" onclick="watchRecording('Physics: Kinematics')">
                <i class="bi bi-play"></i> Watch Now
              </button>
            </div>
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <div class="card h-100">
            <div class="ratio ratio-16x9">
              <div class="bg-secondary d-flex align-items-center justify-content-center text-white">
                <i class="bi bi-play-circle" style="font-size: 3rem;"></i>
              </div>
            </div>
            <div class="card-body">
              <h6 class="card-title">Chemistry: Acids & Bases</h6>
              <p class="card-text small text-muted">Dr. Priya Sharma • 3 days ago • 1.2 hours</p>
              <button class="btn btn-outline-primary btn-sm" onclick="watchRecording('Chemistry: Acids & Bases')">
                <i class="bi bi-play"></i> Watch Now
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Live Class Features -->
  <div class="card shadow-sm">
    <div class="card-header bg-light">
      <h5 class="mb-0"><i class="bi bi-star"></i> Live Class Features</h5>
    </div>
    <div class="card-body">
      <div class="row g-4">
        <div class="col-md-3 text-center">
          <div class="text-primary mb-2" style="font-size: 2rem;"><i class="bi bi-chat-dots"></i></div>
          <h6>Live Chat</h6>
          <small class="text-muted">Interact with faculty and classmates</small>
        </div>
        <div class="col-md-3 text-center">
          <div class="text-success mb-2" style="font-size: 2rem;"><i class="bi bi-hand-thumbs-up"></i></div>
          <h6>Polls & Quizzes</h6>
          <small class="text-muted">Real-time engagement during class</small>
        </div>
        <div class="col-md-3 text-center">
          <div class="text-warning mb-2" style="font-size: 2rem;"><i class="bi bi-record-circle"></i></div>
          <h6>Auto Recording</h6>
          <small class="text-muted">All classes are automatically recorded</small>
        </div>
        <div class="col-md-3 text-center">
          <div class="text-info mb-2" style="font-size: 2rem;"><i class="bi bi-graph-up"></i></div>
          <h6>Analytics</h6>
          <small class="text-muted">Track your learning progress</small>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Join Class Modal -->
<div class="modal fade" id="joinClassModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Join Live Class</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-4">
          <h6 id="classTitle">Class Title</h6>
          <p class="text-muted" id="classInfo">Faculty • Duration</p>
        </div>

        <!-- Video Player Placeholder -->
        <div class="ratio ratio-16x9 mb-3">
          <div class="bg-dark d-flex align-items-center justify-content-center text-white">
            <div class="text-center">
              <i class="bi bi-play-circle" style="font-size: 4rem;"></i>
              <p class="mt-2">Live Class Stream</p>
              <small>Demo - Actual streaming will be integrated</small>
            </div>
          </div>
        </div>

        <!-- Class Controls -->
        <div class="row g-2 mb-3">
          <div class="col-6">
            <button class="btn btn-outline-secondary w-100">
              <i class="bi bi-mic"></i> Mute/Unmute
            </button>
          </div>
          <div class="col-6">
            <button class="btn btn-outline-secondary w-100">
              <i class="bi bi-camera-video"></i> Video On/Off
            </button>
          </div>
          <div class="col-6">
            <button class="btn btn-outline-primary w-100">
              <i class="bi bi-hand-raised"></i> Raise Hand
            </button>
          </div>
          <div class="col-6">
            <button class="btn btn-outline-info w-100">
              <i class="bi bi-chat-dots"></i> Open Chat
            </button>
          </div>
        </div>

        <!-- Live Chat -->
        <div class="card">
          <div class="card-header">
            <h6 class="mb-0">Live Chat</h6>
          </div>
          <div class="card-body" style="height: 200px; overflow-y: auto;">
            <div id="chatMessages">
              <div class="chat-message mb-2">
                <small class="text-muted">Dr. Rajesh Kumar: Welcome everyone! Let's begin with the basics of mechanics.</small>
              </div>
              <div class="chat-message mb-2">
                <small class="text-muted">Student1: Good morning sir!</small>
              </div>
              <div class="chat-message mb-2">
                <small class="text-muted">Dr. Rajesh Kumar: Good morning! Please keep your cameras on for better interaction.</small>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Type your message..." id="chatInput">
              <button class="btn btn-primary" onclick="sendMessage()">
                <i class="bi bi-send"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Leave Class</button>
      </div>
    </div>
  </div>
</div>
@endsection