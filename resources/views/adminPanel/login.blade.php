<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
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

    <div class="container-xxl mt-4">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="app-brand justify-content-center text-center  my-4">
                            <a href="index.html" class="app-brand-link gap-2">
                                <img src="img/logo.png" alt="" class="app-brand-logo demo" />
                            </a>
                            <h4 class="my-2">Welcome to Sneat! 👋</h4>
                            <p class="mb-4">Please sign-in to your account and start the adventure</p>
                        </div>
                        <!-- /Logo -->

                        <form id="loginForm" action="{{ route('login.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email or Username</label>
                                <input type="hidden" name="role" value="admin_login">
                                <input type="text" class="form-control" id="loginUser" name="login" placeholder="Enter your email or username">
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <a href="{{route('admin.forgot.password')}}">
                                        <small>Forgot Password?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text cursor-pointer">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                    <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">

                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me">
                                    <label class="form-check-label" for="remember-me">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>