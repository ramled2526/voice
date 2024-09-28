<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Calendar</title>
    <link href="{{ asset('css/appoint.css') }}" rel="stylesheet" />
    @vite('resources/css/tailwind.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200 font-sans">
    <div class="flex flex-col min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow text-center h-14 flex items-center justify-center mb-6 relative">
            <!-- Back Button -->
            <a href="/" class="absolute left-4 text-blue-600 hover:text-white text-lg 
                px-1 py-0 bg-gray-100 hover:bg-yellow-600 rounded-md transition duration-300 ease-in-out shadow-sm">
                &larr; 
            </a>
            <h2 class="text-xl font-bold leading-relaxed">Make an Appointment</h2>
        </header>

        <!-- Main Content -->
        <main class="flex-grow flex flex-col items-center py-8 px-4 md:px-8">
            <!-- Calendar Container -->
            <div class="calendar-container bg-white shadow-lg overflow-hidden w-full max-w-4xl lg:max-w-5xl xl:max-w-6xl">
                <header class="bg-yellow-200 text-black py-4 text-center">
                    <div class="flex justify-between items-center px-4">
                        <button id="prev-month" class="text-xl">&lt;</button>
                        <span id="month-year" class="text-xl font-bold"></span>
                        <button id="next-month" class="text-xl">&gt;</button>
                    </div>
                </header>
                <div class="grid grid-cols-7 gap-6 md:gap-16 p-2">
                    <div class="day text-center py-1 md:py-2 font-bold">Sun</div>
                    <div class="day text-center py-1 md:py-2 font-bold">Mon</div>
                    <div class="day text-center py-1 md:py-2 font-bold">Tue</div>
                    <div class="day text-center py-1 md:py-2 font-bold">Wed</div>
                    <div class="day text-center py-1 md:py-2 font-bold">Thu</div>
                    <div class="day text-center py-1 md:py-2 font-bold">Fri</div>
                    <div class="day text-center py-1 md:py-2 font-bold">Sat</div>
                </div>
                <div id="dates" class="dates grid grid-cols-7 gap-6 md:gap-16 p-2"></div>
            </div>
            <!-- Appointment Form -->
            <div id="appointment-form" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
                <div class="bg-white shadow-lg p-6 rounded-lg w-full max-w-lg md:w-3/4 lg:w-1/2 xl:w-1/3">
                    <h3 class="text-xl font-bold mb-4 text-center">Book Appointment</h3>
                    <div id="form-messages" class="form-messages text-red-500 font-bold mb-4"></div>
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div class="form-control">
                                <input type="text" id="student_id" name="student_id" placeholder="Student ID" class="input-field border border-gray-300 rounded-md p-2 w-full text-sm">
                                <div class="error-message text-red-500"></div>
                            </div>
                            <div class="form-control">
                                <input type="text" id="firstname" name="firstname" placeholder="Firstname" class="input-field border border-gray-300 rounded-md p-2 w-full text-sm">
                                <div class="error-message text-red-500"></div>
                            </div>
                            <div class="form-control">
                                <input type="text" id="lastname" name="lastname" placeholder="Lastname" class="input-field border border-gray-300 rounded-md p-2 w-full text-sm">
                                <div class="error-message text-red-500"></div>
                            </div>
                            <div class="form-control">
                                <input type="text" id="middlename" name="middlename" placeholder="Middlename" class="input-field border border-gray-300 rounded-md p-2 w-full text-sm">
                                <div class="error-message text-red-500"></div>
                            </div>
                            <div class="form-control">
                                <select id="course" name="course" class="input-field border border-gray-300 rounded-md p-2 w-full text-sm appearance-none text-gray-500">
                                    <option value="" disabled selected hidden>Course</option>
                                    <option value="BSIT">BSIT</option>
                                    <option value="BSCS">BSCS</option>
                                    <option value="BSIS">BSIS</option>
                                    <option value="BLIS">BLIS</option>
                                </select>
                                <div class="error-message text-red-500"></div>
                            </div>
                            <div class="form-control">
                                <input type="text" id="year_section" name="year_section" placeholder="Year and Section" class="input-field border border-gray-300 rounded-md p-2 w-full text-sm">
                                <div class="error-message text-red-500"></div>
                            </div>
                            <div class="form-control">
                                <select id="start_time" name="start_time" class="input-field border border-gray-300 rounded-md p-2 w-full text-sm bg-white appearance-none text-gray-500">
                                    <option value="" disabled selected hidden>Start Time</option>
                                </select>
                                <div class="error-message text-red-500"></div>
                            </div>
                            <div class="form-control">
                                <select id="end_time" name="end_time" class="input-field border border-gray-300 rounded-md p-2 w-full text-sm bg-white appearance-none text-gray-500">
                                    <option value="" disabled selected hidden>End Time</option>
                                </select>
                                <div class="error-message text-red-500"></div>
                            </div>
                            <div class="form-control col-span-2">
                                <input type="date" id="appointment_date" name="appointment_date" placeholder="Appointment Date" readonly class="input-field border border-gray-300 rounded-md p-2 w-full text-sm">
                                <div class="error-message text-red-500"></div>
                            </div>
                        </div>
                        <div class="form-buttons flex flex-col md:flex-row gap-4 justify-center mt-4">
                            <button type="submit" id="book-appointment" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-all duration-200 w-full md:w-auto text-sm">Book Appointment</button>
                            <button type="button" id="back-button" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-all duration-200 w-full md:w-auto mt-2 md:mt-0 text-sm">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <!-- Confirmation Modal -->
        <div id="alert-modal" class="hidden fixed z-50 inset-0 overflow-y-auto bg-white-600 bg-opacity-95" style="transition: opacity 0.4s;">
            <div class="flex items-center justify-center min-h-screen" style="transition: transform 0.3s;">
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform sm:max-w-lg sm:w-full">
                    <div class="bg-white p-6">
                        <h3 class="text-lg leading-6 font-medium" id="alert-text" style="color: black;">Are you sure you want to book this appointment?</h3>
                        <div id="alert-details" class="mt-2 text-black"></div>
                    </div>
                    <div class="bg-blue-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button id="confirm-button" class="w-full inline-flex justify-center rounded-md border border-white-500 shadow-sm px-4 py-2 bg-black-600 text-base font-medium text-white hover:bg-gray-800 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Confirm
                        </button>
                        <button id="cancel-button" class="mt-3 w-full inline-flex justify-center rounded-md border border-white-500 shadow-sm px-4 py-2 bg-black-600 text-base font-medium text-white hover:bg-gray-800 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Modal -->
        <div id="success-modal" class="modal hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="modal-content bg-white p-6 rounded-lg shadow-lg relative">
                <h2 class="text-2xl font-bold mb-4">Appointment Booked Successfully</h2>
                <p class="mb-4">Note: Please follow your set schedule, when the time starts it expires after 4 hours.</p>
                <div class="flex justify-end">
            <button id="success-ok" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">OK</button>
        </div>
    </div>
</div>
    <script src="{{ asset('js/admin/appointment/appoint.js') }}"></script>
</body>

</html>
