@extends('layouts.admin')

@section('content')
<!-- Custom Styles to Inject High-Fidelity Table Layout Parameters -->

<div class="container py-4">
    <!-- Top Stats Counter Cards (Clean Organic Layout) -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="dashboard-card p-3 shadow-sm shadow-xs">
                <div class="d-flex align-items-center">
                    <div class="text-white rounded-3 p-3 me-3 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                        <i class="bi bi-cloud-arrow-down fs-5"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small fw-semibold text-uppercase tracking-wider" style="font-size: 0.7rem;">Total Downloads</h6>
                        <h4 class="mb-0 fw-bold text-dark mt-1" style="font-size: 1.3rem;">{{ $logs->total() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card p-3 shadow-sm shadow-xs">
                <div class="d-flex align-items-center">
                    <div class="text-white rounded-3 p-3 me-3 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; background: linear-gradient(135deg, #10b981, #059669);">
                        <i class="bi bi-file-earmark-pdf fs-5"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small fw-semibold text-uppercase tracking-wider" style="font-size: 0.7rem;">Active Materials</h6>
                        <h4 class="mb-0 fw-bold text-dark mt-1" style="font-size: 1.3rem;">{{ $activeMaterialsCount ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card p-3 shadow-sm shadow-xs">
                <div class="d-flex align-items-center">
                    <div class="text-white rounded-3 p-3 me-3 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; background: linear-gradient(135deg, #06b6d4, #0891b2);">
                        <i class="bi bi-clock-history fs-5"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small fw-semibold text-uppercase tracking-wider" style="font-size: 0.7rem;">Downloads Today</h6>
                        <h4 class="mb-0 fw-bold text-dark mt-1" style="font-size: 1.3rem;">{{ $todayDownloadsCount ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Container Card -->
    <div class="dashboard-card p-4 shadow-sm w-100">
        
        <!-- TOP STREAM CONTROL FILTERS (Matched with Course Details Panel) -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-3 border-bottom border-light">
            <div>
                <h5 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Material Transmission Matrix</h5>
                <p class="text-muted mb-0 small">Tracks live download metrics, scopes, and user structural queries</p>
            </div>
            
            <div class="d-flex flex-wrap gap-2">
                <form action="{{ url()->current() }}" method="GET" class="d-flex gap-2">
                    <div class="input-group" style="max-width: 300px;">
                        <span class="input-group-text bg-light border-end-0 text-muted rounded-start-3" style="border-color: #e2e8f0;"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control bg-light border-start-0 rounded-end-3" placeholder="Search user, document..." style="padding: 8px 12px; font-size: 0.85rem; border-color: #e2e8f0;">
                    </div>
                    @if(request('search'))
                        <a href="{{ url()->current() }}" class="btn btn-light border rounded-3 d-flex align-items-center"><i class="bi bi-x-lg"></i></a>
                    @endif
                </form>
            </div>
        </div>

        <!-- TRENDING HIGH-FIDELITY TABLE CONTAINER -->
        <div class="table-responsive" id="table-data-wrapper">
            <table id="custom-course-table" class="table custom-table-modern align-middle mb-0">
                <thead>
                    <tr>
                        <th class="py-3 px-3" style="width: 10%;">Log ID</th>
                        <th class="py-3" style="width: 22%;">User/Student Identity</th>
                        <th class="py-3" style="width: 25%;">Target Material Specs</th>
                        <th class="py-3" style="width: 23%;">Relational Tree Layer</th>
                        <th class="py-3" style="width: 10%;">Payload</th>
                        <th class="py-3" style="width: 10%;">Timestamp</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr class="student-row">
                        <!-- Log ID Identifier Block -->
                        <td class="px-3">
                            <span class="font-monospace text-secondary fw-semibold" style="font-size: 0.8rem;">
                                #DL-{{ str_pad($log->id, 5, '0', STR_PAD_LEFT) }}
                            </span>
                        </td>
                        
                        <!-- User Identity Block -->
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 32px; height: 32px; font-size: 0.8rem; border: 1px solid #e2e8f0; flex-shrink: 0;">
                                    {{ strtoupper(substr($log->user->name ?? 'U', 0, 2)) }}
                                </div>
                                <div class="text-truncate" style="max-width: 180px;">
                                    <h6 class="mb-0 fw-semibold text-slate-800" style="font-size: 0.9rem;">{{ ucwords($log->user->name) ?? 'Identity Missing' }}</h6>
                                    <span class="text-muted small d-block text-truncate" style="font-size: 0.75rem;">{{ $log->user->email ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Material Field Title -->
                        <td>
                            <div>
                                <h6 class="mb-0 fw-semibold text-slate-800 text-truncate" style="font-size: 0.9rem; max-width: 240px;" title="{{ ucwords($log->material->title) ?? '' }}">
                                    {{ $log->material->title ?? 'Material Dropped' }}
                                </h6>
                                <div class="d-flex align-items-center gap-2 mt-1" style="font-size: 0.74rem;">
                                    <span class="badge bg-light text-primary border rounded-2 px-1.5 py-0.5 fw-bold" style="font-size: 0.65rem; border-color: rgba(37, 99, 235, 0.15) !important;">
                                        {{ strtoupper($log->material->type ?? 'PDF') }}
                                    </span>
                                    <span class="text-muted"><i class="bi bi-file-earmark-text me-0.5"></i>Pgs: {{ $log->material->page_count ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Path Badge Hierarchy Column (Matched exactly with Path style) -->
                        <td>
                            <span class="badge bg-light text-dark border px-2.5 py-1.5 rounded-2 fw-medium d-inline-flex align-items-center" style="font-size: 0.78rem; border-color: rgba(226, 232, 240, 0.8) !important;">
                                <i class="bi bi-folder2-open text-primary me-1"></i>
                                <span class="fw-semibold text-dark">{{ getCourseNameById($log->material->course_id) ?? 'Unknown' }}</span>
                                <i class="bi bi-chevron-right mx-1 opacity-50" style="font-size: 0.6rem;"></i>
                                <span class="text-secondary">{{ getSubCatCourseNameById($log->material->sub_cat_course_id) ?? 'Root' }}</span>
                            </span>
                            <div class="d-flex align-items-center gap-2 mt-1" style="font-size: 0.74rem;">
                                <span class="badge bg-light text-primary border rounded-2 px-1.5 py-0.5 fw-bold" style="font-size: 0.65rem; border-color: rgba(37, 99, 235, 0.15) !important;">
                                    {{ strtoupper(getSubjectNameById($log->material->subject_id) ?? 'PDF') }}
                                </span>
                            </div>
                        </td>
                        
                        <!-- Payload Size Metric -->
                        <td>
                            <div class="text-secondary fw-medium font-monospace" style="font-size: 0.82rem;">
                                <i class="bi bi-hdd me-1 text-muted"></i>{{ $log->material->file_size ?? '0 KB' }}
                            </div>
                        </td>
                        
                        <!-- Timestamp Block -->
                        <td>
                            <div style="font-size: 0.82rem; line-height: 1.3;">
                                <div class="fw-medium text-dark">{{ $log->downloaded_at ? $log->downloaded_at->format('d M, Y') : 'N/A' }}</div>
                                <span class="text-muted small" style="font-size: 0.72rem;">{{ $log->downloaded_at ? $log->downloaded_at->format('h:i A') : '' }}</span>
                            </div>
                        </td>
                        
                        <!-- Action Trigger Interface -->
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center">
                                @if(!empty($log->material->file_path))
                                    <a href="{{ asset('storage/'.$log->material->file_path) }}" target="_blank" class="action-icon-btn inspect-btn" title="Inspect Source File">
                                        <i class="bi bi-eye fs-5"></i>
                                    </a>
                                @else
                                    <button type="button" class="action-icon-btn broken-btn" title="Path Entity Missing" disabled>
                                        <i class="bi bi-eye-slash fs-5"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-server fs-1 text-light d-block mb-2"></i>
                            No operational download traces instantiated. Modify active filters.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Appended Pagination Engine Link Layout -->
            <div class="d-flex justify-content-between align-items-center mt-4 px-2">
                <div class="text-muted small fw-medium">
                    Showing {{ $logs->firstItem() ?? 0 }} to {{ $logs->lastItem() ?? 0 }} of {{ $logs->total() }} entries
                </div>
                <div class="pagination-wrapper modern-render">
                    {{ $logs->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .dashboard-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid rgba(226, 232, 240, 0.8);
    }
    .custom-table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .custom-table-modern thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.72rem;
        letter-spacing: 0.6px;
        padding: 12px 16px;
        border-bottom: 1px solid #e2e8f0 !important;
        border-top: none !important;
    }
    .custom-table-modern tbody tr {
        transition: background-color 0.2s ease;
    }
    .custom-table-modern tbody tr:hover {
        background-color: #f8fafc !important;
    }
    .custom-table-modern tbody td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
    }
    /* Action Button Custom Styling */
    .action-icon-btn {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
    }
    .inspect-btn {
        color: #2563eb;
    }
    .inspect-btn:hover {
        background-color: #eff6ff;
        border-color: #bfdbfe;
        color: #1d4ed8;
    }
    .broken-btn {
        color: #94a3b8;
        background-color: #f1f5f9;
        border-color: #e2e8f0;
    }
</style>

@endsection