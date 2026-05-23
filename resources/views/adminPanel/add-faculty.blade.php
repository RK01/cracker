@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <!-- Premium Card Container Design Matrix -->
    <div class="card border-0 shadow-sm w-100 mb-4" style="border-radius: 16px; overflow: hidden; background-color: #ffffff;">
        
        <!-- Modern Header Element Segment -->
        <div class="card-header bg-white px-4 py-3 border-bottom border-light d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white rounded-3 p-2 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #3b82f6, #1d4ed8);">
                    <i class="bi bi-person-plus-fill fs-5"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold text-dark" style="letter-spacing: -0.3px; font-size: 1.15rem;">User Account Deployment</h5>
                    <p class="text-muted mb-0 small" style="font-size: 0.8rem;">Initialize structural profiles configurations for Students, Faculty, or System Admins</p>
                </div>
            </div>
            <span class="badge bg-light text-secondary border rounded-pill px-3 py-2 fw-medium small">Memory Allocation: Active</span>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('admin.faculty.store') }}" method="POST">
                @csrf
                
                <!-- Section 1: Core Profile Identities -->
                <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">
                    <i class="bi bi-shield-lock-fill me-1 text-primary"></i> Core Credentials Identity
                </div>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Full Name Legal Structure</label>
                        <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" value="{{ old('name') }}" required style="padding: 11px 14px; font-size: 0.9rem;">
                        @error('name') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Secured Email Address Pipeline</label>
                        <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" required style="padding: 11px 14px; font-size: 0.9rem;">
                        @error('email') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Primary Mobile String</label>
                        <input type="text" name="phone" maxlength="10" class="form-control rounded-3 @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required style="padding: 11px 14px; font-size: 0.9rem;">
                        @error('phone') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">System Account Role Type</label>
                        <select name="role" class="form-select rounded-3 @error('role') is-invalid @enderror" style="padding: 11px 14px; font-size: 0.9rem; cursor: pointer;">
                            <option value="">Select Account Role</option>
                            <option value="faculty" {{ old('role') == 'faculty' ? 'selected' : '' }}>Faculty Track</option>
                            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student Matrix</option>
                        </select>
                        @error('role') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <hr class="text-light my-4">

                <!-- Section 2: Academic Program Configurations -->
                <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">
                    <i class="bi bi-book-half me-1 text-success"></i> Academic Routing Matrix
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-secondary">Core Enrolled Course Track</label>
                        <select id="course_id" name="course_id" class="form-select rounded-3 @error('course_id') is-invalid @enderror" required style="padding: 11px 14px; font-size: 0.9rem; cursor: pointer;">
                            <option value="">Select Course Track</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}> {{ $course->name }}</option>
                            @endforeach
                        </select>
                        @error('course_id') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-secondary">Sub Course Allocations (Multi-Select)</label>
                        <select id="sub_cat_course_id" name="sub_cat_course_id[]" multiple class="form-select rounded-3 @error('sub_cat_course_id') is-invalid @enderror" required style="padding: 11px 14px; font-size: 0.9rem; min-height: 45px;">
                            <option value="">Select Sub Course</option>
                        </select>
                        @error('sub_cat_course_id') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-secondary">Primary Associated Subject</label>
                        <select id="subject_id" name="subject_id" class="form-select rounded-3 @error('subject_id') is-invalid @enderror" required style="padding: 11px 14px; font-size: 0.9rem; cursor: pointer;">
                            <option value="">Select Subject</option>
                        </select>
                        @error('subject_id') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <hr class="text-light my-4">

                <!-- Section 3: Localization Parameters -->
                <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">
                    <i class="bi bi-geo-alt-fill me-1 text-danger"></i> Regional Localization Dossier
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Regional State Hub</label>
                        <select id="state_id" name="state_id" class="form-select rounded-3 @error('state_id') is-invalid @enderror" required style="padding: 11px 14px; font-size: 0.9rem; cursor: pointer;">
                            <option value="">Select State Hub</option>
                            @foreach($states as $state)
                            <option value="{{$state->state_id}}">{{$state->state_name}}</option>
                            @endforeach
                        </select>
                        @error('state_id') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Target City Operational Zone</label>
                        <select id="city_id" name="city_id" class="form-select rounded-3 @error('city_id') is-invalid @enderror" required style="padding: 11px 14px; font-size: 0.9rem; cursor: pointer;">
                            <option value="">Select City Zone</option>
                        </select>
                        @error('city_id') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <hr class="text-light my-4">

                <!-- Section 4: Secure Cipher Protection -->
                <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">
                    <i class="bi bi-key-fill me-1 text-warning"></i> Security Safeguard Key
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Assign New Cipher Password</label>
                        <input type="password" name="password" class="form-control rounded-3 @error('password') is-invalid @enderror" required style="padding: 11px 14px; font-size: 0.9rem;" placeholder="••••••••">
                        @error('password') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Verify Cipher Rule Confirmation</label>
                        <input type="password" name="password_confirmation" class="form-control rounded-3" required style="padding: 11px 14px; font-size: 0.9rem;" placeholder="••••••••">
                    </div>
                </div>

                <!-- Final Deployment Submission Actions -->
                <div class="col-12 mt-4 pt-3 border-top border-light text-end">
                    <button type="button" class="btn btn-light px-4 py-2 text-secondary fw-semibold rounded-3 me-2" onclick="window.history.back();" style="font-size: 0.9rem; border: 1px solid #e2e8f0;">Cancel Matrix</button>
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold rounded-3 shadow-sm" style="font-size: 0.9rem; background-color: #2563eb; border: none;">
                        <i class="bi bi-cloud-upload-fill me-1"></i> Register System Node
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fix typographical attribute bug 'selcted' inline checking parameters
        // 1. Jab Course change ho -> Sub Course load karein
        $('#course_id').on('change', function() {
            let courseId = $(this).val();
            $('#sub_cat_course_id').empty().append('<option value="">Loading...</option>').prop('disabled', true);
            $('#subject_id').empty().append('<option value="">Select Subject</option>').prop('disabled', true);

            if (courseId) {
                $.ajax({
                    url: "{{ url('/get-sub-courses') }}/" + courseId,
                    type: "GET",
                    success: function(data) {
                        $('#sub_cat_course_id').empty().append('<option value="">Select Sub Course</option>').prop('disabled', false);
                        $.each(data, function(key, value) {
                            $('#sub_cat_course_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });

        // 2. Jab Sub Course change ho -> Subject load karein
        $('#sub_cat_course_id').on('change', function() {
            let subCourseId = $(this).val();
            $('#subject_id').empty().append('<option value="">Loading...</option>').prop('disabled', true);

            if (subCourseId) {
                $.ajax({
                    url: "{{ url('/get-subjects') }}/" + subCourseId,
                    type: "GET",
                    success: function(data) {
                        $('#subject_id').empty().append('<option value="">Select Subject</option>').prop('disabled', false);
                        $.each(data, function(key, value) {
                            $('#subject_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });

        // 3. State change triggers city sync engine
        $('#state_id').on('change', function() {
            let subCourseId = $(this).val();
            $('#city_id').empty().append('<option value="">Loading...</option>').prop('disabled', true);

            if (subCourseId) {
                $.ajax({
                    url: "{{ url('/get-city') }}/" + subCourseId,
                    type: "GET",
                    success: function(data) {
                        $('#city_id').empty().append('<option value="">Select City Zone</option>').prop('disabled', false);
                        $.each(data, function(key, value) {
                            $('#city_id').append('<option value="' + value.city_id + '">' + value.city_name + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>
@endsection