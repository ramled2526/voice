<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    @vite('resources/css/tailwind.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header class="bg-gray-100 shadow-md text-center h-14 flex items-center justify-center mb-6 relative">
    <a href="/" class="absolute left-4 text-blue-600 hover:text-white text-lg 
        px-1 py-0 bg-gray-100 hover:bg-blue-600 rounded-md transition duration-300 ease-in-out shadow-sm">
        &larr; 
    </a>
</header>

<div class="container mx-auto mt-14 px-4">
    <div class="flex justify-center">
        <div class="w-full max-w-sm">
            <div class="bg-white border-2 border-blue-100 shadow-2xl rounded-lg p-10 text-center">
                <img src="images/ccs-logo.png" alt="Logo" class="mx-auto mb-6 w-40 h-32 object-contain">
                <h4 class="text-2xl font-bold whitespace-nowrap">College of Computer Studies</h4>
                <p class="text-gray-500 mb-4">Camarines Sur Polytechnic Colleges</p>
                <div class="font-semibold text-lg mb-4">User Login</div>
                <form action="{{ route('view-profile.login') }}" method="POST">
                    @csrf
                    <div class="mb-4 relative">
                        <input type="text" id="username" name="username" class="w-full border border-gray-300 rounded-md py-2 pl-10 pr-3 focus:outline-none focus:border-blue-500" placeholder="Username" required>
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-user text-gray-500"></i>
                        </span>
                    </div>
                    <div class="mb-4 relative">
                        <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md py-2 pl-10 pr-3 focus:outline-none focus:border-blue-500" placeholder="Password" required>
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-lock text-gray-500"></i>
                        </span>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="w-full bg-yellow-600 text-white py-2 rounded-md hover:bg-yellow-700">Log in</button>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc list-inside">
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
<script src="{{ asset('js/') }}"></script>
</body>
</html>
