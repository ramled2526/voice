<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Selection</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-md mx-auto text-center">
        <!-- Logo and Institution Info -->
        <img src="images/ccs-logo.png" alt="Logo" class="mx-auto mb-4 rounded-full w-26 h-26">
        <h4 class="text-2xl font-bold whitespace-nowrap mb-2">College of Computer Studies</h4>
        <p class="text-gray-500 font-bold mb-4">Camarines Sur Polytechnic Colleges</p>
        
        <!-- Register Button -->
        <div class="font-bold grid grid-cols-1 gap-4 mb-6">
            <a href="{{ route('select-user.registration') }}" class="flex items-center justify-center py-3 px-4 bg-yellow-500 text-white shadow-md hover:bg-yellow-600 transition w-full text-base">
                <img src="https://img.icons8.com/ios-filled/20/ffffff/add-user-male.png" alt="Register Icon" class="mr-2">
                <span>Register</span>
            </a>
        </div>
        
        <!-- Admin Login Button -->
        <div class="font-bold button-container mb-6 flex justify-center gap-4">
            <a href="{{ route('admin.login') }}" class="flex items-center justify-center py-3 px-4 bg-yellow-500 text-white shadow-md hover:bg-yellow-600 transition w-full text-base">
                <img src="https://img.icons8.com/ios-filled/20/ffffff/lock.png" alt="Admin Icon" class="mr-2">
                Admin Login
            </a>
        </div>
        
        <a href="{{ route('appoint.booking') }}" class="font-bold flex items-center justify-center mt-4 py-3 px-4 bg-yellow-500 text-white shadow-md hover:bg-yellow-600 transition w-full text-base">
            <img src="https://img.icons8.com/ios-filled/20/ffffff/calendar.png" alt="Calendar Icon" class="mr-2">
            No schedule in open lab? Book here!
        </a>

    </div>
    <script src="{{ asset('js/homepage/script.js') }}"></script>
</body>
</html>
