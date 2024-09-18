@extends('layouts.header')

@section('title', 'Admin - Set Availability')

@section('content')
<body class="bg-gray-200 font-sans min-h-screen flex">
    <!-- Main Content -->
    <div class="flex-grow p-6">
        <header class="bg-white shadow p-4 mb-6">
            <h2 class="text-2xl font-bold">Set Appointment Availability</h2>
        </header>
        
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Calendar Container -->
            <div class="calendar-container bg-white shadow-lg overflow-hidden w-full lg:w-2/3">
                <header class="bg-blue-600 text-white py-4 text-center">
                    <div class="flex justify-between items-center px-4">
                        <button id="prev-month" class="text-xl">&lt;</button>
                        <span id="month-year" class="text-xl font-bold"></span>
                        <button id="next-month" class="text-xl">&gt;</button>
                    </div>
                </header>
                <div class="grid grid-cols-7 gap-7 p-2">
                    <div class="day text-center py-4 font-bold">Sun</div>
                    <div class="day text-center py-4 font-bold">Mon</div>
                    <div class="day text-center py-4 font-bold">Tue</div>
                    <div class="day text-center py-4 font-bold">Wed</div>
                    <div class="day text-center py-4 font-bold">Thu</div>
                    <div class="day text-center py-4 font-bold">Fri</div>
                    <div class="day text-center py-4 font-bold">Sat</div>
                </div>
                <div id="dates" class="dates grid grid-cols-7 gap-10 p-2">
                </div>
            </div>

            <!-- Availability Form -->
            <div id="availability-form" class="bg-white shadow-lg p-12 rounded-lg w-full lg:w-1/3">
                <h3 class="text-xl font-bold mb-4 text-center">Set Availability</h3>
                <div id="form-messages" class="form-messages text-red-500 font-bold mb-4">
                    @if(session('success'))
                        <div class="text-green-500">{{ session('success') }}</div>
                    @endif
                </div>

                <!-- Wrapper with Relative Positioning -->
                <div class="relative space-y-8">
                    <div>
                        <input type="date" id="availability_date" name="availability_date" placeholder="Availability Date" readonly class="input-field border-2 border-gray-300 rounded-md p-3 w-full">
                    </div>
                    @include('availability.dropdowns.time-dropdown')
                    <div>
                        <div id="status_display" class="text-center text-lg font-bold text-gray-600 mt-4"></div>
                    </div>
                    <div class="form-buttons flex flex-col md:flex-row gap-4 justify-center mt-4">
                        <button type="button" id="set-available" class="bg-blue-600 text-white py-2 px-3 rounded-md hover:bg-blue-700 transition-all duration-200 w-full md:w-auto">Set Available</button>
                        <button type="button" id="set-unavailable" class="bg-blue-600 text-white py-2 px-3 rounded-md hover:bg-blue-700 transition-all duration-200 w-full md:w-auto">Set Unavailable</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmation-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <p id="confirmation-message" class="text-lg mb-4"></p>
            <div class="flex justify-end space-x-4">
                <button id="confirm-yes" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Yes</button>
                <button id="confirm-no" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">No</button>
            </div>
        </div>
    </div>
    <!-- Success Modal -->
<div id="success-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <p id="success-message" class="text-lg text-center mb-4">Availability saved successfully.</p>
        <div class="flex justify-center">
            <button id="close-success-modal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">OK</button>
        </div>
    </div>
</div>
    <!-- Availability Modal -->
    <div id="availability-modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-4 rounded-lg shadow-lg max-w-4xl">
            <h3 class="text-lg font-semibold mb-4 text-center">Availability Details</h3>
            <form>
                <div class="space-y-3">
                    <div class="flex gap-2 mb-3">
                        <div class="w-1/2">
                            <label for="modal_availability_date" class="block text-gray-700 text-sm">Date:</label>
                            <input type="text" id="modal_availability_date" class="form-input mt-1 block w-full text-sm" readonly>
                        </div>
                        <div class="w-1/2">
                            <label for="modal_available_time" class="block text-gray-700 text-sm">Available Time:</label>
                            <input type="text" id="modal_available_time" class="form-input mt-1 block w-full text-sm" readonly>
                        </div>
                    </div>
                    <div class="flex gap-2 mb-3">
                        <div class="w-1/2">
                            <label for="modal_start_time" class="block text-gray-700 text-sm">Start Time:</label>
                            <input type="text" id="modal_start_time" class="form-input mt-1 block w-full text-sm" readonly>
                        </div>
                        <div class="w-1/2">
                            <label for="modal_end_time" class="block text-gray-700 text-sm">End Time:</label>
                            <input type="text" id="modal_end_time" class="form-input mt-1 block w-full text-sm" readonly>
                        </div>
                    </div>
                    <div class="flex gap-2 mb-3">
                        <div class="w-1/2">
                            <label for="modal_status_display" class="block text-gray-700 text-sm">Status:</label>
                            <input type="text" id="modal_status_display" class="form-input mt-1 block w-full text-sm" readonly>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" id="close-modal" class="bg-blue-600 text-white py-2 px-4 rounded text-sm">Close</button>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection
