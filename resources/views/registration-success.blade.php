@extends('layouts.app')
@section('content')
<div class="container py-5 text-center">
    <div class="card shadow p-5">
        <h2 class="text-success">Registration Successful!</h2>
        <p>Welcome, {{ session('username') }}</p>
        <div class="alert alert-info mt-4">
            <strong>Username:</strong> {{ session('username') }} <br>
            <strong>Password:</strong> {{ session('password') }}
        </div>
        <p class="text-muted">Please save these credentials for future login.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Go to Home</a>
    </div>
</div>
@endsection