<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Registration</title>
    <link href="{{ asset('css/instructor.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header class="header text-center py-3 bg-primary text-white d-flex justify-content-start align-items-center px-3">
        <a href="/" class="text-white text-decoration-none">&larr; Back</a>
    </header>
    <div class="container mt-4">
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <h2 class="text-center">Instructor Registration</h2>
                
                @if (session('success'))
                    <div class="alert alert-success" aria-live="polite">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" aria-live="polite">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('reg_instructor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" placeholder="Lastname" value="{{ old('lastname') }}" required>
                        <label for="lastname">Lastname</label>
                        @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" placeholder="Firstname" value="{{ old('firstname') }}" required>
                        <label for="firstname">Firstname</label>
                        @error('firstname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control @error('middlename') is-invalid @enderror" id="middlename" name="middlename" placeholder="Middlename" value="{{ old('middlename') }}" required>
                        <label for="middlename">Middlename</label>
                        @error('middlename')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control @error('instructor_id') is-invalid @enderror" id="instructor_id" name="instructor_id" placeholder="Instructor ID" value="{{ old('instructor_id') }}" required>
                        <label for="instructor_id">Instructor ID</label>
                        @error('instructor_id')  
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="voice-data" class="form-label">Voice Recording</label>
                        <p class="instructions">Record your voicepass, e.g., your name and birthyear (bermejo2000).</p>
                        <div class="record-buttons mb-2">
                            <button type="button" id="start-recording" class="btn btn-primary btn-sm">Start Recording</button>
                            <button type="button" id="stop-recording" class="btn btn-secondary btn-sm" disabled>Stop Recording</button>
                            <button type="button" id="reset-recording" class="btn btn-danger btn-sm" disabled>Reset Recording</button>
                        </div>
                        <div class="audio-download-container">
                            <audio id="audio-playback" controls class="mb-2"></audio>
                            <div class="download-link-container" id="download-link-container"></div>
                            <div id="audio-feedback"></div> 
                        </div>
                        <input type="hidden" id="voice-data" name="voice_recording_path">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/voiceRecorder.js') }}"></script>
</body>
</html>
