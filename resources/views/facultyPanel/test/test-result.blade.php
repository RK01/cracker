@extends('layouts.faculty')
@section('content')
<div class="faculty-main" id="facultyMain">

    <div class="faculty-topbar">
        <div class="faculty-topbar-title">
            <h4><i class="fas fa-check-circle me-2"></i>Evaluate Tests</h4>
            <small>Review and evaluate student test responses</small>
        </div>
    </div>

    {{-- Top Statistics Cards --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stat-card shadow-sm border-0 d-flex align-items-center p-3 bg-white rounded">
                <div class="stat-icon bg-primary text-white p-3 rounded">
                    <i class="fas fa-file-alt fa-2x"></i>
                </div>
                <div class="stat-content ms-3">
                    <h6 class="text-muted mb-1">Total Tests</h6>
                    <p class="h4 fw-bold mb-0">{{ $stats['totalTests'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card shadow-sm border-0 d-flex align-items-center p-3 bg-white rounded">
                <div class="stat-icon bg-warning text-white p-3 rounded">
                    <i class="fas fa-hourglass-half fa-2x"></i>
                </div>
                <div class="stat-content ms-3">
                    <h6 class="text-muted mb-1">Pending Evaluation</h6>
                    <p class="h4 fw-bold mb-0">{{ $stats['pending'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card shadow-sm border-0 d-flex align-items-center p-3 bg-white rounded">
                <div class="stat-icon bg-success text-white p-3 rounded">
                    <i class="fas fa-check-circle fa-2x"></i>
                </div>
                <div class="stat-content ms-3">
                    <h6 class="text-muted mb-1">Evaluated</h6>
                    <p class="h4 fw-bold mb-0">{{ $stats['evaluated'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="form-section">
                <h5 class="form-section-title"><i class="fas fa-tasks me-2"></i>Pending Tests for Evaluation</h5>

                @forelse($tests as $subcategory)
                <div class="subcategory-header mb-2 p-2 bg-light border-start border-primary border-4 mt-3">
                    <h6 class="mb-0 fw-bold text-primary">{{ $subcategory->name }}</h6>
                </div>

                <table class="table table-hover border">
                    <thead class="table-info">
                        <tr style="font-size: 13px;">
                            <th>Test Name</th>
                            <th>Questions</th>
                            <th>Duration</th>
                            <th>Attempts</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subcategory->test as $test)
                        <tr style="font-size: 14px;">
                            <td><strong>{{ $test->title }}</strong></td>
                            <td>{{ $test->questions->count() }}</td>
                            <td>{{ $test->duration_minutes }} Min</td>
                            <td><span class="badge bg-info text-dark">{{ $test->attempts->count() }} Students</span></td>
                            <td>
                                <div style="font-size: 0.85rem;">
                                {{ \Carbon\Carbon::parse($test->created_at)->format('d M, Y') }}<br>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($test->created_at)->format('h:i A') }}</small>
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-gold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTest{{ $test->id }}">
                                    View Attempts
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5" class="p-0 border-0">
                                <div class="collapse" id="collapseTest{{ $test->id }}">
                                    <div class="p-3 bg-white border rounded mx-2 my-2">
                                        @forelse($test->attempts as $attempt)
                                            @php
                                                $studentCorrect = 0;
                                                $studentWrong = 0;
                                                foreach($test->questions as $q) {
                                                    $resp = $attempt->responses->where('question_id', $q->id)->first();
                                                    if($resp) {
                                                        $q->options->where('id', $resp->option_id)->where('is_correct', 1)->first() ? $studentCorrect++ : $studentWrong++;
                                                    }
                                                }
                                            @endphp

                                            <div class="list-group-item border mb-2 rounded shadow-sm">
                                                <div class="d-flex justify-content-between align-items-center flex-wrap p-2">
                                                    <div>
                                                        <strong>{{ userNameById($attempt->user_id) }}</strong>
                                                        <span class="badge {{ $attempt->status == 'completed' ? 'bg-success' : 'bg-warning' }} ms-1">
                                                            {{ strtoupper($attempt->status) }}
                                                        </span>
                                                        <span style="font-size: 0.85rem;">
                                                            {{ \Carbon\Carbon::parse($attempt->responses[0]->created_at)->format('d M, Y') }}
                                                            <small class="text-muted">{{ \Carbon\Carbon::parse($attempt->responses[0]->created_at)->format('h:i A') }}</small>
                                                        </span>
                                                    </div>
                                                    <div class="small">
                                                        <span class="text-success fw-bold me-2">✔ {{ $studentCorrect }}</span>
                                                        <span class="text-danger fw-bold">✖ {{ $studentWrong }}</span>
                                                    </div>
                                                    <button class="btn btn-xs btn-outline-primary py-0" data-bs-toggle="collapse" data-bs-target="#evalDetail{{ $attempt->id }}">
                                                        Review <i class="fas fa-chevron-down"></i>
                                                    </button>
                                                </div>

                                                <div class="collapse mt-3" id="evalDetail{{ $attempt->id }}">
                                                    <div class="p-2 bg-light rounded">
                                                        @foreach($test->questions as $index => $question)
                                                            @php
                                                                $sResp = $attempt->responses->where('question_id', $question->id)->first();
                                                                $sOptId = $sResp ? $sResp->option_id : null;
                                                            @endphp
                                                            <div class="bg-white p-2 mb-2 rounded border-start border-4 {{ $sOptId ? 'border-primary' : 'border-warning' }}">
                                                                <p class="mb-1 small"><strong>Q{{ $index + 1 }}:</strong> {{ $question->question_text }}</p>
                                                                <div class="ps-3 mt-1">
                                                                    @foreach($question->options as $opt)
                                                                        <div class="x-small d-flex align-items-center mb-1 {{ ($sOptId == $opt->id) ? ($opt->is_correct ? 'text-success fw-bold' : 'text-danger fw-bold') : ($opt->is_correct ? 'text-success' : 'text-muted') }}">
                                                                            <i class="fas {{ $opt->is_correct ? 'fa-check-circle' : ($sOptId == $opt->id ? 'fa-times-circle' : 'fa-circle') }} me-1"></i>
                                                                            {{ $opt->option_text }}
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center py-2 text-muted small">No attempts yet.</div>
                                        @endforelse
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @empty
                <div class="alert alert-info">No tests available.</div>
                @endforelse
            </div>
        </div>

        {{-- Right Side Summary Card --}}
        <div class="col-lg-4">
            <div class="form-section shadow-sm border rounded p-3 bg-white">
                <h5 class="form-section-title border-bottom pb-2 mb-3">
                    <i class="fas fa-chart-bar me-2 text-primary"></i>Evaluation Summary
                </h5>
                <div class="mb-3 p-3 bg-light rounded">
                    <div class="d-flex justify-content-between mb-1"><strong>Total Tests:</strong> <span>{{ $stats['totalTests'] }}</span></div>
                    <div class="d-flex justify-content-between mb-1"><strong>Total Questions:</strong> <span>{{ $stats['totalQuestions'] }}</span></div>
                    <div class="d-flex justify-content-between text-warning"><strong>Pending:</strong> <span>{{ $stats['pending'] }}</span></div>
                </div>

                <div class="mb-2 d-flex justify-content-between small fw-bold">
                    <span>Overall Progress</span>
                    <span>{{ $stats['progress'] }}%</span>
                </div>
                <div class="progress mb-3" style="height:8px;">
                    <div class="progress-bar bg-success" style="width: {{ $stats['progress'] }}%"></div>
                </div>

                {{-- <button class="btn btn-gold w-100 mb-2">Save Progress</button>
                <button class="btn btn-outline-primary w-100">Finalize All Scores</button> --}}
            </div>
        </div>
    </div>
</div>
@endsection