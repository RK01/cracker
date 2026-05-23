@extends('layouts.admin')

@section('content')
<!-- Modern Icons UI & Fonts Link -->
<div class="container py-4">
    <!-- MAIN INTERACTIVE CONTAINER -->
    <div class="dashboard-card p-4 shadow-sm w-100">
        
        <!-- MODERN FILTERS SECTION (FLEX LAYOUT) -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-3 border-bottom border-light">
            <div>
                <h5 class="mb-1 fw-bold text-dark text-gradient" style="letter-spacing: -0.5px;">Faculty Directory</h5>
                <p class="text-muted mb-0 small">Manage registered professors, system allocations and stream assignments</p>
            </div>
            
            <div class="d-flex flex-wrap gap-2 alignment-responsive">
                <!-- Search wrapper with icon element inside -->
                <div class="d-flex align-items-center px-3 search-group-wrapper">
                    <i class="bi bi-search text-muted me-2"></i>
                    <input type="text" id="custom-search" class="form-control bg-transparent border-0 py-2 shadow-none sm-font" placeholder="Search name, email, credentials..." style="width: 250px; font-size: 0.9rem;">
                </div>
                
                <!-- Modern Minimal Dropdown Filter -->
                <div class="d-flex align-items-center px-3 search-group-wrapper">
                    <i class="bi bi-filter-left text-muted me-2 fs-5"></i>
                    <select id="custom-course-filter" class="form-select bg-transparent border-0 py-2 shadow-none sm-font" style="width: 180px; font-size: 0.9rem; cursor: pointer;">
                        <option value="">All Streams</option>
                       
                        @foreach($courses as $course)
                           
                               
                                <option value="{{ strtolower($course->name) }}">{{ $course->name }}</option>
                           
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- NEW TRENDING DATAGRID VIEW -->
        <div class="table-responsive" style="overflow-x: auto;">
            <table id="custom-faculty-table" class="table custom-table-modern align-middle mb-0">
                <thead>
                    <tr>
                        <th>Faculty Profile</th>
                        <th>Contact Scope</th>
                        <th>Main Course</th>
                        <th>Allocated Subject</th>
                        <th>Qualification</th>
                        <th>Experience</th>
                        <th class="text-center">Action Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($facultyLists as $facultyList)
                    @php $courseName = getCourseNameById($facultyList->course_id); @endphp
                    <tr class="faculty-row" data-course="{{ strtolower($courseName) }}">
                        <!-- Column 1: Identity Profile Card style -->
                        <td class="search-name">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-primary bg-light me-3" style="width: 42px; height: 42px; font-size: 0.95rem; border: 1px solid rgba(59, 130, 246, 0.1);">
                                    {{ substr($facultyList->name, 0, 2) }}
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-semibold text-slate-800" style="font-size: 0.93rem;">{{ ucwords($facultyList->name) }}</h6>
                                    <span class="text-muted small">ID: #00{{ $facultyList->id }}</span>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Column 2: Scope info grid -->
                        <td>
                            <div class="search-email fw-medium" style="font-size: 0.88rem;">{{ $facultyList->email }}</div>
                            <div class="search-phone text-muted mt-1 small"><i class="bi bi-telephone-outbound me-1"></i> +91 {{ $facultyList->phone }}</div>
                        </td>
                        
                        <!-- Column 3: Badges structure design -->
                        <td>
                            <span class="badge bg-light text-primary border border-primary-subtle rounded-pill px-3 py-2 fw-medium" style="font-size: 0.78rem;">
                                {{ $courseName }}
                            </span>
                        </td>
                        
                        <!-- Column 4: Subject context details -->
                        <td class="fw-medium text-secondary">
                            {{ $facultyList->facultyDetail?->subject_id 
                                ? getSubjectNameById($facultyList->facultyDetail->subject_id) 
                                : 'Not Assigned' }}
                        </td>
                        
                        <!-- Column 5: Academic strings profiles -->
                        <td>
                            <div class="badge bg-body-secondary text-dark px-2.5 py-1.5 rounded" style="font-size: 0.8rem; font-weight: 500;">
                                {{ $facultyList->facultyDetail->qualification ?? 'Pending' }}
                            </div>
                        </td>
                        
                        <!-- Column 6: Years metrics timeline tracking -->
                        <td>
                            <div class="fw-semibold text-emerald-700" style="font-size: 0.9rem; color: #0f766e;">
                                <i class="bi bi-briefcase me-1 text-muted"></i>
                                {{ !empty(trim($facultyList->facultyDetail->years_of_experience ?? '')) ? $facultyList->facultyDetail->years_of_experience . ' Yrs' : '0 Yrs' }}
                            </div>
                        </td>
                        
                        <!-- Column 7: Floating controls actions buttons icons elements -->
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-1.5">
                                <button type="button" class="action-icon-btn edit-btn" 
                                        title="Modify Core Configuration"
                                        onclick="openEditModal({{ json_encode($facultyList) }})">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </button>

                                <form action="{{ route('admin.faculty.destroy', $facultyList->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently erase this record profile?');" class="d-inline m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-icon-btn delete-btn" title="Purge Record">
                                        <i class="bi bi-trash3 fs-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted shadow-none bg-transparent">
                            <i class="bi bi-folder-x fs-1 text-light d-block mb-2"></i>
                            No matching operational records found in the engine scope.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('model')
<!-- ==================== MODERN MODAL DIALOG CONTAINER ==================== -->
<div class="modal fade" id="editFacultyModal" static tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg animate-fade-in" style="border-radius: 18px; overflow: hidden;">
            <div class="modal-header px-4 py-3 border-bottom-0 bg-dark text-white">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-3 p-2 d-flex align-items-center justify-content-center me-3" style="width: 38px; height: 38px;">
                        <i class="bi bi-sliders2 fs-5"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold mb-0" id="editModalLabel" style="font-size: 1.1rem; letter-spacing: -0.3px;">Configuration Control</h5>
                        <p class="mb-0 text-muted small" style="font-size: 0.75rem;">Modify and re-align system permissions rulesets</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="edit-faculty-form" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4 bg-white">
                    
                    <!-- Section Meta Header -->
                    <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">Core Credentials Mapping</div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Full Name Structure</label>
                            <input type="text" name="name" id="modal-name" class="form-control form-control-md rounded-3" required style="padding: 10px 14px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Secured Email Pipeline</label>
                            <input type="email" name="email" id="modal-email" class="form-control form-control-md rounded-3" required style="padding: 10px 14px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Phone Number String</label>
                            <input type="text" name="phone" id="modal-phone" maxlength="10" class="form-control form-control-md rounded-3" required style="padding: 10px 14px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">System Account Username</label>
                            <input type="text" name="username" id="modal-username" class="form-control form-control-md rounded-3" required style="padding: 10px 14px;">
                        </div>
                    </div>

                    <div class="text-uppercase text-muted fw-bold small mt-4 mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">Academic Matrices Routing</div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-secondary">Core Faculty Category</label>
                            <select name="course_id" id="modal-course_id" class="form-select form-select-md rounded-3" required style="padding: 10px 14px;">
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-secondary">Sub Stream Assignment</label>
                            <select name="sub_cat_course_id[]" id="modal-sub_course_id" class="form-select form-select-md rounded-3" multiple required style="min-height: 46px;">
                                <!-- Managed dynamically -->
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-secondary">Target Core Subject</label>
                            <select name="subject_id" id="modal-subject_id" class="form-select form-select-md rounded-3" required style="padding: 10px 14px;">
                                <option value="">Select Subject</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Profile Qualification Label</label>
                            <input type="text" name="qualification" id="modal-qualification" class="form-control form-control-md rounded-3" style="padding: 10px 14px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Validated Professional Experience (Yrs)</label>
                            <input type="number" name="years_of_experience" id="modal-experience" class="form-control form-control-md rounded-3" style="padding: 10px 14px;">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold text-secondary">Profile Bio / Dossier Details</label>
                            <textarea name="bio" id="modal-bio" class="form-control rounded-3" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="text-uppercase text-muted fw-bold small mt-4 mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">Security Overrides</div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Assign New Encryption Password</label>
                            <input type="password" name="password" class="form-control form-control-md rounded-3" placeholder="Leave untouched to bypass overwrite" style="padding: 10px 14px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Verify Encryption Ruleset</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-md rounded-3" placeholder="Leave untouched to bypass overwrite" style="padding: 10px 14px;">
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer px-4 py-3 bg-light border-top-0 d-flex gap-2">
                    <button type="button" class="btn btn-light border px-4 py-2 text-secondary fw-semibold rounded-3" data-bs-dismiss="modal" style="font-size: 0.9rem;">Discard</button>
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold rounded-3" style="font-size: 0.9rem; background-color: #2563eb; border: none;">Save Realignment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. VANILLA SEARCH FILTERS ---
    const searchInput = document.getElementById('custom-search');
    const courseFilter = document.getElementById('custom-course-filter');
    const tableRows = document.querySelectorAll('.faculty-row');

    function filterTable() {
        const query = searchInput.value.toLowerCase().trim();
        const selectedCourse = courseFilter.value.toLowerCase();

        tableRows.forEach(row => {
            const name = row.querySelector('.search-name').textContent.toLowerCase();
            const email = row.querySelector('.search-email').textContent.toLowerCase();
            const phone = row.querySelector('.search-phone').textContent.toLowerCase();
            const courseAttr = row.getAttribute('data-course');

            const searchMatches = name.includes(query) || email.includes(query) || phone.includes(query);
            const courseMatches = selectedCourse === '' || courseAttr === selectedCourse;

            row.style.display = (searchMatches && courseMatches) ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    courseFilter.addEventListener('change', filterTable);

    // --- 2. MULTI-LEVEL DRILL DROPDOWNS CHAINING ---
    const modalCourse = document.getElementById('modal-course_id');
    const modalSubCourse = document.getElementById('modal-sub_course_id');

    modalCourse.addEventListener('change', function() {
        loadSubCourses(this.value);
    });

    modalSubCourse.addEventListener('change', function() {
        let selectedOpts = Array.from(modalSubCourse.selectedOptions).map(o => o.value);
        if(selectedOpts.length > 0) {
            loadSubjects(selectedOpts[0]);
        }
    });
});

// Helper fetch API processors
function loadSubCourses(courseId, selectedValues = []) {
    const subSel = document.getElementById('modal-sub_course_id');
    subSel.innerHTML = '<option value="">Loading Data...</option>';
    if(!courseId) return Promise.resolve();

    return fetch(`/get-sub-courses/${courseId}`)
        .then(res => res.json())
        .then(data => {
            subSel.innerHTML = '';
            data.forEach(item => {
                let opt = document.createElement('option');
                opt.value = item.id;
                opt.textContent = item.name;
                if(selectedValues.includes(item.id.toString()) || selectedValues.includes(item.id)) {
                    opt.selected = true;
                }
                subSel.appendChild(opt);
            });
        });
}

function loadSubjects(subCourseId, selectedValue = null) {
    const subjButton = document.getElementById('modal-subject_id');
    subjButton.innerHTML = '<option value="">Syncing...</option>';
    if(!subCourseId) return Promise.resolve();

    return fetch(`/get-subjects/${subCourseId}`)
        .then(res => res.json())
        .then(data => {
            subjButton.innerHTML = '<option value="">Select Subject</option>';
            data.forEach(item => {
                let opt = document.createElement('option');
                opt.value = item.id;
                opt.textContent = item.name;
                if(selectedValue && item.id == selectedValue) opt.selected = true;
                subjButton.appendChild(opt);
            });
        });
}

// --- 3. MODAL PROFILE INJECTOR & RENDER ---
function openEditModal(user) {
    const form = document.getElementById('edit-faculty-form');
    form.action = `/admin/faculty/${user.id}`;

    // Values injection
    document.getElementById('modal-name').value = user.name || '';
    document.getElementById('modal-email').value = user.email || '';
    document.getElementById('modal-phone').value = user.phone || '';
    document.getElementById('modal-username').value = user.username || '';
    document.getElementById('modal-course_id').value = user.course_id || '';

    const detail = user.faculty_detail || {};
    document.getElementById('modal-qualification').value = detail.qualification || '';
    document.getElementById('modal-experience').value = detail.years_of_experience || '';
    document.getElementById('modal-bio').value = detail.bio || '';

    const selectedSubCourses = detail.sub_course_ids || [];
    const selectedSubject = detail.subject_id || null;

    if(user.course_id) {
        loadSubCourses(user.course_id, selectedSubCourses).then(() => {
            if(selectedSubCourses.length > 0) {
                loadSubjects(selectedSubCourses[0], selectedSubject);
            } else {
                document.getElementById('modal-subject_id').innerHTML = '<option value="">Select Subject</option>';
            }
        });
    } else {
        document.getElementById('modal-sub_course_id').innerHTML = '';
        document.getElementById('modal-subject_id').innerHTML = '<option value="">Select Subject</option>';
    }

    const editModal = new bootstrap.Modal(document.getElementById('editFacultyModal'));
    editModal.show();
}
</script>
@endsection