@extends('layouts.admin')

@section('content')
<style>
    .dashboard-card { background: #ffffff; border-radius: 12px; border: 1px solid rgba(226, 232, 240, 0.8); }
    .curriculum-tree-accordion .accordion-item { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .curriculum-tree-accordion .accordion-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05) !important;
    }
    .test-matrix-chip { background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; transition: all 0.2s ease; }
    .test-matrix-chip:hover { border-color: #cbd5e1; background-color: #f8fafc; }
    .attempt-pill { background-color: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; font-size: 0.72rem; border-radius: 6px; }
    .view-details-btn {
        width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; 
        justify-content: center; transition: all 0.2s ease; background-color: #f8fafc; border: 1px solid #e2e8f0; color: #2563eb;
    }
    .view-details-btn:hover { background-color: #eff6ff; border-color: #bfdbfe; color: #1d4ed8; }
</style>

<div class="container py-4">
    <!-- Top Metrics Summary Blocks -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="metric-summary-card p-3 shadow-sm bg-white rounded-2" >
                <div class="d-flex align-items-center">
                    <div class="text-white rounded-3 p-3 me-3 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; background: linear-gradient(135deg, #4f46e5, #3730a3);">
                        <i class="bi bi-diagram-3 fs-5"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small fw-bold text-uppercase tracking-wider" style="font-size: 0.68rem;">Sub-Categories Loaded</h6>
                        <h4 class="mb-0 fw-extrabold text-dark mt-0.5">{{ count($tests) }} Scopes</h4>
                    </div>
                </div>
            </div>
        </div>
         
        <div class="col-md-4">
            <div class="metric-summary-card p-3 shadow-sm bg-white rounded-2">
                <div class="d-flex align-items-center">
                    <div class="text-white rounded-3 p-3 me-3 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                        <i class="bi bi-journal-check fs-5"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small fw-bold text-uppercase tracking-wider" style="font-size: 0.68rem;">Total Tests Bound</h6>
                        <h4 class="mb-0 fw-extrabold text-dark mt-0.5">
                            {{ collect($tests)->pluck('test')->flatten(1)->count() }} Active Matrices
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="metric-summary-card p-3 shadow-sm bg-white rounded-2">
                <div class="d-flex align-items-center">
                    <div class="text-white rounded-3 p-3 me-3 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; background: linear-gradient(135deg, #10b981, #059669);">
                        <i class="bi bi-people fs-5"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small fw-bold text-uppercase tracking-wider" style="font-size: 0.68rem;">Total Live Attempts</h6>
                        <h4 class="mb-0 fw-extrabold text-dark mt-0.5">
                            {{ collect($tests)->pluck('test')->flatten(1)->pluck('attempts')->flatten(1)->count() }} Engines run
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Workspace Tree Structure -->
    <div class="dashboard-card p-4 shadow-sm w-100">
        
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-3 border-bottom border-light">
            <div>
                <h5 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Test Curriculum Hierarchy</h5>
                <p class="text-muted mb-0 small">Browse master courses to manage sub-categories and evaluate performance logs</p>
            </div>
        </div>

        @php
            // Centralized configuration matrix for Course Styles matching your Master Database structure
            $courseThemeMatrix = [
                1  => ['icon' => 'bi-cone-striped',     'start_color' => '#2563eb', 'end_color' => '#1d4ed8'], // IIT JEE
                2  => ['icon' => 'bi-heart-pulse-fill', 'start_color' => '#dc2626', 'end_color' => '#b91c1c'], // NEET
                3  => ['icon' => 'bi-calculator-fill',  'start_color' => '#059669', 'end_color' => '#047857'], // CA Foundation
                4  => ['icon' => 'bi-balance-scale',    'start_color' => '#7c3aed', 'end_color' => '#6d28d9'], // CLAT
                5  => ['icon' => 'bi-bank2',            'start_color' => '#db2777', 'end_color' => '#be185d'], // CUET
                6  => ['icon' => 'bi-person-workspace', 'start_color' => '#ea580c', 'end_color' => '#c2410c'], // 12th Dropper
                7  => ['icon' => 'bi-shield-shaded',    'start_color' => '#4b5563', 'end_color' => '#374151'], // NDA
                8  => ['icon' => 'bi-cpu-fill',          'start_color' => '#0d9488', 'end_color' => '#0f766e'], // IT
                9  => ['icon' => 'bi-book-half',        'start_color' => '#0284c7', 'end_color' => '#0369a1'], // 10 Class
                10 => ['icon' => 'bi-code-slash',       'start_color' => '#0f172a', 'end_color' => '#1e293b'], // Development / IT Sub
            ];

            // Default safe fallback layout parameters
            $defaultTheme = ['icon' => 'bi-mortarboard-fill', 'start_color' => '#4f46e5', 'end_color' => '#4338ca'];
        @endphp

        <div class="accordion curriculum-tree-accordion d-flex flex-column gap-3" id="masterCourseAccordion">
            @forelse($tests->groupBy('course_id') as $courseId => $subCourseGroup)
                @php
                    // Dynamic styling block fetching corresponding indices safely
                    $activeTheme = $courseThemeMatrix[$courseId] ?? $defaultTheme;
                @endphp
                
                <div class="accordion-item border-0 shadow-sm rounded-4 overflow-hidden" style="background: #ffffff; border: 1px solid rgba(226, 232, 240, 0.8) !important;">
                    <h2 class="accordion-header" id="heading-course-{{ $courseId }}">
                        <button class="accordion-button collapsed px-4 py-3.5 d-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-course-{{ $courseId }}" aria-expanded="false" aria-controls="collapse-course-{{ $courseId }}" style="background: #ffffff; box-shadow: none;">
                            <div class="d-flex align-items-center gap-3 w-100">
                                
                                <!-- DYNAMIC CONTEXTUAL ACCENT BOX -->
                                <div class="rounded-3 d-flex align-items-center justify-content-center text-white" 
                                     style="width: 40px; height: 40px; background: linear-gradient(135deg, {{ $activeTheme['start_color'] }}, {{ $activeTheme['end_color'] }});">
                                    <i class="bi {{ $activeTheme['icon'] }} fs-5"></i>
                                </div>
                                
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 1.02rem; letter-spacing: -0.3px;">{{ getCourseNameById($courseId) }}</h6>
                                    <span class="text-muted small fw-medium" style="font-size: 0.8rem;">Contains {{ $subCourseGroup->count() }} Sub-Category Node Tracks</span>
                                </div>
                            </div>
                        </button>
                    </h2>

                    <div id="collapse-course-{{ $courseId }}" class="accordion-collapse collapse" aria-labelledby="heading-course-{{ $courseId }}" data-bs-parent="#masterCourseAccordion">
                        <div class="accordion-body p-4 bg-light-subtle border-top border-light">
                            <div class="sub-course-tree-wrapper d-flex flex-column gap-3">
                                
                                @foreach($subCourseGroup as $subCat)
                                    <div class="sub-course-node-row p-3 rounded-3 bg-white border d-flex flex-column flex-md-row align-items-md-start justify-content-between gap-3" style="border-color: rgba(226, 232, 240, 0.9) !important;">
                                        
                                        <div style="min-width: 220px; max-width: 260px;" class="mt-1">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <!-- MATCHING INTERNAL SUB-COURSE MATRIX POINTER -->
                                                <div class="rounded-2 p-1.5 d-flex align-items-center justify-content-center" 
                                                     style="width: 28px; height: 28px; background-color: {{ $activeTheme['start_color'] }}12;">
                                                    <i class="bi bi-diagram-3-fill" style="font-size: 0.85rem; color: {{ $activeTheme['start_color'] }};"></i>
                                                </div>
                                                <span class="fw-bold text-dark" style="font-size: 0.92rem;">{{ $subCat->name }}</span>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1">
                                            <div class="d-flex flex-column gap-2">
                                                @forelse($subCat->test as $test)
                                                    <div class="test-matrix-chip p-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                                                        <div>
                                                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                                                <span class="fw-semibold text-slate-800" style="font-size: 0.88rem;"><i class="bi bi-file-text text-muted me-1.5"></i>&nbsp;&nbsp;{{ $test->title }}</span>
                                                                <span class="badge bg-light text-secondary border font-monospace px-1.5 py-0.5 rounded" style="font-size: 0.68rem;">{{ $test->duration_minutes }} Min</span>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex align-items-center gap-3 justify-content-end flex-shrink-0">
                                                            @if($test->attempts->count() > 0)
                                                                <span class="attempt-pill px-2 py-1 fw-bold"><i class="bi bi-person-check-fill me-1"></i>{{ $test->attempts->count() }} Attempts</span>
                                                            @else
                                                                <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 0.7rem;">0 Run</span>
                                                            @endif

                                                            <div class="d-flex align-items-center border-start ps-2.5" style="border-color: #cbd5e1 !important;">
                                                                <a href="{{ route('admin.tests.show-details', $test->id) }}" class="view-details-btn" title="View Review Details">
                                                                    <i class="bi bi-eye fs-5"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="text-muted font-monospace py-1" style="font-size: 0.75rem;"><i class="bi bi-slash-circle me-1"></i>No operational evaluation test matrices linked.</div>
                                                @endforelse
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted bg-white rounded-4 border shadow-sm">
                    <i class="bi bi-folder-x fs-1 text-light d-block mb-2"></i>No relational hierarchies structured inside current workspace data layers.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection