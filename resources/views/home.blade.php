<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Selection</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .icon-selected img {
            filter: brightness(0) saturate(100%) invert(27%) sepia(73%) saturate(3700%) hue-rotate(187deg) brightness(92%) contrast(103%);
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-md mx-auto text-center">
        <h1 class="text-2xl font-semibold mb-6">Please select your role to register</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Student Role -->
            <div class="role flex flex-col items-center p-3 bg-gray-50 rounded-lg shadow-md hover:bg-gray-100 transition cursor-pointer" data-role="student" onclick="selectRole(this)">
                <img src="https://img.icons8.com/ios-filled/80/000000/student-center.png" alt="Student Role" class="mb-2 role-icon">
                <span class="text-sm font-medium">Student</span>
            </div>
            <!-- Instructor Role -->
            <div class="role flex flex-col items-center p-3 bg-gray-50 rounded-lg shadow-md hover:bg-gray-100 transition cursor-pointer" data-role="instructor" onclick="selectRole(this)">
                <img src="https://img.icons8.com/ios-filled/80/000000/teacher.png" alt="Instructor Role" class="mb-2 role-icon">
                <span class="text-sm font-medium">Instructor</span>
            </div>
            <!-- Lab Technician Role -->
            <div class="role flex flex-col items-center p-3 bg-gray-50 rounded-lg shadow-md hover:bg-gray-100 transition cursor-pointer" data-role="technician" onclick="selectRole(this)">
                <img src="https://img.icons8.com/ios-filled/80/000000/staff.png" alt="Lab Technician Role" class="mb-2 role-icon">
                <span class="text-sm font-medium">Lab Technician</span>
            </div>
        </div>
        <!-- Button Container -->
        <div class="button-container mb-4 flex justify-center gap-4">
            <a href="#" class="bg-blue-600 text-white py-2 px-3 rounded-md shadow-md hover:bg-blue-700 transition opacity-50 cursor-not-allowed btn-continue">Continue</a>
            <a href="{{ route('admin.login') }}" class="bg-gray-100 text-blue-600 py-2 px-3 rounded-md shadow-md hover:bg-gray-200 transition">Admin Login</a>
        </div>
        <a href="{{ route('appoint.booking') }}" class="block text-blue-600 text-sm font-medium hover:underline">No schedule in open lab? Book here!</a>
    </div>
    <script src="{{ asset('js/homepage/script.js') }}"></script>
</body>
</html>
