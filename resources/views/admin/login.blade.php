<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('/css/admin/admin.css') }}" rel="stylesheet">
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
                    <form action="{{ route('admin-login') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3 position-relative">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                            <span class="position-absolute top-50 translate-middle-y start-0 ms-3">
                                <i class="bi bi-person icon"></i> 
                            </span>
                        </div>
                        <div class="form-group mb-3 position-relative">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                            <span class="position-absolute top-50 translate-middle-y start-0 ms-3">
                                <i class="bi bi-lock icon"></i> 
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary w-100">Log in</button>
                        </div>
                    </form>
                    @if ($errors->any())
                        <div class="error-message">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
