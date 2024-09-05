<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/tailwind.css')
</head>
<body>
<header class="bg-gray-100 shadow-md text-center h-14 flex items-center justify-center mb-6 relative">
    <a href="/" class="absolute left-4 text-blue-600 hover:text-white text-lg 
        px-1 py-0 bg-gray-100 hover:bg-blue-600 rounded-md transition duration-300 ease-in-out shadow-sm">
        &larr; 
    </a>
</header>
    <div class="container mx-auto mt-4 px-4">
        <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6 border border-gray-300 bg-gray-50">
            <h2 class="text-2xl font-bold text-center mb-6">Instructor Registration</h2>
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="instructorForm" action="{{ route('instructor.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <input type="text" id="lastname" name="lastname" placeholder="Lastname" value="{{ old('lastname') }}" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('lastname') border-red-500 @enderror h-14">
                    @error('lastname')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="text" id="firstname" name="firstname" placeholder="Firstname" value="{{ old('firstname') }}" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('firstname') border-red-500 @enderror h-14">
                    @error('firstname')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="text" id="middlename" name="middlename" placeholder="Middlename" value="{{ old('middlename') }}" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('middlename') border-red-500 @enderror h-14">
                    @error('middlename')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="number" id="instructor_id" name="instructor_id" placeholder="Instructor ID" value="{{ old('instructor_id') }}" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('instructor_id') border-red-500 @enderror h-14">
                    @error('instructor_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="voice-data" class="block text-sm font-medium text-gray-700">Voice Recording</label>
                    <p class="text-sm text-gray-600">
                        Record your voicepass, e.g., your name and birthyear <span class="text-red-600">(bermejo2000)</span>.
                    </p>
                    <div class="flex space-x-2 mt-2 mb-4">
                        <button type="button" id="start-recording" class="bg-blue-600 text-white px-3 py-1 text-sm rounded-md hover:bg-blue-700">Start Recording</button>
                        <button type="button" id="stop-recording" class="bg-gray-600 text-white px-3 py-1 text-sm rounded-md hover:bg-gray-700" disabled>Stop Recording</button>
                        <button type="button" id="reset-recording" class="bg-red-600 text-white px-3 py-1 text-sm rounded-md hover:bg-red-700" disabled>Reset Recording</button>
                    </div>
                    <div class="mt-2">
                        <audio id="audio-playback" controls class="w-full mb-2"></audio>
                        <div class="mt-2" id="download-link-container"></div>
                        <div id="audio-feedback"></div> 
                    </div>
                    <input type="hidden" id="voice-data" name="voice_recording">
                </div>
                <button type="button" onclick="showConfirmationModal()" class="w-full bg-blue-400 text-white py-2 hover:bg-blue-500">Register</button>
            </form>
        </div>
    </div>

    <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-80">
        <h3 class="text-lg font-semibold mb-4">Confirm Registration</h3>
        <p>Are you sure you want to register?</p>
        <div class="flex justify-end mt-6">
            <button onclick="hideConfirmationModal()" class="mr-4 px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">No</button>
            <button onclick="submitInstructorForm()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Yes</button>
        </div>
    </div>
</div>
    <script src="{{ asset('js/recording/voiceRecorder.js') }}"></script>
    <script src="{{ asset('js/registration-modal/user/user-modal.js') }}"></script>
</body>
</html>
