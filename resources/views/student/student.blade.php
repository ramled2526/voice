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

    <form id="registrationForm">
        @csrf
        <div class="mb-4">
            <input type="text" id="student_lastname" name="student_lastname" placeholder="Lastname" value="{{ old('student_lastname') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 h-10">
            <p id="lastnameError" class="text-red-500 text-xs mt-1"></p>
        </div>

        <div class="mb-4">
            <input type="text" id="student_firstname" name="student_firstname" placeholder="Firstname" value="{{ old('student_firstname') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 h-10">
            <p id="firstnameError" class="text-red-500 text-xs mt-1"></p>
        </div>

        <div class="mb-4">
            <input type="text" id="student_middlename" name="student_middlename" placeholder="Middlename"
                value="{{ old('student_middlename') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 h-10">
            <p id="middlenameError" class="text-red-500 text-xs mt-1"></p>
        </div>
        
        <div class="mb-4">
            <input type="text" id="student_id" name="student_id" placeholder="Student ID"
                value="{{ old('student_id') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 h-10">
            <p id="studentIdError" class="text-red-500 text-xs mt-1"></p>
        </div>

        <div class="mb-4">
            <select id="course" name="course"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 appearance-none h-10">
                <option value="" disabled selected>Course</option>
                <option value="BSIT">Bachelor of Science in Information Technology (BSIT)</option>
                <option value="BSCS">Bachelor of Science in Computer Science (BSCS)</option>
                <option value="BSIS">Bachelor of Science in Information System (BSIS)</option>
                <option value="BLIS">Bachelor of Library and Information Science (BLIS)</option>
            </select>
            <p id="courseError" class="text-red-500 text-xs mt-1"></p>
        </div>

        <div class="mb-6">
            <input type="text" id="year_section" name="year_section" placeholder="Year and Section"
                value="{{ old('year_section') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 h-10">
            <p id="yearSectionError" class="text-red-500 text-xs mt-1"></p>
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
