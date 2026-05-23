@extends('layouts.student')
@section('content')
<div class="container py-4">

  <!-- HEADER -->

  <div class="faculty-topbar">
    <div class="faculty-topbar-title">
      <h4><i class="fas fa-video me-2"></i>Available Tests</h4>
      <small>Attempt your online tests</small>
    </div>
  </div>

  <!-- STATS -->
  <div class="row mb-4">

    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center border-0">
        <div class="card-body">
          <i class="bi bi-pencil-square text-danger fs-2"></i>
          <h4 class="mt-2">{{ $tests->count() }}</h4>
          <small>Available Tests</small>
        </div>
      </div>
    </div>

    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center border-0">
        <div class="card-body">
          <i class="bi bi-check-circle text-success fs-2"></i>
          <h4 class="mt-2">{{ $attempts->count() }}</h4>
          <small>Completed</small>
        </div>
      </div>
    </div>

    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center border-0">
        <div class="card-body">
          <i class="bi bi-trophy text-warning fs-2"></i>
          <h4 class="mt-2">
            {{
              $attempts->count()
              ? round($attempts->avg('score') / max($attempts->avg('total'),1) * 100, 1)
              : 0
            }}%
          </h4>
          <small>Avg Score</small>
        </div>
      </div>
    </div>

    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center border-0">
        <div class="card-body">
          <i class="bi bi-graph-up text-info fs-2"></i>
          <h4 class="mt-2">--</h4>
          <small>Rank</small>
        </div>
      </div>
    </div>
  </div>
  <!-- TEST CARDS -->
  <div class="row">
    @forelse($tests as $test)
    @php
    $attempt = $attempts[$test->id] ?? null;
    @endphp
    <div class="col-lg-4 mb-4">
      <div class="card shadow-sm border-1 h-100">
        <div class="card-header d-flex justify-content-between">
          <h5 class="fw-bold">{{ $test->title }}</h5>
          @if($attempt)
          <p class="fw-bold"> <a href="{{route('student.tests.result', $test->id)}}">View Score</a></p>
          @endif
        </div>
        <div class="card-body">

          <p class="text-muted small">{{ Str::limit($test->description, 100) }}</p>
          <p><strong>Duration:</strong> {{ $test->duration_minutes }} min</p>
          <p><strong>Questions:</strong> {{ $test->questions->count() }}</p>
          {{-- SCORE DISPLAY --}}
          

          {{-- BUTTON --}}
          @if($attempt)
          <button class="btn btn-secondary w-100" disabled>
            Already Attempted
          </button>
          @else
          <a href="{{ route('student.tests.show', $test->id) }}" class="btn btn-primary w-100">
            <i class="fas fa-play me-2"></i> Start Test
          </a>
          @endif
        </div>
      </div>
    </div>
    @empty
    <div class="col-12">
      <div class="alert alert-warning">
        No tests available.
      </div>
    </div>
    @endforelse
  </div>
</div>
@endsection