<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Technician Registration</title>
    <link href="{{ asset('css/labTech.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header class="header text-center py-3 bg-primary text-white d-flex justify-content-start align-items-center px-3">
        <a href="/" class="text-white text-decoration-none">&larr; Back</a>
    </header>
    <div class="container mt-4">
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <h3 class="text-center">Laboratory Technician Registration</h3>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form id="lab-technician-registration-form" action="{{ url('/lab-technician/register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname" required>
                        <label for="lastname">Lastname</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname" required>
                        <label for="firstname">Firstname</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middlename">
                        <label for="middlename">Middlename</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="employee-id" name="employee-id" placeholder="Employee ID" required>
                        <label for="employee-id">Employee ID</label>
                    </div>
                    <div class="mb-3">
                        <label for="voice-recording" class="form-label">Voice Recording</label>
                        <p>Please state your password. For example, your name and birthday.</p>
                        <div class="record-buttons mb-2">
                            <button type="button" id="start-recording" class="btn btn-primary btn-sm">Start Recording</button>
                            <button type="button" id="stop-recording" class="btn btn-secondary btn-sm" disabled>Stop Recording</button>
                        </div>
                        <audio id="audio-playback" controls class="mb-2"></audio>
                        <input type="hidden" id="voice-data" name="voice-data">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/voiceRecorder.js') }}"></script>
</body>
</html>
