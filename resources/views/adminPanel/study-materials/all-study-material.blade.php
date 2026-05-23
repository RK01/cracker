@extends('layouts.admin')

@section('content')
<!-- High-End Dashboard Component Overrides -->
<style>
    .admin-verification-wrapper {
        background-color: #f8fafc; /* Premium modern slate-white backdrop */
        min-height: 100vh;
    }
    .main-structural-card {
        border-radius: 20px; 
        background-color: #ffffff;
        box-shadow: 0 10px 25px -5px rgba(55, 48, 163, 0.03), 0 4px 12px -2px rgba(0, 0, 0, 0.01) !important;
        border: 1px solid #e2e8f0 !important;
    }
    /* Segmented Grid Row Design */
    .premium-card-row {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-bottom: 5px solid #d6dee6 !important;
    }
    .premium-card-row:hover {
        transform: translateY(-3px) scale(1.002);
        background-color: #ffffff !important;
        box-shadow: 0 12px 20px -8px rgba(79, 70, 229, 0.12), 0 4px 12px -2px rgba(0, 0, 0, 0.03) !important;
        border-color: #e0e7ff !important;
    }
    /* Smooth Indicator on Hover */
    .premium-card-row::after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 0;
        background-color: #4f46e5;
        transition: width 0.2s ease;
    }
    .premium-card-row:hover::after {
        width: 4px;
    }
    /* Compact Layout Mini Scrollbar */
    .log-scroll-node::-webkit-scrollbar {
        width: 4px;
    }
    .log-scroll-node::-webkit-scrollbar-track {
        background: #f8fafc;
    }
    .log-scroll-node::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 20px;
    }
    .log-scroll-node::-webkit-scrollbar-thumb:hover {
        background: #a1a1aa;
    }
</style>

<div class="container py-4 admin-verification-wrapper">
    <!-- Main Structural Wrapper Card -->
    <div class="card main-structural-card w-100 border-0">
        
        <!-- Header Controls Panel -->
        <div class="card-header bg-white px-4 py-4 border-bottom border-light" style="border-radius: 20px 20px 0 0;">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div class="d-flex align-items-center">
                    <div class="text-white rounded-3 p-2.5 d-flex align-items-center justify-content-center me-3 shadow" style="width: 48px; height: 48px; background: linear-gradient(135deg, #4f46e5, #3730a3); box-shadow: 0 4px 14px rgba(79, 70, 229, 0.25) !important;">
                        <i class="bi bi-layers-half fs-5"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-extrabold text-dark" style="letter-spacing: -0.5px; font-size: 1.35rem; color: #0f172a !important;">Active Asset Verification Desk</h5>
                        <p class="text-muted mb-0 small mt-0.5" style="font-size: 0.82rem; font-weight: 500;">Eager loaded structural metrics showcasing generators, targets, and student tracking logs</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Master Content Table Node -->
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="text-uppercase tracking-wider text-muted" style="font-size: 0.72rem; letter-spacing: 0.8px; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <tr>
                        <th class="px-4 py-3 text-secondary fw-bold" style="width: 34%;">Study Material & Genesis Specs</th>
                        <th class="py-3 text-secondary fw-bold" style="width: 26%;">Relational Hierarchy Path</th>
                        <th class="py-3 text-secondary fw-bold pe-4" style="width: 40%;">Transmission logs (Who Downloaded & When)</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.9rem;" class="text-dark">
                    @forelse($activeMaterials as $material)
                    <tr class="align-top position-relative premium-card-row">
                        
                        <!-- COLUMN 1: Material Details, Generator (Posted By) & Datetime -->
                        <td class="px-4 py-4">
                            <div class="d-flex flex-column gap-3">
                                <div>
                                    <span class="badge text-indigo border rounded-pill py-1 px-2.5 mb-2 fw-bold" style="font-size: 0.65rem; background-color: #f0fdf4; color: #16a34a !important; border-color: #bbf7d0 !important; {{ $material->type != 'assignment' ? 'background-color: #eff6ff; color: #2563eb !important; border-color: #bfdbfe !important;' : '' }}">
                                        {{ strtoupper($material->type) }}
                                    </span>
                                    <h6 class="fw-bold text-dark mb-1.5" style="font-size: 0.96rem; line-height: 1.4; color: #0f172a !important; letter-spacing: -0.2px;">{{ ucwords($material->title) }}</h6>
                                    @if($material->description)
                                        <p class="text-muted mb-0 small text-truncate" style="max-width: 320px; font-size: 0.78rem; font-weight: 400;">{{ $material->description }}</p>
                                    @endif
                                </div>
                                
                                <!-- Meta Block: Generator Details -->
                                <div class="p-2.5 rounded-3 border bg-light shadow-xs d-flex flex-column gap-1" style="font-size: 0.78rem; border-color: #f1f5f9 !important; background-color: #f8fafc !important;">
                                    <div class="text-secondary d-flex align-items-center gap-1.5">
                                        <i class="bi bi-person-circle text-indigo" style="font-size: 0.85rem;"></i>
                                        <span class="text-muted mx-2">Author:</span> 
                                        <span class="fw-bold text-dark">{{ ucwords($material->uploader->name ?? 'System Admin (#'.$material->posted_by.')') }}</span>
                                    </div>
                                    <div class="text-muted d-flex align-items-center gap-1.5" style="font-size: 0.74rem;">
                                        <i class="bi bi-calendar-event text-secondary"></i>
                                        <span class="fw-medium">&nbsp;&nbsp;&nbsp;{{ \Carbon\Carbon::parse($material->created_at)->format('d M, Y • h:i A') }}</span>
                                    </div>
                                </div>

                                <!-- Payload Attributes Badge row -->
                                <div class="d-flex align-items-center gap-3 text-muted fw-bold font-monospace" style="font-size: 0.72rem; letter-spacing: -0.1px;">
                                    <span class="d-inline-flex align-items-center gap-1"><i class="bi bi-hdd-network text-secondary fs-6"></i>{{ $material->file_size ?? 'N/A' }}</span>
                                    <span class="text-slate-300">•</span>
                                    <span class="d-inline-flex align-items-center gap-1"><i class="bi bi-file-earmark-text text-secondary fs-6"></i>Pages: {{ $material->page_count ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </td>

                        <!-- COLUMN 2: Course & Sub Category Mappings -->
                        <td class="py-4">
                            <div class="d-flex flex-column gap-2.5" style="font-size: 0.84rem;">
                                <div class="fw-bold text-dark d-inline-flex align-items-center gap-2">
                                    <div class="p-1 rounded bg-warning-subtle d-flex align-items-center justify-content-center" style="background-color: #fffbeb; border: 1px solid #fef3c7;">
                                        <i class="bi bi-folder2-open text-warning fs-6"></i>
                                    </div>
                                    <span style="color: #1e293b; font-size: 0.88rem;">{{ $material->course->name ?? $material->course_id }}</span>
                                </div>
                                <div class="text-muted small d-inline-flex align-items-center gap-1.5 fw-medium ps-1">
                                    <i class="bi bi-arrow-return-right text-slate-400"></i>
                                    <span>Sub-Scope: <span class="text-dark fw-bold">{{ $material->subCategory->name ?? $material->sub_cat_course_id }}</span></span>
                                </div>
                                <div class="mt-1 ps-1">
                                    <span class="badge bg-white text-secondary border px-2.5 py-1 rounded-2 shadow-xs fw-bold font-monospace" style="font-size: 0.68rem; border-color: #cbd5e1 !important; color: #64748b !important;">SUBJECT NAME: {{ getSubjectNameById($material->subject_id) }}</span>
                                </div>
                            </div>
                        </td>

                        <!-- COLUMN 3: Active Download Logs Sub-Loop Matrix -->
                        <td class="py-4 pe-4">
                            @if($material->downloadLogs && $material->downloadLogs->count() > 0)
                                <div class="d-flex flex-column gap-2 log-scroll-node" style="max-height: 200px; overflow-y: auto; padding-right: 6px;">
                                    @foreach($material->downloadLogs as $log)
                                        <div class="d-flex align-items-center justify-content-between p-2.5 rounded-3 bg-white shadow-xs" style="font-size: 0.8rem; border: 1px solid #e2e8f0; border-left: 3px solid #4f46e5 !important; box-shadow: 0 2px 4px rgba(0,0,0,0.01);">
                                            
                                            <!-- Student Card Instance -->
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center text-indigo fw-extrabold" style="width: 34px; height: 34px; font-size: 0.72rem; border: 1px solid #e2e8f0; background-color: #f1f5f9 !important; color: #4f46e5 !important;">
                                                    {{ strtoupper(substr($log->user->name ?? 'S', 0, 2)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark" style="font-size: 0.84rem; color: #1e293b !important;">{{ $log->user->name ?? 'Identity Deleted' }}</div>
                                                    <div class="text-muted" style="font-size: 0.72rem; font-weight: 500;">{{ $log->user->email ?? 'N/A' }}</div>
                                                </div>
                                            </div>

                                            <!-- Timestamp Execution Payload -->
                                            <div class="text-end" style="font-size: 0.74rem;">
                                                <div class="fw-bold text-dark d-inline-flex align-items-center gap-1"><i class="bi bi-calendar-check text-slate-400" style="font-size: 0.72rem;"></i>{{ $log->downloaded_at ? $log->downloaded_at->format('d M, Y') : 'N/A' }}</div>
                                                <div class="text-muted small mt-0.5 font-monospace" style="font-size: 0.68rem;"><i class="bi bi-clock me-0.5"></i>{{ $log->downloaded_at ? $log->downloaded_at->format('h:i A') : '' }}</div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                                <div class="text-muted mt-2.5 text-end fw-bold" style="font-size: 0.72rem;">
                                    Total Operational Traces: <span class="badge rounded-2 fw-bolder font-monospace shadow-xs" style="color: #4f46e5; background-color: #e0e7ff; border: 1px solid #c7d2fe; padding: 4px 8px;">{{ $material->downloadLogs->count() }} downloads</span>
                                </div>
                            @else
                                <!-- Clean UI State when no user has triggered download routine yet -->
                                <div class="text-center py-4 rounded-3 bg-light text-muted d-flex flex-column align-items-center justify-content-center" style="border: 1px dashed #cbd5e1 !important; font-size: 0.8rem; background-color: #f8fafc !important;">
                                    <i class="bi bi-cloud-slash text-indigo fs-3 mb-1.5" style="color: #818cf8 !important;"></i>
                                    <span class="fw-bold text-dark" style="font-size: 0.84rem; color: #334155 !important;">Zero Transmission Footprints</span>
                                    <p class="mb-0 text-muted px-3 text-center mt-0.5" style="font-size: 0.74rem; max-width: 300px;">This active entity has not been instantiated or downloaded by any system user yet.</p>
                                </div>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-5 bg-white">
                            <div class="text-muted mb-2"><i class="bi bi-folder-x text-indigo" style="font-size: 3rem; color: #cbd5e1;"></i></div>
                            <h5 class="fw-bold text-dark mb-1" style="letter-spacing: -0.2px;">No Active Study Materials Found</h5>
                            <p class="text-muted small mb-0 fw-medium">Database tree structure doesn't contain any active node parameters.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Controls Footer Block -->
        @if($activeMaterials->hasPages())
        <div class="card-footer bg-white border-top border-light px-4 py-3.5 d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3" style="border-radius: 0 0 20px 20px;">
            <div class="text-muted small fw-bold" style="font-size: 0.8rem;">
                Showing <span class="text-dark">{{ $activeMaterials->firstItem() }}</span> to <span class="text-dark">{{ $activeMaterials->lastItem() }}</span> of <span class="text-indigo fw-extrabold px-1" style="color: #4f46e5;">{{ $activeMaterials->total() }}</span> recorded study items
            </div>
            <div>
                {{ $activeMaterials->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif

    </div>
</div>
@endsection