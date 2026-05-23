@extends('layouts.admin') {{-- Extends your admin wrapper --}}

@section('content')
<!-- Custom Style injection to handle beautiful hover borders without messing with JS events -->


<div class="container py-4">

    <!-- Top Structural Bar -->
    <div class="d-flex justify-content-between align-items-center mb-4 p-4 bg-white border border-light shadow-sm" style="border-radius: 16px;">
        <div>
            <span class="badge bg-soft-primary text-primary px-3 py-1.5 mb-2 rounded-pill small fw-bold" style="background-color: #e0e7ff; color: #4f46e5; letter-spacing: 0.5px;">Central Audit Stream</span>
            <h4 class="mb-1 fw-extrabold text-dark" style="letter-spacing: -0.5px; font-size: 1.6rem;"><i class="bi bi-shield-check text-indigo me-2"></i> Assignments Inspection Desk</h4>
            <p class="text-muted small mb-0 fw-medium">Read-only diagnostic view of academic collateral, uploads, and distribution tracking</p>
        </div>
    </div>

    <!-- Analytical Micro Metric Widgets -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 bg-white h-100" style="border-radius: 14px; border-left: 5px solid #4f46e5 !important;">
                <div class="d-flex align-items-center">
                    <div class="text-white p-3 rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #4f46e5, #3730a3); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);"><i class="bi bi-folder2-open fs-5"></i></div>
                    <div>
                        <small class="text-muted text-uppercase tracking-wider fw-bold" style="font-size: 0.65rem;">Total Repository</small>
                        <h3 class="mb-0 fw-black text-dark mt-0.5">{{ $stats['total'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 bg-white h-100" style="border-radius: 14px; border-left: 5px solid #10b981 !important;">
                <div class="d-flex align-items-center">
                    <div class="text-white p-3 rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #10b981, #047857); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);"><i class="bi bi-cloud-arrow-up fs-5"></i></div>
                    <div>
                        <small class="text-muted text-uppercase tracking-wider fw-bold" style="font-size: 0.65rem;">Active Entities</small>
                        <h3 class="mb-0 fw-black text-dark mt-0.5">{{ $stats['active'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 bg-white h-100" style="border-radius: 14px; border-left: 5px solid #f59e0b !important;">
                <div class="d-flex align-items-center">
                    <div class="text-white p-3 rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #f59e0b, #b45309); box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);"><i class="bi bi-journal-text fs-5"></i></div>
                    <div>
                        <small class="text-muted text-uppercase tracking-wider fw-bold" style="font-size: 0.65rem;">Academic Notes</small>
                        <h3 class="mb-0 fw-black text-dark mt-0.5">{{ $stats['notes'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 bg-white h-100" style="border-radius: 14px; border-left: 5px solid #ef4444 !important;">
                <div class="d-flex align-items-center">
                    <div class="text-white p-3 rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #ef4444, #b91c1c); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);"><i class="bi bi-hourglass-bottom fs-5"></i></div>
                    <div>
                        <small class="text-muted text-uppercase tracking-wider fw-bold" style="font-size: 0.65rem;">Terminated Nodes</small>
                        <h3 class="mb-0 fw-black text-dark mt-0.5">{{ $stats['expired'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Master Filter Panel & Main Structural Grid -->
    <div class="card border border-light mb-4 dashboard-card shadow-sm w-100 " style="border-radius: 16px; overflow: hidden; background-color: #fafafa !important;">
        <div class="card-header bg-white border-bottom border-light py-3.5 px-4">
            <form method="GET" action="{{ url()->current() }}">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <div class="position-relative">
                            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y text-indigo ms-3" style="font-size: 0.9rem;"></i>
                            <input type="text" class="form-control bg-white border ps-5 rounded-3 text-sm" placeholder="Filter by asset name or title parameters..." name="search" value="{{ request('search') }}" style="padding-top: 10px; padding-bottom: 10px; font-size: 0.85rem; border: 1px solid #e2e8f0;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select bg-white border rounded-3 text-sm" name="type" style="padding-top: 10px; padding-bottom: 10px; font-size: 0.85rem; border: 1px solid #e2e8f0;">
                            <option value="">All Structural Categories</option>
                            <option value="assignment" {{ request('type') == 'assignment' ? 'selected' : '' }}>Assignment Nodes</option>
                            <option value="notes" {{ request('type') == 'notes' ? 'selected' : '' }}>Informational Notes</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select bg-white border rounded-3 text-sm" name="status" style="padding-top: 10px; padding-bottom: 10px; font-size: 0.85rem; border: 1px solid #e2e8f0;">
                            <option value="">All Temporal States</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active Scope</option>
                            <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired Scope</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-indigo text-white w-100 rounded-3 fw-bold" style="padding-top: 9px; padding-bottom: 9px; font-size: 0.85rem; background-color: #4f46e5;"><i class="bi bi-sliders me-1"></i> Apply</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Assignments Segment Cards View Loop -->
        <div class="p-4" style="background-color: #f8fafc;">
            @forelse($assignments as $assignment)
                @php
                    $isExpired = \Carbon\Carbon::parse($assignment->due_date)->isPast();
                @endphp
                
                <!-- INDIVIDUAL DISCRETE DECK ROW CARD WITH REFACTORED CSS HOVER CLASS -->
                <div class="card bg-white mb-3 dynamic-assignment-card">
                    <div class="card-body p-3.5">
                        <div class="row align-items-center g-3">
                            
                            <!-- Asset Configuration & Title -->
                            <div class="col-lg-4 col-md-6">
                                <span class="fw-extrabold text-indigo mb-1 d-block" style="font-size: 0.98rem; color: #312e81;">{{ $assignment->title }}</span>
                                <div class="small text-muted text-truncate fw-medium" style="max-width: 320px; font-size: 0.8rem; color: #64748b !important;">{{ $assignment->description ?? 'No descriptive logs mapped to this node.' }}</div>
                                <small class="mt-1.5 d-block" style="font-size: 0.74rem; color: #4f46e5;"><i class="bi bi-person-badge-fill me-1"></i>Faculty Owner: <span class="fw-bold text-dark">#{{ userNameById($assignment->posted_by) }}</span></small>
                            </div>

                            <!-- Type Parameter (Vibrant Badges) -->
                            <div class="col-lg-2 col-md-3 col-6">
                                <small class="text-muted d-block text-uppercase font-monospace tracking-wider mb-1" style="font-size: 0.65rem;">Classification</small>
                                <span class="badge rounded-pill px-3 py-1.5 {{ $assignment->type == 'assignment' ? 'bg-warning text-dark fw-bold' : 'bg-success text-white fw-bold' }}" style="font-size: 0.72rem; letter-spacing: 0.3px;">
                                    {{ strtoupper($assignment->type) }}
                                </span>
                            </div>

                            <!-- Target Chronology -->
                            <div class="col-lg-2 col-md-3 col-6">
                                <small class="text-muted d-block text-uppercase font-monospace tracking-wider mb-1" style="font-size: 0.65rem;">Timeline Limit</small>
                                <span class="text-dark fw-bold d-inline-flex align-items-center gap-1" style="font-size: 0.88rem;"><i class="bi bi-calendar3 text-secondary" style="font-size: 0.8rem;"></i> {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y') }}</span>
                            </div>

                            <!-- Data Payload Size -->
                            <div class="col-lg-1 col-md-3 col-6">
                                <small class="text-muted d-block text-uppercase font-monospace tracking-wider mb-1" style="font-size: 0.65rem;">Payload Matrix</small>
                                <span class="text-indigo font-monospace fw-bold" style="font-size: 0.85rem; color: #4f46e5;">{{ number_format($assignment->file_size / 1024, 2) }} KB</span>
                            </div>

                            <!-- Distribution Status (Colorized Indicator) -->
                            <div class="col-lg-1.5 col-md-3 col-6">
                                <small class="text-muted d-block text-uppercase font-monospace tracking-wider mb-1" style="font-size: 0.65rem;">Channel Status</small>
                                <span class="badge border rounded-pill px-3 py-1.5 d-inline-flex align-items-center gap-1.5"
                                      style="font-size: 0.74rem; background-color: {{ $isExpired ? '#fef2f2' : '#ecfdf5' }}; border-color: {{ $isExpired ? '#fca5a5' : '#6ee7b7' }} !important; color: {{ $isExpired ? '#dc2626' : '#059669' }}; font-weight: 700;">
                                    <span style="width: 6px; height: 6px; background-color: currentColor;" class="rounded-circle d-inline-block"></span>
                                    {{ $isExpired ? 'EXPIRED' : 'ACTIVE' }}
                                </span>
                            </div>

                            <!-- Deep Analysis Link & Buttons -->
                            <div class="col-lg-1.5 col-md-6 text-md-end text-start ms-lg-auto">
                                <div class="btn-group shadow-xs rounded-3 overflow-hidden" style="border: 1px solid #cbd5e1;">
                                    <a href="{{ asset('storage/' . $assignment->file_path) }}" target="_blank" class="btn btn-sm btn-white bg-white text-indigo border-end" style="font-size: 0.82rem; padding: 6px 12px;" title="Inspect Attachment">
                                        <i class="bi bi-file-earmark-arrow-down-fill text-indigo fs-6"></i>
                                    </a>
                                    <!-- FIXED BUTTON ARGS HERE -->
                                    <button class="btn btn-sm btn-indigo text-white text-nowrap fw-bold" 
                                            style="font-size: 0.82rem; background-color: #4f46e5; padding: 6px 12px;" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#subCard{{ $assignment->id }}" 
                                            aria-expanded="false" 
                                            aria-controls="subCard{{ $assignment->id }}"
                                            title="Toggle Transmissions Logs">
                                        <i class="bi bi-people-fill me-1"></i> Logs ({{ $assignment->student->count() }})
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Collapsible Student Submissions Matrix Layer -->
                    <div class="collapse" id="subCard{{ $assignment->id }}">
                        <div class="p-4 border-top" style="background-color: #f8fafc !important; border-top: 1px solid #e2e8f0 !important;">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-grid-3x3-gap-fill text-indigo me-2 fs-6"></i>
                                <h6 class="fw-extrabold text-dark mb-0" style="font-size: 0.88rem; letter-spacing: -0.2px;">Relational Target Submissions Log Terminal</h6>
                            </div>
                            
                            @if($assignment->student->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-sm table-hover align-middle bg-white rounded-3 border mb-0" style="box-shadow: 0 2px 4px rgba(0,0,0,0.02); border: 1px solid #e2e8f0 !important;">
                                    <thead>
                                        <tr class="text-muted text-uppercase fw-bold" style="font-size: 0.68rem; border-bottom: 2px solid #e2e8f0; letter-spacing: 0.5px; background-color: #f1f5f9;">
                                            <th class="ps-3 py-2.5 text-dark">Student Node Information</th>
                                            <th class="py-2.5 text-dark">Encrypted Binary Payload</th>
                                            <th class="py-2.5 text-dark">Transmission Stamp</th>
                                            <th class="py-2.5 text-dark">Current Lifecycle State</th>
                                            <th class="text-end pe-3 py-2.5 text-dark">Evaluated Scoring</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 0.84rem;">
                                        @foreach($assignment->student as $submissionInstance)
                                        <tr class="border-bottom border-light">
                                            <td class="ps-3 py-2.5 fw-bold text-dark"><i class="bi bi-person-fill me-1.5 text-indigo"></i> {{ userNameById($submissionInstance->user_id) }}</td>
                                            <td class="py-2.5">
                                                <a href="{{ asset('storage/' . $submissionInstance->file_path) }}" target="_blank" class="text-indigo fw-bold text-decoration-none d-inline-flex align-items-center gap-1.5">
                                                    <i class="bi bi-file-earmark-zip-fill text-danger fs-6"></i> Extract Submission
                                                </a>
                                            </td>
                                            <td class="py-2.5 text-muted fw-medium"><i class="bi bi-clock-fill me-1.5 text-secondary" style="font-size: 0.76rem;"></i> {{ \Carbon\Carbon::parse($submissionInstance->submitted_at_user)->format('d M Y, h:i A') }}</td>
                                            <td class="py-2.5">
                                                <span class="badge rounded-pill fw-bold border px-2.5 py-1 {{ $submissionInstance->status == 'completed' ? 'bg-light-success text-success border-success' : ($submissionInstance->status == 'rejected' ? 'bg-light-danger text-danger border-danger' : 'bg-light-warning text-warning border-warning') }}" style="font-size: 0.7rem; background-color: #f8fafc;">
                                                    {{ strtoupper($submissionInstance->status) }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-3 py-2.5 font-monospace fw-extrabold {{ $submissionInstance->score_by_faculty ? 'text-success' : 'text-muted' }}" style="font-size: 0.9rem;">
                                                {{ $submissionInstance->score_by_faculty ?? 'UNGRADED' }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center py-4 rounded-3 border bg-white text-muted small d-flex flex-column align-items-center justify-content-center" style="border: 1px dashed #cbd5e1 !important;">
                                <i class="bi bi-inbox-fill fs-4 mb-1.5 text-indigo" style="color: #818cf8;"></i>
                                <span class="fw-semibold">Zero Structural Logs Transmitted for this node yet.</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 bg-white border border-light rounded-3 text-muted shadow-sm">
                    <i class="bi bi-cloud-slash d-block mb-2 fs-1 text-secondary"></i>
                    <span class="fw-bold">No assignments found matching these query filters.</span>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Bottom Structural Layout -->
    <div class="row g-4 mt-1">
        <div class="col-lg-8">
            <div class="card shadow-sm rounded-3 bg-white" style="border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0;">
                <div class="card-header bg-white py-3.5 px-4 border-bottom border-light" style="border-top: 4px solid #4f46e5 !important;">
                    <h5 class="mb-0 fw-extrabold text-dark" style="font-size: 1.1rem;"><i class="bi bi-person-lines-fill text-indigo me-2"></i> Comprehensive Student Activity Directory</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="text-dark text-uppercase tracking-wider fw-bold" style="font-size: 0.72rem; background-color: #f1f5f9; border-bottom: 2px solid #e2e8f0;">
                            <tr>
                                <th class="ps-4 py-3">Student Metadata</th>
                                <th class="py-3">Communications Profile</th>
                                <th class="py-3">Global Status</th>
                                <th class="py-3">Transmitted Blob</th>
                                <th class="text-center py-3">Recorded Marks</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.88rem;">
                            @forelse($getAllStudents as $studentItem)
                            @php
                                $studentSubmissionInstance = $studentItem->submissions[0] ?? null;
                            @endphp
                            <tr class="border-bottom border-light">
                                <td class="ps-4 py-2.5">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-indigo text-white d-flex align-items-center justify-content-center fw-bold me-2.5 shadow-sm" style="width: 34px; height: 34px; font-size: 0.78rem; background-color: #4f46e5;">
                                            {{ strtoupper(substr($studentItem->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 0.92rem;">{{ ucwords($studentItem->name) }}</div>
                                            <small class="text-indigo font-monospace fw-bold" style="font-size: 0.72rem;">{{ $studentItem->username }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-2.5">
                                    <div class="text-dark fw-medium small"><i class="bi bi-envelope-fill me-1.5 text-secondary"></i> {{ $studentItem->email }}</div>
                                    <div class="text-muted mt-1 fw-semibold" style="font-size: 0.75rem;"><i class="bi bi-telephone-fill me-1.5 text-secondary"></i> {{ $studentItem->phone ?? 'N/A' }}</div>
                                </td>
                                <td class="py-2.5">
                                    @if($studentSubmissionInstance)
                                    <span class="badge border rounded-pill px-2.5 py-1 fw-bold" style="font-size: 0.7rem; background-color: #ecfdf5; color: #10b981; border-color: #a7f3d0 !important;">
                                        <i class="bi bi-cloud-check-fill me-1"></i> Submitted
                                    </span>
                                    <div class="text-muted mt-1 font-monospace fw-medium" style="font-size: 0.68rem;">
                                        {{ \Carbon\Carbon::parse($studentSubmissionInstance['submitted_at_user'])->format('d M, h:i A') }}
                                    </div>
                                    @else
                                    <span class="badge border rounded-pill px-2.5 py-1 fw-bold" style="font-size: 0.7rem; background-color: #fef2f2; color: #ef4444; border-color: #fca5a5 !important;">
                                        <i class="bi bi-exclamation-circle-fill me-1"></i> Empty Channel
                                    </span>
                                    @endif
                                </td>
                                <td class="py-2.5">
                                    @if($studentSubmissionInstance && $studentSubmissionInstance['file_path'])
                                    <a href="{{ asset('storage/assignment/' . $studentSubmissionInstance['file_path']) }}" target="_blank" class="text-decoration-none fw-bold text-dark d-inline-flex align-items-center gap-1.5">
                                        <i class="bi bi-filetype-pdf text-danger fs-5"></i> <span style="border-bottom: 1px dashed #4f46e5;" class="text-indigo">View PDF</span>
                                    </a>
                                    @else
                                    <span class="text-muted font-monospace" style="font-size: 0.8rem;">---</span>
                                    @endif
                                </td>
                                <td class="text-center py-2.5 font-monospace fw-extrabold text-secondary">
                                    @if($studentSubmissionInstance && $studentSubmissionInstance['score_by_faculty'])
                                    <span class="text-success" style="font-size: 1rem;">{{ $studentSubmissionInstance['score_by_faculty'] }}</span><span class="text-muted" style="font-size: 0.72rem;">/100</span>
                                    @elseif($studentSubmissionInstance)
                                    <span class="text-warning small fw-bold" style="font-size: 0.76rem; background-color: #fffbeb; padding: 2px 6px; border-radius: 4px; border: 1px solid #fde68a;">Pending</span>
                                    @else
                                    <span class="text-muted">---</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted fw-semibold">No operational logs found in current cluster.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @php
            $totalCount = $stats['total'] > 0 ? $stats['total'] : 1; 
            $activeWidth = ($stats['active'] / $totalCount) * 100;
            $expiredWidth = ($stats['expired'] / $totalCount) * 100;
            $notesWidth = ($stats['notes'] / $totalCount) * 100;
        @endphp

        <!-- Analytical Vector Cascades Side Deck -->
        <div class="col-lg-4">
            <div class="card shadow-sm p-4 bg-white mb-3" style="border-radius: 16px; border: 1px solid #e2e8f0;">
                <h5 class="mb-3.5 fw-extrabold text-dark" style="font-size: 1.1rem;"><i class="bi bi-pie-chart-fill text-indigo me-2"></i> Dynamic Channel Weights</h5>
                
                <div class="mb-3.5">
                    <div class="d-flex justify-content-between align-items-center mb-1.5">
                        <span class="small text-muted fw-bold">Active Assignments Ratio</span>
                        <span class="fw-extrabold small text-success">{{ $stats['active'] }}</span>
                    </div>
                    <div class="progress rounded-pill" style="height: 8px; background-color: #f1f5f9; box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);">
                        <div class="progress-bar bg-success rounded-pill" role="progressbar" style="width: {{ $activeWidth }}%" aria-valuenow="{{ $activeWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="mb-3.5 mt-3.5">
                    <div class="d-flex justify-content-between align-items-center mb-1.5">
                        <span class="small text-muted fw-bold">Expired Task Ratio</span>
                        <span class="fw-extrabold small text-danger">{{ $stats['expired'] }}</span>
                    </div>
                    <div class="progress rounded-pill" style="height: 8px; background-color: #f1f5f9; box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);">
                        <div class="progress-bar bg-danger rounded-pill" role="progressbar" style="width: {{ $expiredWidth }}%" aria-valuenow="{{ $expiredWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="mb-2 mt-3.5">
                    <div class="d-flex justify-content-between align-items-center mb-1.5">
                        <span class="small text-muted fw-bold">Academic Study Notes Weight</span>
                        <span class="fw-extrabold small text-warning">{{ $stats['notes'] }}</span>
                    </div>
                    <div class="progress rounded-pill" style="height: 8px; background-color: #f1f5f9; box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);">
                        <div class="progress-bar bg-warning rounded-pill" role="progressbar" style="width: {{ $notesWidth }}%" aria-valuenow="{{ $notesWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            <!-- Static Dataset Configuration Dump Box -->
            <div class="p-3 shadow-sm border-start border-indigo border-4" style="background-color: #ffffff; border-radius: 8px; border-left-width: 5px !important; border-top: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
                <div class="text-uppercase tracking-wider font-monospace text-indigo mb-2.5" style="font-size: 0.72rem; font-weight: 800;">Immutable Context Summary</div>
                <div class="text-dark py-1 fw-semibold" style="font-size: 0.84rem;"><i class="bi bi-folder-check text-indigo me-2"></i> Total Global Logs: <span class="fw-extrabold float-end text-dark">{{ $stats['total'] }}</span></div>
                <div class="text-dark py-1 fw-semibold" style="font-size: 0.84rem;"><i class="bi bi-bookmark-fill text-warning me-2"></i> Total Document Notes: <span class="fw-extrabold float-end text-dark">{{ $stats['notes'] }}</span></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')


<style>
    .dynamic-assignment-card {
        border-radius: 12px; 
        border: 1px solid #e2e8f0; 
        border-left: 4px solid #4f46e5 !important; 
        transition: transform 0.2s ease-in-out, border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.03) !important;
    }
    .dynamic-assignment-card:hover {
        transform: translateY(-2px); 
        border-color: #4f46e5 !important;
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.1), 0 4px 6px -4px rgba(79, 70, 229, 0.1) !important;
    }
</style>
@endsection
