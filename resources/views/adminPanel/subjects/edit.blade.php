@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between my-4 px-4 pb-3 border-bottom">
           <a href="{{ url()->previous() }}" class="btn btn-sm btn-light border rounded-3 mb-2"><i class="bi bi-arrow-left me-1"></i> Back</a>
        </div>
    <div class="card border-0 shadow-sm w-50 mx-auto" style="border-radius: 16px; background-color: #ffffff;">
        <div class="card-header bg-white px-4 py-3 border-bottom border-light">
            <h5 class="mb-0 fw-bold text-dark">Modify Mapped Subject Node</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Master Course Selector -->
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Master Course Scope</label>
                    <input type="hidden" id="edit_course_select" name="course_id" value="{{$subject->course_id}}">
                    <select class="form-select rounded-3" required disabled>
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}" {{ $subject->course_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sub Course Selector -->
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Target Sub-Category Mapping</label>
                    <input type="hidden" id="edit_sub_course_select" name="sub_course_id" value="{{$subject->sub_course_id}}">
                    <select class="form-select rounded-3" required disabled>
                        @foreach($subCategories as $sub)
                            <option value="{{ $sub->id }}" {{ $subject->sub_course_id == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Subject Title -->
                <div class="mb-4">
                    <label class="form-label small fw-semibold text-secondary">Subject Title String Name</label>
                    <input type="text" name="name" value="{{ $subject->name }}" class="form-control rounded-3" required style="padding: 11px 14px;">
                </div>

                <div class="text-end">
                    <button type="button" onclick="window.history.back();" class="btn btn-light border rounded-3 px-3 me-2">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: #2563eb; border: none;">Apply Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const courseSelect = document.getElementById('edit_course_select');
    const subCourseSelect = document.getElementById('edit_sub_course_select');

    // Dynamic listener also in Edit phase in case admin shifts tracks
    courseSelect.addEventListener('change', function() {
        const courseId = this.value;
        subCourseSelect.innerHTML = '<option value="">-- Loading Mapped Sectors... --</option>';
        
        if (!courseId) return;

        fetch(`/admin/get-sub-categories/${courseId}`)
            .then(response => response.json())
            .then(data => {
                subCourseSelect.innerHTML = '<option value="">-- Choose Target Sub-Category --</option>';
                data.forEach(subCat => {
                    const option = document.createElement('option');
                    option.value = subCat.id;
                    option.textContent = subCat.name;
                    subCourseSelect.appendChild(option);
                });
            });
    });
});
</script>
@endsection