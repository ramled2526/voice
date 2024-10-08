<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Technician Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div id="technicianForm" class="hidden">
        <h2 class="text-2xl font-bold text-center mb-6">Lab Technician Registration</h2>

        <div id="technicianSuccessMessage"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 hidden"></div>

        <form id="techForm">
            @csrf
            <div class="mb-4">
                <input type="text" id="technician_lastname" name="technician_lastname" placeholder="Lastname"
                    value="{{ old('technician_lastname') }}" required
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('technician_lastname') border-red-500 @enderror h-12">
                <p id="technician_lastnameError" class="text-red-500 text-xs mt-1"></p>
            </div>

            <div class="mb-4">
                <input type="text" id="technician_firstname" name="technician_firstname" placeholder="Firstname"
                    value="{{ old('technician_firstname') }}" required
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('technician_firstname') border-red-500 @enderror h-12">
                <p id="technician_firstnameError" class="text-red-500 text-xs mt-1"></p>
            </div>

            <div class="mb-4">
                <input type="text" id="technician_middlename" name="technician_middlename" placeholder="Middlename"
                    value="{{ old('technician_middlename') }}" required
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('technician_middlename') border-red-500 @enderror h-12">
                <p id="technician_middlenameError" class="text-red-500 text-xs mt-1"></p>
            </div>

            <div class="mb-4">
                <input type="number" id="technician_id" name="technician_id" placeholder="Lab Technician ID"
                    value="{{ old('technician_id') }}" required
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('technician_id') border-red-500 @enderror h-12">
                <p id="technicianIdError" class="text-red-500 text-xs mt-1"></p>
            </div>

            <div class="mb-6">
                <label for="voice_data" class="block text-sm font-medium text-gray-700">Voice Recording</label>
                <p class="text-sm text-gray-600">
                    Record your voicepass, e.g., your name and birthyear <span
                        class="text-red-600">(bermejo2000)</span>.
                </p>
                <div class="flex space-x-2 mt-2 mb-4">
                    <button type="button" id="start_recording"
                        class="bg-blue-600 text-white px-3 py-1 text-sm rounded-md hover:bg-blue-700">Start
                        Recording</button>
                    <button type="button" id="stop_recording"
                        class="bg-gray-600 text-white px-3 py-1 text-sm rounded-md hover:bg-gray-700" disabled>Stop
                        Recording</button>
                    <button type="button" id="reset_recording"
                        class="bg-red-600 text-white px-3 py-1 text-sm rounded-md hover:bg-red-700" disabled>Reset
                        Recording</button>
                </div>
                <div class="mt-2">
                    <audio id="audio_playback" controls class="w-full mb-2"></audio>
                    <div class="mt-2" id="download_link_container"></div>
                    <div id="audio-feedback"></div>
                </div>
                <input type="hidden" id="voice_data" name="voice_recording">
                <p id="voiceTechRecordingError" class="text-red-500 text-xs mt-1"></p>
            </div>
            <button type="button" onclick="showTechnicianConfirmationModal()"
                class="w-full bg-yellow-700 text-white py-2 hover:bg-yellow-800">Register</button>
        </form>
    </div>
    <!-- Confirmation Modal -->
    <div id="technicianConfirmationModal"
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-80">
            <h3 class="text-lg font-semibold mb-4">Confirm Registration</h3>
            <p>Are you sure you want to register?</p>
            <div class="flex justify-end mt-6">
                <button onclick="hideTechnicianConfirmationModal()"
                    class="mr-4 px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">No</button>
                <button onclick="submitTechnicianForm()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Yes</button>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/recording/technician-recorder.js') }}"></script>
    <script src="{{ asset('js/registration/register-technician.js') }}"></script>
</body>

</html>