<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Instructor Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<div id="instructorForm" class="hidden">
    <h2 class="text-2xl font-bold text-center mb-6">Instructor Registration</h2>
    <div id="instFormErrors" class="mb-4"></div>
   
    <div id="instSuccessMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 hidden"></div>
        
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

    <form id="instForm">
        @csrf
        <div class="mb-4">
            <input type="text" id="instructor_lastname" name="lastname" placeholder="Lastname" value="{{ old('lastname') }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('lastname') border-red-500 @enderror h-10">
            @error('lastname')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input type="text" id="instructor_firstname" name="firstname" placeholder="Firstname" value="{{ old('firstname') }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('firstname') border-red-500 @enderror h-10">
            @error('firstname')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input type="text" id="instructor_middlename" name="middlename" placeholder="Middlename" value="{{ old('middlename') }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('middlename') border-red-500 @enderror h-10">
            @error('middlename')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input type="number" id="instructor_id" name="instructor_id" placeholder="Instructor ID" value="{{ old('instructor_id') }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('instructor_id') border-red-500 @enderror h-10">
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
        <button type="button" onclick="showInstructorConfirmationModal()" class="w-full bg-yellow-700 text-white py-2 hover:bg-yellow-800">Register</button>
    </form>
</div>

<div id="instructorConfirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-80">
        <h3 class="text-lg font-semibold mb-4">Confirm Registration</h3>
        <p>Are you sure you want to register?</p>
        <div class="flex justify-end mt-6">
            <button onclick="hideInstructorConfirmationModal()" class="mr-4 px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">No</button>
            <button onclick="submitInstructorForm()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Yes</button>
        </div>
    </div>
</div>
<script src="{{ asset('js/recording/voiceRecorder.js') }}"></script>
<script src="{{ asset('js/registration/register-instructor.js') }}"></script>
</body>
</html>
