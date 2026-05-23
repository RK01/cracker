@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        
        <!-- Back Navigation Header -->
        <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-light border rounded-3 mb-2"><i class="bi bi-arrow-left me-1"></i> Back</a>
                <h5 class="fw-bold text-dark mb-0">{{ $test->title }} - Evaluation Tracker</h5>
                <p class="text-muted small mb-0">{{ $test->description ?? 'No specific description compiled.' }}</p>
            </div>
            <span class="badge bg-primary px-3 py-2 font-monospace">{{ $test->duration_minutes }} Minutes Matrix</span>
        </div>

        <h6 class="fw-bold text-secondary mb-3 text-uppercase tracking-wider shadow-xs" style="font-size: 0.8rem;">Student Performance Attempts ({{ $test->attempts->count() }})</h6>
        
        <div class="d-flex flex-column gap-3">
            @forelse($test->attempts as $attempt)
                <div class="border rounded-3 p-3 bg-white shadow-xs">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-light border p-2 text-primary fw-bold d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                #{{ $attempt->user_id }}
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">Student Name : {{ userNameById($attempt->user_id) }}</h6>
                                <span class="text-muted small font-monospace" style="font-size: 0.75rem;">Executed Matrix Log</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <span class="badge bg-success-subtle text-success border border-success px-2.5 py-1.5 rounded-2 font-monospace fw-bold">
                                Score Metrics: {{ $attempt->score }}
                            </span>
                            
                            <!-- YOUR CUSTOM STRATIFIED COLLAPSE TRIGGER BUTTON -->
                            <button class="btn btn-xs btn-outline-primary py-1 px-3 rounded-2 fw-medium" data-bs-toggle="collapse" data-bs-target="#evalDetail{{ $attempt->id }}">
                                Review <i class="bi bi-chevron-down ms-1" style="font-size: 0.75rem;"></i>
                            </button>
                        </div>
                    </div>

                    <!-- YOUR PROVIDED EXACT DROPDOWN PERFORMANCE ARCHITECTURE -->
                    <div class="collapse mt-3" id="evalDetail{{ $attempt->id }}">
                        <div class="p-3 bg-light rounded-3">
                            @forelse($test->questions as $index => $question)
                                @php
                                    $sResp = $attempt->responses->where('question_id', $question->id)->first();
                                    $sOptId = $sResp ? $sResp->option_id : null;
                                @endphp
                                <div class="bg-white p-3 mb-2 rounded-3 border-start border-4 {{ $sOptId ? 'border-primary' : 'border-warning' }} shadow-xs">
                                    <p class="mb-1 small text-dark"><strong>Q{{ $index + 1 }}:</strong> {{ $question->question_text }}</p>
                                    <div class="ps-3 mt-2">
                                        @foreach($question->options as $opt)
                                            <div class="small d-flex align-items-center mb-1.5 {{ ($sOptId == $opt->id) ? ($opt->is_correct ? 'text-success fw-bold' : 'text-danger fw-bold') : ($opt->is_correct ? 'text-success' : 'text-muted') }}">
                                                <i class="bi {{ $opt->is_correct ? 'bi-check-circle-fill text-success' : ($sOptId == $opt->id ? 'bi-x-circle-fill text-danger' : 'bi-circle text-black-50') }} me-2" style="font-size: 0.85rem;"></i>
                                                {{ $opt->option_text }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="text-muted p-2 font-monospace small">No structural evaluation questions parsed inside this test instance.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-4 text-muted border rounded-3 bg-light" style="border-style: dashed !important;">
                    <i class="bi bi-person-x fs-3 text-secondary d-block mb-1"></i>
                    Zero student evaluation logs registered for this test tracking segment.
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection