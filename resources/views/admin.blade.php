<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-1S3oUlqkX+cYd9C0dpny4Oo0xsmJkq84E6AbR1HR/YYzFPwFTt4a/ygtxqzI6NybvjywUzFlSC5kT5K0Ga4wbQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header class="header text-center py-3 bg-primary text-white d-flex justify-content-start align-items-center px-3">
    <a href="/" class="text-white text-decoration-none">&larr; Back</a>
</header>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="login-card text-center">
                <img src="images/ccs-logo.png" alt="Logo" class="img-fluid logo mb-4">
                <h4 class="fw-bold">College of Computer Studies</h4>
                <p class="mb-4">Camarines Sur Polytechnic Colleges</p>
                <div class="login-header">
                    Log in
                </div>
                <div class="login-body">
                    <form action="{{ route('admin-login-submit') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3 position-relative">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                            <span class="position-absolute top-50 translate-middle-y start-0 ms-3">
                                <i class="fas fa-user icon"></i>
                            </span>
                        </div>
                        <div class="form-group mb-3 position-relative">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                            <span class="position-absolute top-50 translate-middle-y start-0 ms-3">
                                <i class="fas fa-lock icon"></i>
                            </span>
                        </div>
                        <div class="form-group mb-3 text-end">
                            <a href="#" class="forgot-password">Forgot Password?</a>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary w-100">Log in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
