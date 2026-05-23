@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="dashboard-card p-4 shadow-sm w-100">
        
        <!-- TOP STREAM CONTROL FILTERS (Matched with Student List Framework) -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-3 border-bottom border-light">
            <div>
                <h5 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Course Structure Details Panel</h5>
                <p class="text-muted mb-0 small">Manage deep details, syllabus configurations, and price matrix rulesets</p>
            </div>
            
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.course-details.create') }}" class="btn btn-primary px-4 py-2 rounded-3 fw-medium d-inline-flex align-items-center gap-2" style="font-size: 0.88rem; background-color: #2563eb; border: none;">
                    <i class="bi bi-plus-lg"></i> Add Course Detail
                </a>
            </div>
        </div>

        <!-- Feedback Notification Engine -->
        @if(session('success'))
            <div class="alert alert-success border-0 mx-0 mb-4 rounded-3 small shadow-sm">{{ session('success') }}</div>
        @endif

        <!-- TRENDING HIGH-FIDELITY TABLE CONTAINER -->
        <div class="table-responsive" id="table-data-wrapper">
            <table id="custom-course-table" class="table custom-table-modern align-middle mb-0">
                <thead>
                    <tr>
                        <th class="py-3 px-3">Parent Structure Path</th>
                        <th class="py-3">Display Title</th>
                        <th class="py-3">Duration Space</th>
                        <th class="py-3">Batch Strategy</th>
                        <th class="py-3">Commercial Price</th>
                        <th class="text-center" style="width: 140px;">Action Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($details as $detail)
                    <tr class="student-row">
                        <!-- Path Badge Column -->
                        <td class="px-3">
                            <span class="badge bg-light text-dark border px-2.5 py-1.5 rounded-2 fw-medium" style="font-size: 0.8rem; border-color: rgba(226, 232, 240, 0.8) !important;">
                                <i class="bi bi-folder2-open text-primary me-1"></i>
                                <span class="fw-semibold">{{ $detail->CourseSubCategory->course->name ?? 'N/A' }}</span>
                                <i class="bi bi-chevron-right mx-1 opacity-50" style="font-size: 0.65rem;"></i>
                                <span class="text-secondary">{{ $detail->CourseSubCategory->name ?? 'N/A' }}</span>
                            </span>
                        </td>
                        
                        <!-- Title Field Component -->
                        <td>
                            <h6 class="mb-0 fw-semibold text-slate-800" style="font-size: 0.93rem;">{{ $detail->title }}</h6>
                        </td>
                        
                        <!-- Duration Specification Field -->
                        <td>
                            <div class="d-flex align-items-center gap-1.5 text-secondary fw-medium" style="font-size: 0.88rem;">
                                <i class="bi bi-clock text-muted"></i>
                                <span>{{ $detail->duration }}</span>
                            </div>
                        </td>
                        
                        <!-- Batch Metric Component -->
                        <td>
                            <span class="badge bg-light text-success border border-success-subtle rounded-pill px-3 py-2 fw-medium" style="font-size: 0.78rem;">
                                <i class="bi bi-grid-1x2 me-1"></i> {{ $detail->batch_size }}
                            </span>
                        </td>
                        
                        <!-- Price Mapping Column -->
                        <td>
                            <span class="fw-bold text-success" style="font-size: 0.95rem;">₹{{ $detail->price }}</span>
                        </td>
                        
                        <!-- Action Trigger Elements -->
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <a href="{{ route('admin.course-details.edit', $detail->id) }}" class="action-icon-btn edit-btn d-flex align-items-center justify-content-center text-decoration-none" title="Modify Layout">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </a>
                                <form action="{{ route('admin.course-details.destroy', $detail->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to completely erase this matrix specification record?');" class="d-inline m-0">
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
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-folder-x fs-1 text-light d-block mb-2"></i>
                            No dynamic course profile layouts instantiated. Click add button to start.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Bootstrap Appended Pagination Links Engine -->
            <div class="d-flex justify-content-between align-items-center mt-4 px-2">
                <div class="text-muted small fw-medium">
                    Showing {{ $details->firstItem() ?? 0 }} to {{ $details->lastItem() ?? 0 }} of {{ $details->total() }} entries
                </div>
                <div class="pagination-wrapper modern-render">
                    {{ $details->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection