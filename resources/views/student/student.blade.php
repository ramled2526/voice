<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<div id="studentForm" class="hidden">
    <h2 class="text-2xl font-bold text-center mb-6">Student Registration</h2>

    <div id="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 hidden"></div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="registrationForm">
        @csrf
        <div class="mb-4">
            <input type="text" id="student_lastname" name="lastname" placeholder="Lastname" value="{{ old('lastname') }}"
                required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('lastname') border-red-500 @enderror h-10">
            @error('lastname')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input type="text" id="student_firstname" name="firstname" placeholder="Firstname" value="{{ old('firstname') }}"
                required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('firstname') border-red-500 @enderror h-10">
            @error('firstname')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input type="text" id="student_middlename" name="middlename" placeholder="Middlename"
                value="{{ old('middlename') }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('middlename') border-red-500 @enderror h-10">
            @error('middlename')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input type="text" id="student_id" name="student_id" placeholder="Student ID"
                value="{{ old('student_id') }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('student_id') border-red-500 @enderror h-10">
            @error('student_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input type="password" id="password" name="password" placeholder="Password" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror h-10">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <select id="course" name="course" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('course') border-red-500 @enderror appearance-none h-10">
                <option value="" disabled {{ old('course') ? '' : 'selected' }}>Course</option>
                <option value="BSIT" @if (old('course') == 'BSIT') selected @endif>Bachelor of Science in Information Technology (BSIT)</option>
                <option value="BSCS" @if (old('course') == 'BSCS') selected @endif>Bachelor of Science in Computer Science (BSCS)</option>
                <option value="BSIS" @if (old('course') == 'BSIS') selected @endif>Bachelor of Science in Information System (BSIS)</option>
                <option value="BLIS" @if (old('course') == 'BLIS') selected @endif>Bachelor of Library and Information Science (BLIS)</option>
            </select>
            @error('course')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <input type="text" id="year_section" name="year_section" placeholder="Year and Section"
                value="{{ old('year_section') }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('year_section') border-red-500 @enderror h-10">
            @error('year_section')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4 relative">
            <input type="file" id="picture" name="picture" accept="image/*" required
                class="block w-full px-3 py-2 pl-32 border border-gray-300 rounded-md shadow-sm text-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('picture') border-red-500 @enderror">
            <label for="picture" class="absolute inset-y-0 left-3 flex items-center text-gray-500 pointer-events-none">Upload Image</label>
            @error('picture')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <button type="button" onclick="showConfirmationModal()" class="w-full bg-yellow-700 text-white py-2 hover:bg-yellow-800">Register</button>
    </form>
</div>

<div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-80">
        <h3 class="text-lg font-semibold mb-4">Confirm Registration</h3>
        <p>Are you sure you want to register?</p>
        <div class="flex justify-end mt-6">
            <button onclick="hideConfirmationModal()" class="mr-4 px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">No</button>
            <button onclick="submitRegistrationForm()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Yes</button>
        </div>
    </div>
</div>

<script src="{{ asset('js/registration/register-student.js') }}"></script>
</body>
</html>
