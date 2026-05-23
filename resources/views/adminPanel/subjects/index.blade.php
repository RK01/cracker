@extends('layouts.admin')

@section('content')
<!-- High-End Dashboard Tiles & Layout Engine Custom Styling -->
<style>
    .dashboard-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(226, 232, 240, 0.8);
    }
    /* Stat Tiles Styling */
    .stat-tile {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 20px;
        transition: all 0.2s ease;
    }
    .stat-tile:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.04);
    }
    .curriculum-tree-accordion .accordion-item {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .curriculum-tree-accordion .accordion-item:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.03) !important;
    }
    .subject-chip {
        transition: all 0.2s ease;
    }
    .subject-chip:hover {
        background-color: #f1f5f9 !important;
        border-color: #cbd5e1 !important;
    }
</style>

<div class="container py-4">
    <div class="dashboard-card p-4 shadow-sm w-100">
        
        <!-- TOP STREAM CONTROL FILTERS -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-3 border-bottom border-light">
            <div>
                <h5 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Course Curriculum Hierarchy</h5>
                <p class="text-muted mb-0 small">Browse master courses to manage sub-courses and their nested subject payloads</p>
            </div>
            
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary px-4 py-2 rounded-3 fw-medium d-inline-flex align-items-center gap-2" style="font-size: 0.88rem; background-color: #2563eb; border: none;">
                    <i class="bi bi-plus-lg"></i> Map New Subjects
                </a>
            </div>
        </div>

        @php
            // Calculate real-time dynamic stats from the $subjects database collection/array
            $totalMasterCourses = count($subjects);
            
            $totalSubCourses = 0;
            $totalSubjects = 0;
            foreach ($subjects as $courseId => $subCourses) {
                $totalSubCourses += count($subCourses);
                foreach ($subCourses as $subCourseNode) {
                    $totalSubjects += count($subCourseNode['subjects'] ?? []);
                }
            }

            // Centralized configuration logic for matching course icons and theme colors
            $courseStyles = [
                1  => ['icon' => 'bi-cone-striped', 'color' => '#2563eb'],       // IIT JEE
                2  => ['icon' => 'bi-heart-pulse-fill', 'color' => '#dc2626'],   // NEET
                3  => ['icon' => 'bi-calculator-fill', 'color' => '#059669'],    // CA Foundation
                4  => ['icon' => 'bi-balance-scale', 'color' => '#7c3aed'],       // CLAT
                5  => ['icon' => 'bi-bank2', 'color' => '#db2777'],               // CUET
                6  => ['icon' => 'bi-person-workspace', 'color' => '#ea580c'],    // 12th Dropper
                7  => ['icon' => 'bi-shield-shaded', 'color' => '#4b5563'],       // NDA
                8  => ['icon' => 'bi-cpu-fill', 'color' => '#0d9488'],            // IT
                9  => ['icon' => 'bi-book-half', 'color' => '#0284c7'],           // 10 Class
                10 => ['icon' => 'bi-code-slash', 'color' => '#0f172a'],          // IT/Dev
            ];
            
            // Dynamic fallback schema if ID doesn't match above mappings
            $defaultStyle = ['icon' => 'bi-mortarboard-fill', 'color' => '#2563eb'];
        @endphp

        <!-- OVERVIEW SUMMARY METRICS TILES -->
        <div class="row g-3 mb-4">
            <!-- Tile 1: Total Master Courses -->
            <div class="col-12 col-md-4">
                <div class="stat-tile d-flex align-items-center justify-content-between shadow-xs">
                    <div>
                        <span class="text-muted small fw-medium text-uppercase font-monospace d-block mb-1" style="letter-spacing: 0.5px;">Master Categories</span>
                        <h3 class="mb-0 fw-bold text-dark">{{ $totalMasterCourses }}</h3>
                    </div>
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #eff6ff; color: #2563eb;">
                        <i class="bi bi-collection-fill fs-4"></i>
                    </div>
                </div>
            </div>

            <!-- Tile 2: Total Sub Courses -->
            <div class="col-12 col-md-4">
                <div class="stat-tile d-flex align-items-center justify-content-between shadow-xs">
                    <div>
                        <span class="text-muted small fw-medium text-uppercase font-monospace d-block mb-1" style="letter-spacing: 0.5px;">Sub-Course Tracks</span>
                        <h3 class="mb-0 fw-bold text-dark">{{ $totalSubCourses }}</h3>
                    </div>
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #f0fdf4; color: #16a34a;">
                        <i class="bi bi-diagram-3-fill fs-4"></i>
                    </div>
                </div>
            </div>

            <!-- Tile 3: Total Mapped Subjects -->
            <div class="col-12 col-md-4">
                <div class="stat-tile d-flex align-items-center justify-content-between shadow-xs">
                    <div>
                        <span class="text-muted small fw-medium text-uppercase font-monospace d-block mb-1" style="letter-spacing: 0.5px;">Mapped Subjects</span>
                        <h3 class="mb-0 fw-bold text-dark">{{ $totalSubjects }}</h3>
                    </div>
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #fdf2f8; color: #db2777;">
                        <i class="bi bi-book-half fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback Notification Engine -->
        @if(session('success'))
            <div class="alert alert-success border-0 mx-0 mb-4 rounded-3 small shadow-sm">{{ session('success') }}</div>
        @endif

        <!-- NESTED ACCORDION SYSTEM ARCHITECTURE -->
        <div class="accordion curriculum-tree-accordion d-flex flex-column gap-3" id="masterCourseAccordion">
            
            @forelse($subjects as $courseId => $subCourses)
                @php 
                    $firstSubCourse = collect($subCourses)->first();
                    $masterCourseName = isset($firstSubCourse['course_name']) ? $firstSubCourse['course_name'] : getCourseNameById($courseId);
                    
                    // Assign dynamic contextual icons and layout colors based on active database key ID
                    $currentStyle = $courseStyles[$courseId] ?? $defaultStyle;
                @endphp
                
                <div class="accordion-item border-0 shadow-sm rounded-4 overflow-hidden" style="background: #ffffff; border: 1px solid rgba(226, 232, 240, 0.8) !important;">
                    
                    <!-- Accordion Trigger: Main Course Layer with Dynamic Styles -->
                    <h2 class="accordion-header" id="heading-course-{{ $courseId }}">
                        <button class="accordion-button collapsed px-4 py-3.5 d-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-course-{{ $courseId }}" aria-expanded="false" aria-controls="collapse-course-{{ $courseId }}" style="background: #ffffff; box-shadow: none;">
                            <div class="d-flex align-items-center gap-3 w-100">
                                <!-- Dynamic Color Accentuation Mapping Block -->
                                <div class="rounded-3 d-flex align-items-center justify-content-center text-white" 
                                     style="width: 40px; height: 40px; background: linear-gradient(135deg, {{ $currentStyle['color'] }}, {{ $currentStyle['color'] }}dd);">
                                    <i class="bi {{ $currentStyle['icon'] }} fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 1.05rem; letter-spacing: -0.3px;">{{ $masterCourseName }}</h6>
                                    <span class="text-muted small fw-medium" style="font-size: 0.8rem;">Contains {{ count($subCourses) }} Sub-Courses Structure</span>
                                </div>
                            </div>
                        </button>
                    </h2>

                    <!-- Accordion Content Box -->
                    <div id="collapse-course-{{ $courseId }}" class="accordion-collapse collapse" aria-labelledby="heading-course-{{ $courseId }}" data-bs-parent="#masterCourseAccordion">
                        <div class="accordion-body p-4 bg-light-subtle border-top border-light">
                            
                            <div class="sub-course-tree-wrapper d-flex flex-column gap-3">
                                
                                @foreach($subCourses as $subCourseNode)
                                    @php
                                        $subCourseId = $subCourseNode['sub_course_id'];
                                        $subCourseName = isset($subCourseNode['sub_course_name']) ? $subCourseNode['sub_course_name'] : getSubCatCourseNameById($subCourseId);
                                    @endphp
                                    
                                    <div class="sub-course-node-row p-3 rounded-3 bg-white border d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3" style="border-color: rgba(226, 232, 240, 0.9) !important;">
                                        
                                        <!-- Sub Course Identity Zone -->
                                        <div style="min-width: 240px; max-width: 280px;">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <div class="bg-secondary-subtle text-secondary rounded-2 p-1.5 d-flex align-items-center justify-content-center" style="width: 28px; height: 28px;">
                                                    <i class="bi bi-diagram-3-fill" style="font-size: 0.85rem; color: {{ $currentStyle['color'] }};"></i>
                                                </div>
                                                <span class="fw-bold text-dark" style="font-size: 0.92rem;">
                                                    {{ $subCourseName }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- LAYER 3: Mapped Subjects -->
                                        <div class="flex-grow-1">
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach($subCourseNode['subjects'] as $subject)
                                                    <div class="subject-chip d-inline-flex align-items-center gap-2 bg-light border px-3 py-1.5 rounded-2 text-slate-800 fw-medium shadow-sm" style="font-size: 0.85rem; border-color: #e2e8f0 !important;">
                                                        <i class="bi bi-book text-muted" style="font-size: 0.8rem;"></i>
                                                        <span>{{ $subject['name'] }}</span>
                                                        
                                                        <div class="ms-2 d-flex align-items-center gap-1 border-start ps-2" style="border-color: #cbd5e1 !important;">
                                                            <a href="{{ route('admin.subjects.edit', $subject['id']) }}" class="text-primary text-decoration-none px-1" title="Edit Subject Mapping" style="font-size: 0.82rem;">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </a>
                                                            
                                                            <form action="{{ route('admin.subjects.destroy', $subject['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to completely remove this subject node?');" class="d-inline m-0">
                                                                @csrf 
                                                                @method('DELETE')
                                                                <button type="submit" class="text-danger border-0 bg-transparent p-0 px-1" title="Delete Subject Mapping" style="font-size: 0.82rem; line-height: 1;">
                                                                    <i class="bi bi-trash3"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endforeach
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
                    <i class="bi bi-folder-x fs-1 text-light d-block mb-2"></i>
                    No relational hierarchies structured inside current workspace data layers.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection