@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm w-100 mb-4" style="border-radius: 16px; background-color: #ffffff;">
        <div class="d-flex align-items-center justify-content-between my-4 px-4 pb-3 border-bottom">
           <a href="{{ url()->previous() }}" class="btn btn-sm btn-light border rounded-3 mb-2"><i class="bi bi-arrow-left me-1"></i> Back</a>
        </div>
        <div class="card-header bg-white px-4 py-3 border-bottom border-light d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white rounded-3 p-2 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                    <i class="bi bi-diagram-3-fill fs-5"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold text-dark" style="letter-spacing: -0.3px; font-size: 1.15rem;">Hierarchical Subject Mapping</h5>
                    <p class="text-muted mb-0 small" style="font-size: 0.8rem;">Select sub-categories to instantly provision block subjects matrix</p>
                </div>
            </div>
            <a href="{{ route('admin.subjects.index') }}" class="btn btn-light border btn-sm rounded-pill px-3 fw-medium text-secondary">View Subject Grid</a>
        </div>

        <div class="card-body p-4">
            @if(session('error'))
            <div class="alert alert-danger rounded-3 mb-4">{{ session('error') }}</div>
            @endif

            <form action="{{ route('admin.subjects.store') }}" method="POST">
                @csrf

                <!-- STEP 1: CASCADING DROPDOWNS -->
                <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">
                    <i class="bi bi-sliders me-1 text-primary"></i> 1. Select Category Scope Path
                </div>

                <div class="row g-3 mb-4 bg-light p-3 rounded-4 border border-light">
                    <!-- Master Course Select -->
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Step A: Choose Master Course kripa1</label>
                        <select name="course_id" id="course_select" class="form-select rounded-3" required style="padding: 11px 14px; font-size: 0.9rem;">
                            <option value="">-- Select Master Course --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dependent Sub Course/Category Select -->
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Step B: Target Sub-Category / Stream kripa2</label>
                        <select name="sub_course_id" id="sub_course_select" class="form-select rounded-3" required disabled style="padding: 11px 14px; font-size: 0.9rem;">
                            <option value="">-- Choose Master Course First --</option>
                        </select>
                    </div>
                </div>

                <!-- STEP 2: DYNAMIC SUBJECT DATA FIELDS -->
                <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">
                    <i class="bi bi-collection-fill me-1 text-success"></i> 2. Dynamic Batch Payload Input
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label small fw-semibold text-secondary m-0">Write Subject Names</label>
                            <button type="button" id="append-subject-row" class="btn btn-sm btn-outline-primary py-1 px-3" style="font-size: 0.8rem; border-radius: 6px;">
                                <i class="bi bi-plus-circle me-1"></i> Add Another Row
                            </button>
                        </div>

                        <div id="subjects-container-box">
                            <!-- Baseline Default Input Node -->
                            <div class="input-group mb-2 subject-input-row">
                                <span class="input-group-text bg-white text-muted border-end-0 rounded-start-3 px-3"><i class="bi bi-book"></i></span>
                                <input type="text" name="subjects[]" class="form-control border-start-0" required placeholder="e.g., Quantum Mechanics / Advanced Taxation / Jurisprudence" style="padding: 11px 14px; font-size: 0.9rem;">
                                <button type="button" class="btn btn-outline-danger remove-subject-row rounded-end-3 px-3"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3 pt-3 border-top border-light text-end">
                    <button type="button" onclick="window.history.back();" class="btn btn-light px-4 py-2 border rounded-3 me-2 text-secondary" style="font-size: 0.9rem;">Cancel</button>
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold rounded-3 shadow-sm" style="font-size: 0.9rem; background-color: #2563eb; border: none;">
                        <i class="bi bi-save-fill me-1"></i> Deploy Subjects Cluster
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
    const courseSelect = document.getElementById('course_select');
    const subCourseSelect = document.getElementById('sub_course_select');
    const appendBtn = document.getElementById('append-subject-row');
    const container = document.getElementById('subjects-container-box');

    // --- PIPELINE 1: DEPENDENT CASCADING DROPDOWN (FETCH API) ---
    courseSelect.addEventListener('change', function() {
        const courseId = this.value;
        
        // Reset Sub Course dropdown status
        subCourseSelect.innerHTML = '<option value="">-- Loading Mapped Sectors... --</option>';
        subCourseSelect.disabled = true;

        if (!courseId) {
            subCourseSelect.innerHTML = '<option value="">-- Choose Master Course First --</option>';
            return;
        }

        // Hit Laravel native endpoint dynamically
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
                
                // Populate payload options matrix
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

    // --- PIPELINE 2: VANILLA MULTI-ROW CONTROLLER ---
    appendBtn.addEventListener('click', function() {
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2 subject-input-row';
        inputGroup.innerHTML = `
            <span class="input-group-text bg-white text-muted border-end-0 rounded-start-3 px-3"><i class="bi bi-book"></i></span>
            <input type="text" name="subjects[]" class="form-control border-start-0" required placeholder="Enter Next Subject Title Name" style="padding: 11px 14px; font-size: 0.9rem;">
            <button type="button" class="btn btn-outline-danger remove-subject-row rounded-end-3 px-3"><i class="bi bi-trash"></i></button>
        `;
        container.appendChild(inputGroup);
    });

    container.addEventListener('click', function(event) {
        if (event.target.closest('.remove-subject-row')) {
            const allRows = container.querySelectorAll('.subject-input-row');
            if (allRows.length > 1) {
                event.target.closest('.subject-input-row').remove();
            } else {
                alert('UI System Guard: At least one baseline subject element input structural component must remain.');
            }
        }
    });
});
</script>
@endsection