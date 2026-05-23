@extends('layouts.faculty')
@section('content')
<!-- Main Content -->
<div class="faculty-main" id="facultyMain">
  <!-- Top Bar -->
  <div class="faculty-topbar">
    <div class="faculty-topbar-title">
      <h4><i class="fas fa-user-circle me-2"></i>My Profile</h4>
      <small>Manage your personal information</small>
    </div>
  </div>
  <!-- Profile Section -->
  <div class="row">
    <div class="col-lg-4 mb-4">
      <!-- Profile Card -->
      <div class="form-section text-center">
        <div style="width: 120px; height: 120px; margin: 0 auto 20px; background: var(--faculty-accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 48px; color: white;">
          <i class="fas fa-user"></i>
        </div>
        <!-- Faculty Name -->
        <h4 class="fw-bold mb-1 text-dark">{{ ucwords($user->name) }}</h4>

        <!-- Main Course - Displayed as a subtitle -->
        <p class="text-primary fw-bold mb-2" style="font-size: 0.9rem; letter-spacing: 0.5px;">
          <i class="fas fa-graduation-cap me-1"></i>
          {{ getCourseNameById($user->facultyDetail?->course_id) }}
        </p>

        <!-- Sub Courses - Displayed as stylish Badges -->
        <div class="mb-2">
          @if($user->facultyDetail?->sub_course_ids)
          @foreach($user->facultyDetail->sub_course_ids as $sub_course_id)
          <span class="badge rounded-pill bg-light text-dark border me-1 mb-1" style="font-weight: 500;">
            <i class="fas fa-book-open me-1 text-secondary" style="font-size: 0.75rem;"></i>
            {{ getSubCatCourseNameById($sub_course_id) }}
          </span>
          @endforeach
          @endif
        </div>

        <!-- Subject - Displayed with a subtle icon -->
        <p class="text-muted small mb-3">
          @if($user->facultyDetail?->subject_id)
          <span class="d-inline-flex align-items-center">
            <i class="fas fa-microscope me-2"></i>
            Specialization: &nbsp;<strong> {{ getSubjectNameById($user->facultyDetail->subject_id) }}</strong>
          </span>
          @endif
        </p>


        <div class="mb-3">
          <span class="table-badge success"><i class="fas fa-check-circle me-1"></i>Verified</span>
        </div>
        <hr>
        <div class="text-start mt-3">
          <div class="row">
            <div class="col-md-6">
              <!-- Experience Item -->
              <div class="d-flex align-items-center mb-3">
                <div class="icon-box bg-soft-success rounded-3 me-3 text-center" style="width: 40px; height: 40px; line-height: 40px; background-color: #e8f5e9;">
                  <i class="fas fa-briefcase text-success"></i>
                </div>
                <div>
                  <small class="text-muted d-block" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">Experience</small>
                  <span class="fw-bold text-dark">{{ $user?->facultyDetail?->years_of_experience ?? '0' }} Years</span>
                </div>
              </div>
            </div>

            <!-- Qualification Item -->
            <div class="col-md-6">
              <div class="d-flex align-items-center mb-2">
                <div class="icon-box bg-soft-primary rounded-3 me-3 text-center" style="width: 40px; height: 40px; line-height: 40px; background-color: #e3f2fd;">
                  <i class="fas fa-user-graduate text-primary"></i>
                </div>
                <div>
                  <small class="text-muted d-block" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">Qualification</small>
                  <span class="fw-bold text-dark">{{ $user?->facultyDetail?->qualification ?? 'Not Specified' }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <!-- Edit Profile Form -->
      <div class="form-section">
        <h5 class="form-section-title">
          <i class="fas fa-edit me-2"></i>Edit Profile Information
        </h5>

        <form action="{{route('faculty.profile.update')}}" method="POST">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }} ">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" disabled>
            </div>
          </div>


          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" disabled>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="mb-3">
                <label class="form-label">Subject Specialization</label>
                <input type="text" class="form-control" value="{{ getSubjectNameById($user?->facultyDetail?->subject_id) ?? auth->user()->course_id }}" disabled>
              </div>

            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="mb-3">
                <label class="form-label">Qualification</label>
                <input type="text" class="form-control" id="qualification" name="qualification" value="{{ $user?->facultyDetail?->qualification }}">
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Years of Experience</label>
              <input type="number" class="form-control" id="experience" name="experience" value="{{ $user?->facultyDetail?->years_of_experience }}">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Bio</label>
            <textarea class="form-control" rows="4" id="bio" name="bio">{{ $user?->facultyDetail?->bio  }}</textarea>
          </div>

          <button type="submit" class="btn btn-gold">
            <i class="fas fa-save me-2"></i>Save Changes
          </button>
          <button type="reset" class="btn btn-outline-primary-faculty ms-2">
            <i class="fas fa-undo me-2"></i>Cancel
          </button>
        </form>
      </div>

      <!-- Change Password Section -->
      <div class="form-section mt-4">
        <h5 class="form-section-title">
          <i class="fas fa-key me-2"></i>Change Password
        </h5>

        <form action="{{ route('faculty.update.password') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label class="form-label">Current Password</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
              name="current_password" required>
            @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
              name="new_password" required>
            @error('new_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" class="form-control"
              name="new_password_confirmation" required>
          </div>

          <button type="submit" class="btn btn-gold">
            <i class="fas fa-refresh me-2"></i>Update Password
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection