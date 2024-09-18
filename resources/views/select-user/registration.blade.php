<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/tailwind.css')
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-md text-center h-14 flex items-center justify-center mb-6 relative">
        <a href="/" class="absolute left-4 text-blue-600 hover:text-white text-lg px-2 py-1 bg-gray-100 hover:bg-blue-600 rounded-md transition duration-300 ease-in-out shadow-sm">
            &larr;
        </a>
    </header>

    <div class="container mx-auto px-4 mt-4">
        <div class="max-w-md mx-auto shadow-lg rounded-lg p-6 border border-gray-300 bg-blue-100">
            <h2 class="text-2xl font-bold text-center mb-6">Choose Your User Type</h2>

            <div class="mb-4">
                <select id="userType" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                    <option value="" selected>Select User Type</option>
                    <option value="student">Student</option>
                    <option value="instructor">Instructor</option>
                    <option value="technician">Laboratory Technician</option>
                </select>
            </div>

            <!-- Form Sections -->
            <div class="mt-4">
                @include('student.student')
                @include('instructor.form')
                @include('technician.form')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/registration/select-user.js') }}"></script>
</body>
</html>
