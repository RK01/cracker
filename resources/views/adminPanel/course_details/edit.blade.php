@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <!-- Premium Card Container Design Matrix -->
    <div class="card border-0 shadow-sm w-100 mb-4" style="border-radius: 16px; overflow: hidden; background-color: #ffffff;">
        <!-- Modern Header Element Segment -->
        <div class="d-flex align-items-center justify-content-between my-4 px-4 pb-3 border-bottom">
           <a href="{{ url()->previous() }}" class="btn btn-sm btn-light border rounded-3 mb-2"><i class="bi bi-arrow-left me-1"></i> Back</a>
       </div>
        <div class="card-header bg-white px-4 py-3 border-bottom border-light d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white rounded-3 p-2 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                    <i class="bi bi-pencil-square fs-5"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold text-dark" style="letter-spacing: -0.3px; font-size: 1.15rem;">Modify Course Specification Matrix</h5>
                    <p class="text-muted mb-0 small" style="font-size: 0.8rem;">Update configuration properties, JSON array details and structural profiles allocations</p>
                </div>
            </div>
            <span class="badge bg-light text-warning border rounded-pill px-3 py-2 fw-medium small text-dark">Structure: Mutating ID #{{ $courseDetail->id }}</span>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('admin.course-details.update', $courseDetail->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Section 1: Core Definitions -->
                <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">
                    <i class="bi bi-shield-lock-fill me-1 text-primary"></i> Core Package Identities
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Target Sub Category Package</label>
                        <select name="course_sub_category_id" class="form-select rounded-3 @error('course_sub_category_id') is-invalid @enderror" required style="padding: 11px 14px; font-size: 0.9rem; cursor: pointer;">
                            @foreach($subCategories as $sub)
                            <option value="{{ $sub->id }}" {{ (old('course_sub_category_id', $courseDetail->course_sub_category_id) == $sub->id) ? 'selected' : '' }}>
                                {{ $sub->course->name ?? 'N/A' }} — [{{ $sub->name }}]
                            </option>
                            @endforeach
                        </select>
                        @error('course_sub_category_id') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Display Custom Title</label>
                        <input type="text" name="title" value="{{ old('title', $courseDetail->title) }}" class="form-control rounded-3 @error('title') is-invalid @enderror" required style="padding: 11px 14px; font-size: 0.9rem;">
                        @error('title') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-semibold text-secondary">Deep Marketing / Structure Description</label>
                        <textarea name="description" rows="3" class="form-control rounded-3 @error('description') is-invalid @enderror" required style="font-size: 0.9rem; padding: 11px 14px;">{{ old('description', $courseDetail->description) }}</textarea>
                        @error('description') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <hr class="text-light my-4">

                <!-- Section 2: Metrics & Core Specifications -->
                <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">
                    <i class="bi bi-sliders me-1 text-success"></i> Specifications & Commercial Metrics
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">Duration Layout</label>
                        <input type="text" name="duration" value="{{ old('duration', $courseDetail->duration) }}" class="form-control rounded-3 @error('duration') is-invalid @enderror" required style="padding: 11px 14px; font-size: 0.9rem;">
                        @error('duration') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">Batch Size Metric</label>
                        <input type="text" name="batch_size" value="{{ old('batch_size', $courseDetail->batch_size) }}" class="form-control rounded-3 @error('batch_size') is-invalid @enderror" required style="padding: 11px 14px; font-size: 0.9rem;">
                        @error('batch_size') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">Price Schema Engine</label>
                        <input type="text" name="price" value="{{ old('price', $courseDetail->price) }}" class="form-control rounded-3 @error('price') is-invalid @enderror" required style="padding: 11px 14px; font-size: 0.9rem;">
                        @error('price') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">Display Vector Media Graphics (Optional)</label>
                        <input type="file" name="image" class="form-control rounded-3 @error('image') is-invalid @enderror" style="padding: 11px 14px; font-size: 0.9rem;">
                        @if($courseDetail->image)
                        <div class="mt-2 px-2 py-1 bg-light rounded border d-flex align-items-center justify-content-between" style="font-size: 0.78rem;">
                            <span class="text-truncate text-secondary me-2"><i class="bi bi-image me-1"></i> {{ $courseDetail->image }}</span>
                            <a href="{{ asset('uploads/courses/'.$courseDetail->image) }}" target="_blank" class="text-primary text-decoration-none fw-medium flex-shrink-0">View Asset <i class="bi bi-box-arrow-up-right small"></i></a>
                        </div>
                        @endif
                        @error('image') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <hr class="text-light my-4">

                <!-- Section 3: Advanced Architecture Data Arrays -->
                <div class="text-uppercase text-muted fw-bold small mb-3 tracking-wider" style="font-size: 0.72rem; letter-spacing: 1px;">
                    <i class="bi bi-tags-fill me-1 text-warning"></i> Advanced Architecture Array Configurations
                </div>

                <div class="row">
                    <!-- Includes Section Component -->
                    <div class="col-md-6 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label small fw-semibold text-secondary m-0">What Package Includes</label>
                            <button type="button" class="btn btn-sm btn-outline-primary py-1 dynamic-append-trigger" data-target="includes-box" style="font-size: 0.8rem; border-radius: 6px;"><i class="bi bi-plus-circle"></i> Append</button>
                        </div>
                        <div id="includes-box" class="dynamic-inputs-cluster">
                            @forelse((array)$courseDetail->includes as $item)
                            <div class="input-group mb-2">
                                <input type="text" name="includes[]" value="{{ $item }}" class="form-control rounded-start-3" required style="padding: 10px 14px; font-size: 0.9rem;">
                                <button type="button" class="btn btn-outline-danger remove-input-row"><i class="bi bi-trash"></i></button>
                            </div>
                            @empty
                            <div class="input-group mb-2">
                                <input type="text" name="includes[]" class="form-control rounded-start-3" required placeholder="e.g., Live + Recorded Classes" style="padding: 10px 14px; font-size: 0.9rem;">
                                <button type="button" class="btn btn-outline-danger remove-input-row"><i class="bi bi-trash"></i></button>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Highlights Section Component -->
                    <div class="col-md-6 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label small fw-semibold text-secondary m-0">Highlights Matrix</label>
                            <button type="button" class="btn btn-sm btn-outline-primary py-1 dynamic-append-trigger" data-target="highlights-box" style="font-size: 0.8rem; border-radius: 6px;"><i class="bi bi-plus-circle"></i> Append</button>
                        </div>
                        <div id="highlights-box" class="dynamic-inputs-cluster">
                            @forelse((array)$courseDetail->highlights as $item)
                            <div class="input-group mb-2">
                                <input type="text" name="highlights[]" value="{{ $item }}" class="form-control rounded-start-3" required style="padding: 10px 14px; font-size: 0.9rem;">
                                <button type="button" class="btn btn-outline-danger remove-input-row"><i class="bi bi-trash"></i></button>
                            </div>
                            @empty
                            <div class="input-group mb-2">
                                <input type="text" name="highlights[]" class="form-control rounded-start-3" required placeholder="e.g., 500+ hours classroom teaching" style="padding: 10px 14px; font-size: 0.9rem;">
                                <button type="button" class="btn btn-outline-danger remove-input-row"><i class="bi bi-trash"></i></button>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Syllabus Section Component -->
                    <div class="col-md-6 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label small fw-semibold text-secondary m-0">Syllabus Overview Blocks</label>
                            <button type="button" class="btn btn-sm btn-outline-primary py-1 dynamic-append-trigger" data-target="syllabus-box" style="font-size: 0.8rem; border-radius: 6px;"><i class="bi bi-plus-circle"></i> Append</button>
                        </div>
                        <div id="syllabus-box" class="dynamic-inputs-cluster">
                            @forelse((array)$courseDetail->syllabus as $item)
                            <div class="input-group mb-2">
                                <input type="text" name="syllabus[]" value="{{ $item }}" class="form-control rounded-start-3" required style="padding: 10px 14px; font-size: 0.9rem;">
                                <button type="button" class="btn btn-outline-danger remove-input-row"><i class="bi bi-trash"></i></button>
                            </div>
                            @empty
                            <div class="input-group mb-2">
                                <input type="text" name="syllabus[]" class="form-control rounded-start-3" required placeholder="e.g., Physics: Mechanics" style="padding: 10px 14px; font-size: 0.9rem;">
                                <button type="button" class="btn btn-outline-danger remove-input-row"><i class="bi bi-trash"></i></button>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- What You Get Section Component -->
                    <div class="col-md-6 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label small fw-semibold text-secondary m-0">What You Get Output</label>
                            <button type="button" class="btn btn-sm btn-outline-primary py-1 dynamic-append-trigger" data-target="get-box" style="font-size: 0.8rem; border-radius: 6px;"><i class="bi bi-plus-circle"></i> Append</button>
                        </div>
                        <div id="get-box" class="dynamic-inputs-cluster">
                            @forelse((array)$courseDetail->what_you_get as $item)
                            <div class="input-group mb-2">
                                <input type="text" name="what_you_get[]" value="{{ $item }}" class="form-control rounded-start-3" required style="padding: 10px 14px; font-size: 0.9rem;">
                                <button type="button" class="btn btn-outline-danger remove-input-row"><i class="bi bi-trash"></i></button>
                            </div>
                            @empty
                            <div class="input-group mb-2">
                                <input type="text" name="what_you_get[]" class="form-control rounded-start-3" required placeholder="e.g., Printed Study Material Kit" style="padding: 10px 14px; font-size: 0.9rem;">
                                <button type="button" class="btn btn-outline-danger remove-input-row"><i class="bi bi-trash"></i></button>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Final Deployment Submission Actions -->
                <div class="col-12 mt-4 pt-3 border-top border-light text-end">
                    <button type="button" onclick="window.history.back();" class="btn btn-light px-4 py-2 border rounded-3 me-2 text-secondary" style="font-size: 0.9rem; border: 1px solid #e2e8f0;">Cancel Mutation</button>
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold rounded-3 shadow-sm" style="font-size: 0.9rem; background-color: #2563eb; border: none;">
                        <i class="bi bi-cloud-arrow-up-fill me-1"></i> Update Specified Matrix
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
    
    // Vanilla JS runtime handler for appending array blocks
    document.querySelectorAll('.dynamic-append-trigger').forEach(function(button) {
        button.addEventListener('click', function() {
            const containerId = this.getAttribute('data-target');
            const container = document.getElementById(containerId);
            
            if (container) {
                const firstInput = container.querySelector('input');
                const arrayFieldName = firstInput.getAttribute('name');
                const placeholderAttr = firstInput.getAttribute('placeholder') || '';
                
                // Constructing node layout cleanly without framework handlers
                const inputGroup = document.createElement('div');
                inputGroup.className = 'input-group mb-2';
                
                inputGroup.innerHTML = `
                    <input type="text" name="${arrayFieldName}" class="form-control rounded-start-3" required placeholder="${placeholderAttr}" style="padding: 10px 14px; font-size: 0.9rem;">
                    <button type="button" class="btn btn-outline-danger remove-input-row"><i class="bi bi-trash"></i></button>
                `;
                
                container.appendChild(inputGroup);
            }
        });
    });

    // Event Delegation engine to catch interactive inputs removals
    document.body.addEventListener('click', function(event) {
        if (event.target.closest('.remove-input-row')) {
            const button = event.target.closest('.remove-input-row');
            const currentGroup = button.closest('.input-group');
            const parentClusterInstance = button.closest('.dynamic-inputs-cluster');
            
            if (parentClusterInstance.querySelectorAll('.input-group').length > 1) {
                currentGroup.remove();
            } else {
                alert('At least one operational item must remain bound to database constraints.');
            }
        }
    });
});
</script>
@endsection