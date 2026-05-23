@extends('layouts.student')
@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Purchased Courses</h2>
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="bi bi-clock-history"></i> My Purchased Courses</h5>
        </div>
        @if($orders->isEmpty())
            <div class="alert alert-info">Not Purchase any course yet.</div>
        @else
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Batch Name</th>
                            <th>Purchase Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key => $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <strong>{{ $order->course->name }}</strong>
                                <br>
                                <small class="text-muted">{{ $order->course->sub_category }}</small>
                            </td>
                            <td>{{ getCourseSubCategoriesByPurchase($order->course_sub_category_id)->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->purchase_date)->format('d/M/Y') }}</td>
                            <td>
                                @if($order->faculty_id)
                                    <span class="badge bg-success">Faculty Assigned</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending Assignment</span>
                                @endif
                            </td>
                            <td>
                                <a href="" class="btn btn-sm btn-outline-primary">View Content</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
    
</div>

@endsection