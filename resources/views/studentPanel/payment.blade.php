@extends('layouts.student')
@section('content')
@php
  $amount = (float) str_replace(',', '', $course->price);
  $discount = 0;
  $finalAmount = $amount - $discount;
@endphp
<section class="container py-5">
  <div class="row">
    <!-- LEFT: Course Summary -->
    <div class="col-lg-7">
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h4 class="mb-3 text-primary">Course Summary</h4>
          <div class="d-flex">
            <img src="{{ asset('assets/img/course-ca.jpg') }}" width="120" class="rounded me-3">
            <div>
              <h5>{{ $course->name }}</h5>
              <p class="text-muted mb-1">{{ $course->title }}</p>
              <p class="mb-1">Duration: {{ $course->duration }}</p>
              <p class="mb-0">Batch Size: {{ $course->batch_size }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Includes -->
      <div class="card shadow-sm">
        <div class="card-body">

          <h5 class="mb-3">What’s Included</h5>
          <ul class="list-unstyled">

            @foreach($course->includes as $item)
              <li class="mb-2">
                <i class="bi bi-check-circle text-success"></i> {{ $item }}
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    <!-- RIGHT: Payment Box -->
    <div class="col-lg-5">
      <div class="card shadow-lg border-0">
        <div class="card-body">
          <h4 class="text-primary mb-4">Payment Details</h4>
          <!-- Price -->
           {{$amount}}
          <div class="d-flex justify-content-between mb-2">
            <span>Course Price</span>
            <span>₹{{ number_format($amount) }}</span>
          </div>

          <!-- Discount -->
          <div class="d-flex justify-content-between mb-2">
            <span>Discount</span>
            <span class="text-success">- ₹{{ number_format($discount) }}</span>
          </div>
          <hr>
          <!-- Final -->
          <div class="d-flex justify-content-between mb-3 fw-bold">
            <span>Total Payable</span>
            <span>₹{{ number_format($finalAmount) }}</span>
          </div>
          <!-- Payment Method -->
          <div class="mb-3">
            <label class="form-label">Select Payment Method</label>
            <select class="form-select" name="payment_method">
              <option value="razorpay">Razorpay (UPI / Card / Netbanking)</option>
              <option value="upi">UPI</option>
              <option value="card">Credit / Debit Card</option>
            </select>
          </div>

          <!-- Terms -->
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" required>
            <label class="form-check-label">
              I agree to Terms & Conditions
            </label>
          </div>

          <!-- Pay Button -->
          <form method="POST" action="{{ route('student.courses.buy', encrypt($course->id)) }}">
            @csrf
            <button class="btn btn-success w-100 py-2" @if(hasPurchasedThisCourse($course->id)) disabled @endif>
              <i class="bi bi-lock"></i> Pay ₹{{ number_format($finalAmount) }}
            </button>
          </form>

          <p class="text-muted small text-center mt-3">
            🔒 100% Secure Payment
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection