<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Competition Cracker')</title>

    <!-- CDNs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/faculty-panel.css')}}">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .bg-soft-success { background-color: #d1e7dd; color: #0f5132; }
        .bg-soft-warning { background-color: #fff3cd; color: #664d03; }
        .bg-soft-danger { background-color: #f8d7da; color: #842029; }
        .dot { height: 10px; width: 10px; border-radius: 50%; display: inline-block; margin-right: 5px; }
        #auto-hide-alert { min-width: 300px; border-radius: 12px; backdrop-filter: blur(5px); animation: slideIn 0.5s ease forwards;}

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: scale(1); }
            to { opacity: 0; transform: scale(0.9); }        
        }
    </style>

</head>

<body>
    @include('partials.student.header')


    @include('partials.student.sidebar')

    <!-- Notification Container -->
    <div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 99999;">
        @if(session('success') || session('error') || $errors->any())
            <div id="auto-hide-alert" class="toast show align-items-center text-white border-0 shadow-lg {{ session('success') ? 'bg-success' : 'bg-danger' }}" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <div class="d-flex align-items-center">
                            <i class="fas {{ session('success') ? 'fa-check-circle' : 'fa-exclamation-circle' }} me-2 fs-5"></i>
                            <div>
                                @if(session('success'))
                                    {{ session('success') }}
                                @elseif(session('error'))
                                    {{ session('error') }}
                                @else
                                    <ul class="mb-0 list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <!-- Progress Bar Timer (Optional but Modern) -->
                <div class="progress" style="height: 3px; background: rgba(255,255,255,0.2);">
                    <div id="toast-progress" class="progress-bar bg-white" style="width: 100%;"></div>
                </div>
            </div>
        @endif
    </div>
    @yield('content')


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    
    @yield('scripts')
</body>

</html>