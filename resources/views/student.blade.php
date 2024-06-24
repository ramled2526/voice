<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('css/student.css') }}" rel="stylesheet">
</head>
<body>
    <header class="header text-center py-3 bg-primary text-white d-flex justify-content-start align-items-center px-3">
        <a href="/" class="text-white text-decoration-none">&larr; Back</a>
    </header>
    <div class="container mt-4">
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <h2 class="text-center">Student Registration</h2>

                <!-- Display the flash message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Display validation error messages -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('reg_students.store') }}" method="POST">
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
                        <input type="text" class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" placeholder="Student ID" value="{{ old('student_id') }}" required>
                        <label for="student_id">Student ID</label>
                        @error('student_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <select class="form-select @error('course') is-invalid @enderror" id="course" name="course" required aria-label="Course">
                            <option value="" disabled {{ old('course') ? '' : 'selected' }}>Course</option>
                            <option value="BSIT" @if (old('course') == 'BSIT') selected @endif>Bachelor of Science in Information Technology (BSIT)</option>
                            <option value="BSCS" @if (old('course') == 'BSCS') selected @endif>Bachelor of Science in Computer Science (BSCS)</option>
                            <option value="BSIS" @if (old('course') == 'BSIS') selected @endif>Bachelor of Science in Information System (BSIS)</option>
                            <option value="BLIS" @if (old('course') == 'BLIS') selected @endif>Bachelor of Library and Information Science (BLIS)</option>
                        </select>
                        @error('course')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control @error('year_section') is-invalid @enderror" id="year_section" name="year_section" placeholder="Year and Section" value="{{ old('year_section') }}" required>
                        <label for="year_section">Year and Section</label>
                        @error('year_section')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/student.js') }}"></script> 
</body>
</html>
