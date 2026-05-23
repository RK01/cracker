@extends('layouts.faculty')

@section('content')

<div class="faculty-main">

<div class="faculty-topbar">
<div class="faculty-topbar-title">
<h4><i class="fas fa-check-circle me-2"></i>Test Results</h4>
<small>Students attempted tests</small>
</div>
</div>

<div class="row mb-4">

<div class="col-md-6">
<div class="stat-card">
<div class="stat-icon primary">
<i class="fas fa-file-alt"></i>
</div>
<div class="stat-content">
<h6>Total Tests</h6>
<p class="stat-value">{{ $totalTests }}</p>
</div>
</div>
</div>

<div class="col-md-6">
<div class="stat-card">
<div class="stat-icon success">
<i class="fas fa-users"></i>
</div>
<div class="stat-content">
<h6>Total Attempts</h6>
<p class="stat-value">{{ $totalAttempts }}</p>
</div>
</div>
</div>

</div>

<div class="form-section">

<h5 class="form-section-title">
<i class="fas fa-list me-2"></i>
Students Results
</h5>

<div class="faculty-table-container">

<table class="table table-hover">

<thead>
<tr>
<th>Test</th>
<th>Student</th>
<th>Total Questions</th>
<th>Score</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>

@forelse($tests as $test)

@if($test->attempts->count()>0)

@foreach($test->attempts as $attempt)

<tr>

<td>{{ $test->title }}</td>

<td>{{ $attempt->user->name ?? 'N/A' }}</td>

<td>{{ $test->question_count }}</td>

<td>
{{ $attempt->total_marks }}/{{ $test->question_count }}
</td>

<td>
<span class="badge bg-success">
{{ ucfirst($attempt->status) }}
</span>
</td>

<td>

<a href="{{ route('faculty.view.result',$attempt->id) }}"
class="btn btn-sm btn-primary">
View Details
</a>

</td>

</tr>

@endforeach

@endif

@empty

<tr>
<td colspan="6" class="text-center">
No Results Found
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

@endsection