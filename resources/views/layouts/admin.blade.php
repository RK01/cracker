<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <link rel="stylesheet" href="{{ asset('admin/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css')}}">
    <!-- Inline Utilities Style Override Matrix to Keep Elements Uniform -->
    <style>
        .transition-all { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
        .navbar-nav .dropdown-toggle::after { display: none !important; }
        .hover-bg-light:hover { background-color: #f1f5f9 !important; color: #1e293b !important; }
        .list-group-item-action:hover { background-color: #f8fafc !important; }
        .sidebar-anchor { color: #8a94a6 !important; background-color: transparent; transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); font-size: 0.88rem; border: 1px solid transparent; }
        .sidebar-anchor:hover { background-color: rgba(255, 255, 255, 0.04); color: #07131e !important; border-color: rgba(255, 255, 255, 0.02); }
        .sidebar-anchor:hover .icon-glow { color: #818cf8 !important; filter: drop-shadow(0 0 6px rgba(129, 140, 248, 0.6)); }
        .active-anchor { background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%) !important; color: #ffffff !important; box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35), inset 0 1px 0 rgba(255,255,255,0.2); border-color: rgba(255, 255, 255, 0.1) !important; }
        .active-anchor .icon-glow { color: #ffffff !important; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2)); }
        .logout-anchor { color: #f43f5e !important; background: rgba(244, 63, 94, 0.05); border: 1px solid rgba(244, 63, 94, 0.1); font-size: 0.88rem; transition: all 0.2s ease; }
        .logout-anchor:hover { background: #e11d48 !important; color: #ffffff !important; box-shadow: 0 4px 12px rgba(225, 29, 72, 0.35); border-color: transparent; }
        @keyframes textGlowPulse {
            0% {text-shadow: 0 0 4px rgba(245, 158, 11, 0.2), 0 0 10px rgba(245, 158, 11, 0.1);transform: scale(1);}
            50% {text-shadow: 0 0 12px rgba(245, 158, 11, 0.6), 0 0 20px rgba(245, 158, 11, 0.3); transform: scale(1.2);}
            100% {text-shadow: 0 0 4px rgba(245, 158, 11, 0.2), 0 0 10px rgba(245, 158, 11, 0.1); transform: scale(1);}
        }
        @keyframes entranceExpand {
            0% {letter-spacing: -2px;opacity: 0;filter: blur(4px);}
            100% {letter-spacing: 3px;opacity: 1;filter: blur(0);}
        }
        .brand-logo-subtext {font-family: 'Montserrat', 'Inter', 'Fira Code', monospace;font-weight: 700;text-transform: uppercase;letter-spacing: 3px;animation: entranceExpand 1s cubic-bezier(0.25, 1, 0.5, 1) forwards;display: inline-block;}
        .animated-cracker-node {display: inline-block;animation: textGlowPulse 2.5s infinite ease-in-out;font-weight: 900;background: linear-gradient(135deg, #fbbf24, #f59e0b);-webkit-background-clip: text;-webkit-text-fill-color: transparent;padding-left: 2px;}
        </style>
        @yield('css')

</head>

<body>
    @include('partials.admin.header')
    <main class="content">
        @include('partials.admin.sidebar')
        <!-- Notification Container -->
        @if(session('success') || session('error') || $errors->any())
        @php
        if (session('success')) {
        $toastClass = 'success';
        $toastTitle = 'Action Successful';
        $toastIcon = 'bi-check2-all';
        } elseif (session('error')) {
        $toastClass = 'error';
        $toastTitle = 'System Error';
        $toastIcon = 'bi-exclamation-triangle-fill';
        } else {
        $toastClass = 'error';
        $toastTitle = 'Validation Failed';
        $toastIcon = 'bi-shield-exclamation';
        }
        @endphp

        <div id="trending-toast" class="toast-modern {{ $toastClass }}">
            <div class="toast-content">
                <div class="toast-icon">
                    <i class="bi {{ $toastIcon }}"></i>
                </div>
                <div class="toast-message">
                    <span class="toast-title">{{ $toastTitle }}</span>
                    <span class="toast-desc">
                        @if(session('success'))
                        {{ session('success') }}
                        @elseif(session('error'))
                        {{ session('error') }}
                        @else
                        <!-- Multiple Validation Errors Rendering safely -->
                        <ul class="mb-0 ps-0 list-unstyled" style="gap: 2px; display: flex; flex-direction: column;">
                            @foreach ($errors->all() as $error)
                            <li><i class="bi bi-dot me-0.5"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </span>
                </div>
            </div>
            <button type="button" class="toast-close-btn" onclick="dismissToast()">
                <i class="bi bi-x"></i>
            </button>
            <!-- Dynamic Progress timer bar -->
            <div class="toast-progress"></div>
        </div>
        @endif
        @yield('content')
    </main>
    @yield('model')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('admin/js/custom.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // --- ALERT TOAST INITIALIZER & AUTO-DISMISS ---
            const toast = document.getElementById('trending-toast');
            if (toast) {
                // Subtle trigger delay for beautiful entry physics
                setTimeout(() => {
                    toast.classList.add('show');
                }, 150);

                // Auto trigger exit sequence after exactly 4 seconds
                setTimeout(() => {
                    dismissToast();
                }, 4150); // 150ms delay + 4000ms animation bar lifetime
            }
        });

        // Explicit dismiss handling via action button
        function dismissToast() {
            const toast = document.getElementById('trending-toast');
            if (toast) {
                toast.classList.remove('show');
                // Remove from DOM structural hierarchy once animation completes
                setTimeout(() => {
                    toast.remove();
                }, 400);
            }
        }
    </script>
    @yield('scripts')
</body>

</html>