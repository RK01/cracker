@extends('layouts.student')
@section('content')

<div class="container py-1">
  <div class="row">

    <div class="col-lg-4 mb-4">
      <!-- Profile Card -->
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <div class="mb-3">
            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center position-relative" style="width: 100px; height: 100px; font-size: 2.5rem;">
              <i class="bi bi-person"></i>
              <button class="btn btn-sm btn-warning rounded-circle position-absolute" style="bottom: 0; right: 0; width: 30px; height: 30px;">
                <i class="bi bi-camera"></i>
              </button>
            </div>
          </div>
          <h5 id="profileName">{{ Auth::user()->name }}</h5>
          <p class="text-muted mb-2" id="profileCourse"> {{ getCourseNameById(Auth::user()->course_id) }}</p>
          <p class="text-muted small mb-3" id="profileEmail">{{ Auth::user()->email }}</p>

          <div class="d-flex justify-content-center gap-2">
            {{-- <button class="btn btn-outline-primary btn-sm" onclick="editProfile()">
              <i class="bi bi-pencil"></i> Edit Profile
            </button>
            <button class="btn btn-outline-warning btn-sm" onclick="changePassword()">
              <i class="bi bi-key"></i> Change Password
            </button> --}}
          </div>
          @error('login')
          <span class="text-danger small text-center">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <!-- Quick Stats -->
      <div class="card shadow-sm mt-3">
        <div class="card-header bg-light">
          <h6 class="mb-0">Quick Stats</h6>
        </div>
        <div class="card-body">
          <div class="row text-center">
            <div class="col-6">
              <div class="text-warning mb-1" style="font-size: 1.5rem;"><i class="bi bi-play-circle"></i></div>
              <h5 class="mb-0">24</h5>
              <small class="text-muted">Classes</small>
            </div>
            <div class="col-6">
              <div class="text-success mb-1" style="font-size: 1.5rem;"><i class="bi bi-trophy"></i></div>
              <h5 class="mb-0">92%</h5>
              <small class="text-muted">Avg Score</small>
            </div>
          </div>
        </div>
      </div>
      @if(session('success'))
      <div class="alert alert-success small py-2 mt-4">{{ session('success') }}</div>
      @endif

      <!-- Validation Error Messages -->
      @if($errors->any())
      <div class="alert alert-danger small py-2 m-4">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    </div>

    <div class="col-lg-8">
      <!-- Profile Tabs -->
      <div class="card shadow-sm">
        <div class="card-header bg-light">
          <ul class="nav nav-tabs card-header-tabs" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">Personal Info</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="academic-tab" data-bs-toggle="tab" data-bs-target="#academic" type="button" role="tab">Academic Info</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab">Security</button>
            </li>
          </ul>
        </div>

        <div class="card-body">
          <div class="tab-content" id="profileTabContent">
            <!-- Personal Information Tab -->
            <div class="tab-pane fade show active" id="personal" role="tabpanel">
              <form id="personalForm" action="{{ route('student.profile.personal.update') }}" method="POST">
                @csrf
                <h5 class="mb-3">Personal Information</h5>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Full Name *</label>
                    <input type="text" class="form-control" id="fullName" name="full_name" value="{{ $profile->name ?? '' }}" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="{{ $profile->profile->dob ?? '' }}">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Phone Number *</label>
                    <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10}" maxlength="10" value="{{ $profile->phone ?? '' }}" required disabled>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email Address *</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $profile->email ?? '' }}" required disabled>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender">
                      <option value="">Select Gender</option>
                      <option value="male" @selected($profile->profile?->gender === 'male')>Male</option>
                      <option value="female" @selected($profile->profile?->gender === 'female')>Female</option>
                      <option value="other" @selected($profile->profile?->gender === 'other')>Other</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Blood Group</label>
                    <select class="form-select" id="bloodGroup" name="blood_group">
                      <option value="">Select Blood Group</option>
                      <option value="A+" @selected($profile->profile?->blood_group === 'A+')>A+</option>
                      <option value="A-" @selected($profile->profile?->blood_group === 'A-')>A-</option>
                      <option value="B+" @selected($profile->profile?->blood_group === 'B+')>B+</option>
                      <option value="B-" @selected($profile->profile?->blood_group === 'B-')>B-</option>
                      <option value="AB+" @selected($profile->profile?->blood_group === 'AB+')>AB+</option>
                      <option value="AB-" @selected($profile->profile?->blood_group === 'AB-')>AB-</option>
                      <option value="O+" @selected($profile->profile?->blood_group === 'O+')>O+</option>
                      <option value="O-" @selected($profile->profile?->blood_group === 'O-')>O-</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your complete address">{{ $profile->profile->address ?? '' }}</textarea>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">State</label>
                    <select class="form-select" id="state" name="state">
                      <option value="">Select state</option>
                      @foreach($states as $stateId => $stateName)
                        <option value="{{ $stateId }}" @selected($stateId == auth()->user()->state)>{{ $stateName }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">City</label>
                    <select class="form-select" id="city" name="city">
                       <option value="">Select city</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Emergency Contact</label>
                    <input type="tel" class="form-control" id="emergencyContact" name="emergency_contact" value="{{ $profile->profile->emergency_contact ?? '' }}" pattern="[0-9]{10}" maxlength="10" placeholder="Emergency contact number">
                  </div>
                </div>
                <div class="mt-4">
                  <button type="submit" class="btn btn-warning">Save Changes</button>
                  <button type="button" class="btn btn-outline-secondary ms-2" onclick="resetPersonalForm()">Reset</button>
                </div>
              </form>
            </div>

            <!-- Academic Information Tab -->
            <div class="tab-pane fade" id="academic" role="tabpanel">
              <form id="academicForm" action="{{ route('student.profile.academic.update') }}" method="POST">
                @csrf
                <h5 class="mb-3">Academic Information</h5>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Current Course *</label>
                    <select class="form-select" id="currentCourse" required disabled>
                      <option value="">Select Course</option>
                      @foreach($course_name as $course)
                      <option value="{{ $course->id }}" @selected($profile->course_id == $course->id)>{{ $course->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Batch/Section</label>
                    <input type="text" class="form-control" id="batch" name="batch" placeholder="e.g., Batch A, Section 1" value="{{$profile->academic->batch ?? ''}}">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">School/College Name</label>
                    <input type="text" class="form-control" id="schoolName" name="school_name" placeholder="Enter school/college name" value="{{$profile->academic->school_name ?? ''}}">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Class</label>
                    <select class="form-select" id="classYear" name="class_year">
                      <option value="">Select Class</option>
                      <option value="11th" @selected(old('class_year', $profile->academic?->class_year) === '11th')>11th Standard</option>
                      <option value="12th" @selected(old('class_year', $profile->academic?->class_year) === '12th')>12th Standard</option>
                      <option value="12th_pass" @selected(old('class_year', $profile->academic?->class_year) === '12th_pass')>12th Pass</option>
                      <option value="undergraduate" @selected(old('class_year', $profile->academic?->class_year) === 'undergraduate')>Undergraduate</option>
                      <option value="other" @selected(old('class_year', $profile->academic?->class_year) === 'other')>Other</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Board/University</label>
                    <select class="form-select" id="board" name="board">
                      <option value="">Select Board/University</option>
                      <option value="CBSE" @selected(old('board', $profile->academic?->board) === 'CBSE')>CBSE</option>
                      <option value="ICSE" @selected(old('board', $profile->academic?->board) === 'ICSE')>ICSE</option>
                      <option value="State Board" @selected(old('board', $profile->academic?->board) === 'State Board')>State Board</option>
                      <option value="IB" @selected(old('board', $profile->academic?->board) === 'IB')>IB</option>
                      <option value="University" @selected(old('board', $profile->academic?->board) === 'University')>University</option>
                      <option value="Other" @selected(old('board', $profile->academic?->board) === 'Other')>Other</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Target Exam Year</label>
                    <select class="form-select" id="targetYear" name="target_year">
                      <option value="">Select Year</option>
                      @for($year = date('Y'); $year <= date('Y') + 10; $year++)
                      <option value="{{ $year }}" @selected(old('target_year', $profile->academic?->target_year) == $year)>{{ $year }}</option>
                      @endfor
                     
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Mathematics Score (Last Exam)</label>
                    <input type="number" class="form-control" id="mathScore" name="math_score" min="0" max="100" placeholder="Enter percentage" value="{{ $profile->academic->math_score ?? '' }}">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Physics Score (Last Exam)</label>
                    <input type="number" class="form-control" id="physicsScore" name="physics_score" min="0" max="100" placeholder="Enter percentage" value="{{ $profile->academic->physics_score ?? '' }}">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Chemistry Score (Last Exam)</label>
                    <input type="number" class="form-control" id="chemistryScore" name="chemistry_score" min="0" max="100" placeholder="Enter percentage" value="{{ $profile->academic->chemistry_score ?? '' }}">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Biology Score (Last Exam)</label>
                    <input type="number" class="form-control" id="biologyScore" name="biology_score" min="0" max="100" placeholder="Enter percentage" value="{{ $profile->academic->biology_score ?? '' }}">
                  </div>
                  <div class="col-12">
                    <label class="form-label">Academic Achievements</label>
                    <textarea class="form-control" id="achievements" name="achievements" rows="3" placeholder="Mention any academic achievements, awards, or special mentions">{{ $profile->academic->achievements ?? '' }}</textarea>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Learning Goals</label>
                    <textarea class="form-control" id="goals" name="goals" rows="3" placeholder="What are your learning objectives and goals?">{{ $profile->academic->goals ?? '' }}</textarea>
                  </div>
                </div>
                <div class="mt-4">
                  <button type="submit" class="btn btn-warning">Save Academic Info</button>
                  <button type="button" class="btn btn-outline-secondary ms-2" onclick="resetAcademicForm()">Reset</button>
                </div>
              </form>
            </div>

            <!-- Security Tab -->
            <div class="tab-pane fade" id="security" role="tabpanel">
              <h5 class="mb-3">Account Security</h5>

              <!-- Change Password -->
              <div class="card border mb-4">
                <div class="card-header bg-light">
                  <h6 class="mb-0">Change Password</h6>
                </div>
                <div class="card-body">
                  <form id="passwordForm" action="{{ route('student.profile.password.update') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                      <div class="col-md-12">
                        <label class="form-label">Current Password *</label>
                        <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">New Password *</label>
                        <input type="password" class="form-control" id="newPassword" name="new_password" required>
                        <div class="progress mt-2" style="height: 6px;">
                          <div class="progress-bar" id="passwordStrength" style="width: 0%"></div>
                        </div>
                        <small class="text-muted">Password strength</small>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Confirm New Password *</label>
                        <input type="password" class="form-control" id="confirmedPassword" name="new_password_confirmation" required>
                      </div>
                      <div class="col-12">
                        <div id="passwordHints" class="small text-muted">
                          <span data-c="len" class="d-block">✓ At least 8 characters</span>
                          <span data-c="up" class="d-block">○ At least one uppercase letter</span>
                          <span data-c="lo" class="d-block">○ At least one lowercase letter</span>
                          <span data-c="num" class="d-block">○ At least one number</span>
                          <span data-c="sym" class="d-block">○ At least one special character</span>
                        </div>
                      </div>
                    </div>
                    <div class="mt-3">
                      <button type="submit" class="btn btn-warning">Update Password</button>
                    </div>
                  </form>
                </div>
              </div>

              <!-- Two-Factor Authentication -->
              <div class="card border mb-4">
                <div class="card-header bg-light">
                  <h6 class="mb-0">Two-Factor Authentication</h6>
                </div>
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <p class="mb-1">Add an extra layer of security to your account</p>
                      <small class="text-muted">Receive verification codes via SMS or authenticator app</small>
                    </div>
                    <button class="btn btn-outline-primary" onclick="setup2FA()">Setup 2FA</button>
                  </div>
                </div>
              </div>

              <!-- Login History -->
              <div class="card border">
                <div class="card-header bg-light">
                  <h6 class="mb-0">Recent Login Activity</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th>Date & Time</th>
                          <th>Device/Browser</th>
                          <th>Location</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody id="loginHistory">
                        <tr>
                          <td>2026-05-02 14:30</td>
                          <td>Chrome / Windows</td>
                          <td>Delhi, India</td>
                          <td><span class="badge bg-success">Success</span></td>
                        </tr>
                        <tr>
                          <td>2026-05-01 09:15</td>
                          <td>Safari / iPhone</td>
                          <td>Delhi, India</td>
                          <td><span class="badge bg-success">Success</span></td>
                        </tr>
                        <tr>
                          <td>2026-04-30 16:45</td>
                          <td>Chrome / Windows</td>
                          <td>Mumbai, India</td>
                          <td><span class="badge bg-warning">Failed</span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
    window.STATES_CITIES = @json($cities);

    document.addEventListener('DOMContentLoaded', function () {

        const stateSelect = document.getElementById('state');
        const citySelect  = document.getElementById('city');

        // Current saved city id from database
        const selectedCity = "{{ auth()->user()->city ?? '' }}";

        function loadCities(stateId, selectedCityId = '') {

            citySelect.innerHTML = '<option value="">Select city</option>';

            if (!stateId) return;

            const cities = window.STATES_CITIES[stateId] || [];

            cities.forEach(city => {

                const option = document.createElement('option');

                option.value = city.city_id;
                option.textContent = city.city_name;

                // Preselect city
                if (selectedCityId == city.city_id) {
                    option.selected = true;
                }

                citySelect.appendChild(option);
            });
        }

        // Load cities on state change
        stateSelect.addEventListener('change', function () {
            loadCities(this.value);
        });

        // Load cities on page load
        if (stateSelect.value) {
            loadCities(stateSelect.value, selectedCity);
        }

    });
</script>
@endsection