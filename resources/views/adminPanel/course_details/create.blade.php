@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm w-100 mb-4" style="border-radius: 16px; overflow: hidden; background-color: #ffffff;">
        <div class="d-flex align-items-center justify-content-between my-4 px-4 pb-3 border-bottom">
           <a href="{{ url()->previous() }}" class="btn btn-sm btn-light border rounded-3 mb-2"><i class="bi bi-arrow-left me-1"></i> Back</a>
        </div>
        <div class="card-header bg-white px-4 py-3 border-bottom border-light d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white rounded-3 p-2 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                    <i class="bi bi-diagram-3 fs-5"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold text-dark" style="letter-spacing: -0.3px; font-size: 1.15rem;">Initialize Full Relational Course Stack</h5>
                    <p class="text-muted mb-0 small" style="font-size: 0.8rem;">Maps single/multiple sub-categories under master course entities safely</p>
                </div>
            </div>
            <span class="badge bg-light text-secondary border rounded-pill px-3 py-2 fw-medium small">Flow: Dynamic Relational Form</span>
        </div>

        <div class="card-body p-4">
            @if(session('error'))
            <div class="alert alert-danger rounded-3 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            </div>
            @endif

            <form action="{{ route('admin.course-details.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Section 1: Dynamic Top-Level Relational Selection -->
                <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">
                    <i class="bi bi-bezier2 me-1 text-primary"></i> 1. Master Course & Sub-Category Mapping
                </div>

                <!-- Selection Mode Radios -->
                <div class="d-flex gap-4 mb-3 px-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="course_mode" id="modeExisting" value="existing" {{ old('course_mode', 'existing') == 'existing' ? 'checked' : '' }}>
                        <label class="form-check-label small fw-semibold text-dark" style="cursor: pointer;" for="modeExisting">
                            Link to Existing Master Course
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="course_mode" id="modeNew" value="new" {{ old('course_mode') == 'new' ? 'checked' : '' }}>
                        <label class="form-check-label small fw-semibold text-dark" style="cursor: pointer;" for="modeNew">
                            Create Fresh Master Course
                        </label>
                    </div>
                </div>

                <div class="row g-3 mb-4 bg-light p-3 rounded-4 border border-light">
                    <!-- Option A: Existing Dropdown -->
                    <div class="col-md-4" id="existing-course-wrapper">
                        <label class="form-label small fw-semibold text-secondary">Select Existing Master Course</label>
                        <select name="course_id" id="course_id" class="form-select rounded-3 @error('course_id') is-invalid @enderror" style="padding: 11px 14px; font-size: 0.9rem;">
                            <option value="">-- Choose Master Course --</option>
                            @foreach($courses as $c)
                                <option value="{{ $c->id }}" {{ old('course_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                            @endforeach
                        </select>
                        @error('course_id') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Option A Part 2: Dependent Cascading Sub-Category Dropdown -->
                    <div class="col-md-4" id="existing-sub-wrapper">
                        <label class="form-label small fw-semibold text-secondary">Target Sub-Category / Stream</label>
                        <select name="sub_course_id" id="sub_course_select" class="form-select rounded-3 @error('sub_course_id') is-invalid @enderror" style="padding: 11px 14px; font-size: 0.9rem;" disabled>
                            <option value="">-- Choose Master Course First --</option>
                        </select>
                        @error('sub_course_id') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Option B: New Course Input -->
                    <div class="col-md-4 d-none" id="new-course-wrapper">
                        <label class="form-label small fw-semibold text-secondary">New Master Course Name</label>
                        <input type="text" name="course_name" id="course_name" value="{{ old('course_name') }}" class="form-control rounded-3 @error('course_name') is-invalid @enderror" placeholder="e.g., Engineering Entrance Management">
                        @error('course_name') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Option B Part 2: New Sub Category Input Field -->
                    <div class="col-md-4 d-none" id="new-sub-wrapper">
                        <label class="form-label small fw-semibold text-secondary">New Sub Category Scope Layer</label>
                        <input type="text" name="sub_cat_name" id="sub_cat_name" value="{{ old('sub_cat_name') }}" class="form-control rounded-3 @error('sub_cat_name') is-invalid @enderror" placeholder="e.g., JEE Advanced Revision Pack" style="padding: 11px 14px; font-size: 0.9rem;">
                        @error('sub_cat_name') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Option B Part 3: New Course Status -->
                    <div class="col-md-4 d-none" id="new-status-wrapper">
                        <label class="form-label small fw-semibold text-secondary">Master Status</label>
                        <select name="status" id="status" class="form-select rounded-3 @error('status') is-invalid @enderror" style="padding: 11px 14px; font-size: 0.9rem;">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <hr class="text-light my-4">

                <!-- Section 2: Core Matrix Definitions -->
                <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">
                    <i class="bi bi-shield-lock-fill me-1 text-info"></i> 2. Presentation Details Title Block
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-12">
                        <label class="form-label small fw-semibold text-secondary">Display Custom Marketing Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control rounded-3 @error('title') is-invalid @enderror" required placeholder="e.g., Ultimate Elite Batch for JEE Advanced" style="padding: 11px 14px; font-size: 0.9rem;">
                        @error('title') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-semibold text-secondary">Deep Marketing / Structure Description</label>
                        <textarea name="description" rows="3" class="form-control rounded-3 @error('description') is-invalid @enderror" required style="font-size: 0.9rem; padding: 11px 14px;" placeholder="Provide systemic architectural scope details components...">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <hr class="text-light my-4">

                <!-- Section 3: Metrics & Core Specifications -->
                <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">
                    <i class="bi bi-sliders me-1 text-success"></i> 3. Commercial Specifications & Metrics
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">Duration Layout</label>
                        <input type="text" name="duration" value="{{ old('duration') }}" class="form-control rounded-3 @error('duration') is-invalid @enderror" required placeholder="e.g., 1 Year / 6 Months" style="padding: 11px 14px; font-size: 0.9rem;">
                        @error('duration') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">Batch Size Metric</label>
                        <input type="text" name="batch_size" value="{{ old('batch_size') }}" class="form-control rounded-3 @error('batch_size') is-invalid @enderror" required placeholder="e.g., 30 Seats/Batch" style="padding: 11px 14px; font-size: 0.9rem;">
                        @error('batch_size') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">Price Schema Engine</label>
                        <input type="text" name="price" value="{{ old('price') }}" class="form-control rounded-3 @error('price') is-invalid @enderror" required placeholder="e.g., 75,000 INR" style="padding: 11px 14px; font-size: 0.9rem;">
                        @error('price') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">Display Vector Media Graphics</label>
                        <input type="file" name="image" class="form-control rounded-3 @error('image') is-invalid @enderror" required style="padding: 11px 14px; font-size: 0.9rem;">
                        @error('image') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <hr class="text-light my-4">

                <!-- Section 4: Advanced Architecture Data Arrays -->
                <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">
                    <i class="bi bi-tags-fill me-1 text-warning"></i> 4. Dynamic Array Attribute Configurations
                </div>

                <div class="row">
                    <!-- Includes Section Component -->
                    <div class="col-md-6 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label small fw-semibold text-secondary m-0">What Package Includes</label>
                            <button type="button" class="btn btn-sm btn-outline-primary py-1 dynamic-append-trigger" data-target="includes-box" style="font-size: 0.8rem; border-radius: 6px;"><i class="bi bi-plus-circle"></i> Append</button>
                        </div>
                        <div id="includes-box" class="dynamic-inputs-cluster">
                            <div class="input-group mb-2">
                                <input type="text" name="includes[]" class="form-control rounded-start-3" required placeholder="e.g., Live Sessions + PDFs" style="padding: 10px 14px; font-size: 0.9rem;">
                                <button type="button" class="btn btn-outline-danger remove-input-row"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Highlights Section Component -->
                    <div class="col-md-6 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label small fw-semibold text-secondary m-0">Highlights Matrix</label>
                            <button type="button" class="btn btn-sm btn-outline-primary py-1 dynamic-append-trigger" data-target="highlights-box" style="font-size: 0.8rem; border-radius: 6px;"><i class="bi bi-plus-circle"></i> Append</button>
                        </div>
                        <div id="highlights-box" class="dynamic-inputs-cluster">
                            <div class="input-group mb-2">
                                <input type="text" name="highlights[]" class="form-control rounded-start-3" required placeholder="e.g., Personalized Mentorship Profiles" style="padding: 10px 14px; font-size: 0.9rem;">
                                <button type="button" class="btn btn-outline-danger remove-input-row"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Syllabus Section Component -->
                    <div class="col-md-6 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label small fw-semibold text-secondary m-0">Syllabus Overview Blocks</label>
                            <button type="button" class="btn btn-sm btn-outline-primary py-1 dynamic-append-trigger" data-target="syllabus-box" style="font-size: 0.8rem; border-radius: 6px;"><i class="bi bi-plus-circle"></i> Append</button>
                        </div>
                        <div id="syllabus-box" class="dynamic-inputs-cluster">
                            <div class="input-group mb-2">
                                <input type="text" name="syllabus[]" class="form-control rounded-start-3" required placeholder="e.g., Mathematics: Coordinate Geometry" style="padding: 10px 14px; font-size: 0.9rem;">
                                <button type="button" class="btn btn-outline-danger remove-input-row"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- What You Get Section Component -->
                    <div class="col-md-6 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label small fw-semibold text-secondary m-0">What You Get Output</label>
                            <button type="button" class="btn btn-sm btn-outline-primary py-1 dynamic-append-trigger" data-target="get-box" style="font-size: 0.8rem; border-radius: 6px;"><i class="bi bi-plus-circle"></i> Append</button>
                        </div>
                        <div id="get-box" class="dynamic-inputs-cluster">
                            <div class="input-group mb-2">
                                <input type="text" name="what_you_get[]" class="form-control rounded-start-3" required placeholder="e.g., 12 Printed Workbooks" style="padding: 10px 14px; font-size: 0.9rem;">
                                <button type="button" class="btn btn-outline-danger remove-input-row"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-4 pt-3 border-top border-light text-end">
                    <button type="button" onclick="window.history.back();" class="btn btn-light px-4 py-2 border rounded-3 me-2 text-secondary" style="font-size: 0.9rem;">Cancel Pipeline</button>
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold rounded-3 shadow-sm" style="font-size: 0.9rem; background-color: #2563eb; border: none;">
                        <i class="bi bi-cloud-check-fill me-1"></i> Commit Relational Package
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const courseSelect = document.getElementById('course_id');
    const subCourseSelect = document.getElementById('sub_course_select');
    
    const modeExisting = document.getElementById('modeExisting');
    const modeNew = document.getElementById('modeNew');
    
    const existingCourseWrapper = document.getElementById('existing-course-wrapper');
    const existingSubWrapper = document.getElementById('existing-sub-wrapper');
    
    const newCourseWrapper = document.getElementById('new-course-wrapper');
    const newSubWrapper = document.getElementById('new-sub-wrapper');
    const newStatusWrapper = document.getElementById('new-status-wrapper');
    
    const courseInput = document.getElementById('course_name');
    const subCatInput = document.getElementById('sub_cat_name');
    const statusSelect = document.getElementById('status');

    // --- PIPELINE 1: DEPENDENT CASCADING DROPDOWN (FETCH API) ---
    courseSelect.addEventListener('change', function() {
        const courseId = this.value;
        
        subCourseSelect.innerHTML = '<option value="">-- Loading Mapped Sectors... --</option>';
        subCourseSelect.disabled = true;

        if (!courseId) {
            subCourseSelect.innerHTML = '<option value="">-- Choose Master Course First --</option>';
            return;
        }

        fetch(`/admin/get-sub-categories/${courseId}`)
            .then(response => {
                if (!response.ok) throw new Error('Network bridge context fault');
                return response.json();
            })
            .then(data => {
                subCourseSelect.innerHTML = '<option value="">-- Choose Target Sub-Category --</option>';
                if(data.length === 0) {
                    subCourseSelect.innerHTML = '<option value="">No subcategories configured for this profile</option>';
                    return;
                }
                
                data.forEach(subCat => {
                    const option = document.createElement('option');
                    option.value = subCat.id;
                    option.textContent = subCat.name;
                    subCourseSelect.appendChild(option);
                });
                subCourseSelect.disabled = false;
            })
            .catch(error => {
                console.error('Fetch error block:', error);
                subCourseSelect.innerHTML = '<option value="">Error processing subcategory arrays</option>';
            });
    });

    // --- PIPELINE 2: TOGGLE CONDITIONALS VIA RADIO ---
    function toggleCourseMode() {
        if (modeExisting.checked) {
            // Show Existing, Hide New
            existingCourseWrapper.classList.remove('d-none');
            existingSubWrapper.classList.remove('d-none');
            newCourseWrapper.classList.add('d-none');
            newSubWrapper.classList.add('d-none');
            newStatusWrapper.classList.add('d-none');
            
            // Attributes Validation Matrix Sync
            courseSelect.setAttribute('required', 'required');
            subCourseSelect.setAttribute('required', 'required');
            courseInput.removeAttribute('required');
            subCatInput.removeAttribute('required');
            statusSelect.removeAttribute('required');
        } else {
            // Hide Existing, Show New
            existingCourseWrapper.classList.add('d-none');
            existingSubWrapper.classList.add('d-none');
            newCourseWrapper.classList.remove('d-none');
            newSubWrapper.classList.remove('d-none');
            newStatusWrapper.classList.remove('d-none');
            
            // Attributes Validation Matrix Sync
            courseSelect.removeAttribute('required');
            subCourseSelect.removeAttribute('required');
            courseInput.setAttribute('required', 'required');
            subCatInput.setAttribute('required', 'required');
            statusSelect.setAttribute('required', 'required');
        }
    }

    modeExisting.addEventListener('change', toggleCourseMode);
    modeNew.addEventListener('change', toggleCourseMode);
    
    // Initial Run on load
    toggleCourseMode();

    // --- PIPELINE 3: DYNAMIC FIELDS REPEATER APPENDER ---
    document.querySelectorAll('.dynamic-append-trigger').forEach(function(button) {
        button.addEventListener('click', function() {
            const containerId = this.getAttribute('data-target');
            const container = document.getElementById(containerId);
            if (container) {
                const firstInput = container.querySelector('input');
                const arrayFieldName = firstInput.getAttribute('name');
                const placeholderString = firstInput.getAttribute('placeholder');
                
                const inputGroup = document.createElement('div');
                inputGroup.className = 'input-group mb-2';
                inputGroup.innerHTML = `
                    <input type="text" name="${arrayFieldName}" class="form-control rounded-start-3" required placeholder="${placeholderString}" style="padding: 10px 14px; font-size: 0.9rem;">
                    <button type="button" class="btn btn-outline-danger remove-input-row"><i class="bi bi-trash"></i></button>
                `;
                container.appendChild(inputGroup);
            }
        });
    });

    // Element delegation deletion
    document.body.addEventListener('click', function(event) {
        if (event.target.closest('.remove-input-row')) {
            const button = event.target.closest('.remove-input-row');
            const currentGroup = button.closest('.input-group');
            const parentClusterInstance = button.closest('.dynamic-inputs-cluster');
            if (parentClusterInstance.querySelectorAll('.input-group').length > 1) {
                currentGroup.remove();
            } else {
                alert('At least one operational element must remain bound.');
            }
        }
    });
});
</script>
@endsection