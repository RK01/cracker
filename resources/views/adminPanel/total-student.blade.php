@extends('layouts.admin')
@section('content')
<div class="container py-4">
    <div class="dashboard-card p-4 shadow-sm w-100">
        
        <!-- TOP STREAM CONTROL FILTERS -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-3 border-bottom border-light">
            <div>
                <h5 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Student Roster Matrix</h5>
                <p class="text-muted mb-0 small">Overview of enrolled candidate paths, core profiles, and academic configurations</p>
            </div>
            
            <div class="d-flex flex-wrap gap-2">
                <!-- Live Text Input Engine -->
                <div class="d-flex align-items-center px-3 search-group-wrapper">
                    <i class="bi bi-search text-muted me-2"></i>
                    <input type="text" id="custom-search" class="form-control bg-transparent border-0 py-2 shadow-none" 
                           placeholder="Search name, email, credentials..." 
                           value="{{ request('search') }}" style="width: 250px; font-size: 0.9rem;">
                </div>
                
                <!-- Stream Dropdown -->
                <div class="d-flex align-items-center px-3 search-group-wrapper">
                    <i class="bi bi-funnel text-muted me-2"></i>
                    <select id="custom-course-filter" class="form-select bg-transparent border-0 py-2 shadow-none" style="width: 180px; font-size: 0.9rem; cursor: pointer;">
                        <option value="">All Streams</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- TRENDING HIGH-FIDELITY TABLE CONTAINER -->
        <div class="table-responsive" id="table-data-wrapper">
            <table id="custom-student-table" class="table custom-table-modern align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 70px;">Sr. No.</th>
                        <th>Student Profile</th>
                        <th>Contact Pipelines</th>
                        <th>Enrolled Stream</th>
                        <th>Blood Group</th>
                        <th>Emergency Contact</th>
                        <th class="text-center">Action Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($studentLists as $index => $student)
                    @php $courseName = getCourseNameById($student->course_id); @endphp
                    <tr class="student-row">
                        <td class="text-center fw-semibold text-secondary">
                            {{ ($studentLists->currentPage() - 1) * $studentLists->perPage() + $loop->iteration }}
                        </td>
                        <td class="search-name">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-success bg-light me-3" style="width: 42px; height: 42px; font-size: 0.95rem; border: 1px solid rgba(16, 185, 129, 0.15);">
                                    {{ strtoupper(substr($student->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-semibold text-slate-800" style="font-size: 0.93rem;">{{ ucwords($student->name) }}</h6>
                                    <span class="text-muted small">UID: #STU-0{{ $student->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="fw-medium" style="font-size: 0.88rem;">{{ $student->email }}</div>
                            <div class="text-muted mt-1 small"><i class="bi bi-telephone-outbound me-1"></i> +91 {{ $student->phone }}</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-success border border-success-subtle rounded-pill px-3 py-2 fw-medium" style="font-size: 0.78rem;">
                                {{ $courseName }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-soft-danger px-2.5 py-1.5 rounded-3 fw-semibold" style="font-size: 0.8rem;">
                                <i class="bi bi-drop-fill me-0.5"></i>{{ $student->profile->blood_group ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="text-secondary fw-medium">
                            {{ $student->profile->emergency_contact ?? 'N/A' }}
                        </td>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <button type="button" class="action-icon-btn edit-btn" onclick="openEditModal({{ json_encode($student) }})">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </button>
                                <form action="{{ route('admin.student.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="d-inline m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-icon-btn delete-btn">
                                        <i class="bi bi-trash3 fs-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-folder-x fs-1 text-light d-block mb-2"></i>
                            No matching active candidates located in system memory.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Bootstrap Appended Pagination Links Engine -->
            <div class="d-flex justify-content-between align-items-center mt-4 px-2">
                <div class="text-muted small fw-medium">
                    Showing {{ $studentLists->firstItem() ?? 0 }} to {{ $studentLists->lastItem() ?? 0 }} of {{ $studentLists->total() }} entries
                </div>
                <div class="pagination-wrapper modern-render">
                    {{ $studentLists->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('model')
<!-- ==================== PREMIUM EDIT STUDENT MODAL ==================== -->
<div class="modal fade" id="editStudentModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 18px; overflow: hidden;">
            <div class="modal-header px-4 py-3 bg-dark text-white border-bottom-0">
                <div class="d-flex align-items-center">
                    <div class="bg-success text-white rounded-3 p-2 d-flex align-items-center justify-content-center me-3" style="width: 38px; height: 38px;">
                        <i class="bi bi-sliders2 fs-5"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold mb-0" id="editModalLabel" style="font-size: 1.1rem; letter-spacing: -0.3px;">Candidate Profile Realignment</h5>
                        <p class="mb-0 text-muted small" style="font-size: 0.75rem;">Modify structural metadata parameters for records synchronization</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="edit-student-form" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4 bg-white">
                    
                    <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">Core Account Identities</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Full Name Legal Structure</label>
                            <input type="text" name="name" id="modal-name" class="form-control rounded-3" required style="padding: 10px 14px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Secured Email Address Pipeline</label>
                            <input type="email" name="email" id="modal-email" class="form-control rounded-3" required style="padding: 10px 14px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Primary Mobile String</label>
                            <input type="text" name="phone" id="modal-phone" maxlength="10" class="form-control rounded-3" required style="padding: 10px 14px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">System Account Username</label>
                            <input type="text" name="username" id="modal-username" class="form-control rounded-3" required style="padding: 10px 14px;">
                        </div>
                    </div>

                    <div class="text-uppercase text-muted fw-bold small mt-4 mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">Academic Routing & Specifics</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Core Enrolled Course Track</label>
                            <select name="course_id" id="modal-course_id" class="form-select rounded-3" required style="padding: 10px 14px;">
                                <option value="">Select Stream Track</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Blood Group Matrix</label>
                            <select name="blood_group" id="modal-blood_group" class="form-select rounded-3" style="padding: 10px 14px;">
                                <option value="">Unknown / Select Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Emergency Alternative Contact</label>
                            <input type="text" name="emergency_contact" id="modal-emergency" maxlength="10" class="form-control rounded-3" style="padding: 10px 14px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Gender Designation</label>
                            <select name="gender" id="modal-gender" class="form-select rounded-3" style="padding: 10px 14px;">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold text-secondary">Permanent Residence Address Dossier</label>
                            <textarea name="address" id="modal-address" class="form-control rounded-3" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="text-uppercase text-muted fw-bold small mt-4 mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">Security Pipeline Access</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Assign New Cipher Password</label>
                            <input type="password" name="password" class="form-control rounded-3" placeholder="Leave untouched to bypass overwrite" style="padding: 10px 14px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Verify Cipher Rule Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control rounded-3" placeholder="Leave untouched to bypass overwrite" style="padding: 10px 14px;">
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer px-4 py-3 bg-light border-top-0 d-flex gap-2">
                    <button type="button" class="btn btn-light border px-4 py-2 text-secondary fw-semibold rounded-3" data-bs-dismiss="modal" style="font-size: 0.9rem;">Discard</button>
                    <button type="submit" class="btn btn-success px-4 py-2 fw-semibold rounded-3" style="font-size: 0.9rem; background-color: #10b981; border: none;">Apply Overrides</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('custom-search');
    const courseFilter = document.getElementById('custom-course-filter');
    const tableWrapper = document.getElementById('table-data-wrapper');
    let debounceTimer;

    // Core AJAX Data Transmission Engine
    function fetchFilteredData(targetUrl) {
        const url = new URL(targetUrl);
        const searchValue = searchInput.value.trim();
        const courseValue = courseFilter.value;

        // Synchronize input parameters state safely
        if (searchValue) url.searchParams.set('search', searchValue);
        else url.searchParams.delete('search');

        if (courseValue) url.searchParams.set('course_id', courseValue);
        else url.searchParams.delete('course_id');

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            // Update browser URL context history cleanly
            window.history.pushState({ path: url.href }, '', url.href);
            
            // Re-render internal matrix partition structure safely
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const targetContent = doc.getElementById('table-data-wrapper');
            
            if (targetContent) {
                tableWrapper.innerHTML = targetContent.innerHTML;
                bindPaginationInterceptors(); // Re-assign dynamic links listener
            }
        })
        .catch(error => console.error('Data sync infrastructure failure:', error));
    }

    // Intercept standard pagination link behaviors
    function bindPaginationInterceptors() {
        const links = tableWrapper.querySelectorAll('.pagination a');
        links.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Break native standard request reload cycle
                fetchFilteredData(this.href);
            });
        });
    }

    // Reset pagination context index parameters to page 1 on search text updates
    function triggerPipelineSearch() {
        const baseLocation = window.location.protocol + "//" + window.location.host + window.location.pathname;
        const freshUrl = new URL(baseLocation);
        freshUrl.searchParams.set('page', '1');
        fetchFilteredData(freshUrl.href);
    }

    // Input debounce logic for keystroke listening operations
    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(triggerPipelineSearch, 400); 
    });

    courseFilter.addEventListener('change', triggerPipelineSearch);

    // Run baseline bindings setup
    bindPaginationInterceptors();
});

// Dynamic Modal Object Mapper Instantiation Engine
function openEditModal(student) {
    const form = document.getElementById('edit-student-form');
    form.action = `/admin/student/${student.id}`;

    document.getElementById('modal-name').value = student.name || '';
    document.getElementById('modal-email').value = student.email || '';
    document.getElementById('modal-phone').value = student.phone || '';
    document.getElementById('modal-username').value = student.username || '';
    document.getElementById('modal-course_id').value = student.course_id || '';

    const profile = student.profile || {};
    document.getElementById('modal-blood_group').value = profile.blood_group || '';
    document.getElementById('modal-emergency').value = profile.emergency_contact || '';
    document.getElementById('modal-gender').value = profile.gender || '';
    document.getElementById('modal-address').value = profile.address || '';

    const studentModal = new bootstrap.Modal(document.getElementById('editStudentModal'));
    studentModal.show();
}
</script>
@endsection