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
    <div class="content mx-auto max-w-screen-lg py-8 px-4 md:py-24 md:px-0">
        <h2 class="text-center text-3xl font-bold mb-8">Make an appointment</h2>
        <div class="flex flex-col md:flex-row gap-6">
            <div class="calendar-container bg-white shadow-lg overflow-hidden w-full md:w-80 md:max-w-xs lg:max-w-sm xl:w-1/2 xl:max-w-md">
                <header class="bg-purple-600 text-white py-4 text-center">
                    <div class="flex justify-between items-center px-4">
                        <button id="prev-month" class="text-xl">&lt;</button>
                        <span id="month-year" class="text-xl font-bold"></span>
                        <button id="next-month" class="text-xl">&gt;</button>
                    </div>
                </header>
                <div class="grid grid-cols-7 gap-2 p-2">
                    <div class="day text-center py-2 font-bold">Sun</div>
                    <div class="day text-center py-2 font-bold">Mon</div>
                    <div class="day text-center py-2 font-bold">Tue</div>
                    <div class="day text-center py-2 font-bold">Wed</div>
                    <div class="day text-center py-2 font-bold">Thu</div>
                    <div class="day text-center py-2 font-bold">Fri</div>
                    <div class="day text-center py-2 font-bold">Sat</div>
                </div>
                <div id="dates" class="dates grid grid-cols-7 gap-2 p-2"></div>
            </div>

            <div id="appointment-form" class="bg-white shadow-lg p-6 rounded-lg w-full md:w-1/2 lg:w-2/3 xl:w-1/2">
                <h3 class="text-xl font-bold mb-4 text-center">Book Appointment</h3>
                <div id="form-messages" class="form-messages text-red-500 font-bold mb-4"></div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-control">
                        <input type="text" id="student_id" placeholder="Student ID" class="input-field border-2 border-gray-300 rounded-md p-2 w-full">
                        <div class="error-message text-red-500"></div>
                    </div>
                    <div class="form-control">
                        <input type="text" id="firstname" placeholder="Firstname" class="input-field border-2 border-gray-300 rounded-md p-2 w-full">
                        <div class="error-message text-red-500"></div>
                    </div>
                    <div class="form-control">
                        <input type="text" id="lastname" placeholder="Lastname" class="input-field border-2 border-gray-300 rounded-md p-2 w-full">
                        <div class="error-message text-red-500"></div>
                    </div>
                    <div class="form-control">
                        <input type="text" id="middlename" placeholder="Middlename" class="input-field border-2 border-gray-300 rounded-md p-2 w-full">
                        <div class="error-message text-red-500"></div>
                    </div>
                    <div class="form-control">
                        <select id="course" class="input-field border-2 border-gray-300 rounded-md p-2 w-full bg-white appearance-none">
                            <option value="" disabled selected hidden>Course</option>
                            <option value="BSIT">BSIT</option>
                            <option value="BSCS">BSCS</option>
                            <option value="BSIS">BSIS</option>
                            <option value="BLIS">BLIS</option>
                        </select>
                        <div class="error-message text-red-500"></div>
                    </div>
                    <div class="form-control">
                        <input type="text" id="year_section" placeholder="Year and Section" class="input-field border-2 border-gray-300 rounded-md p-2 w-full">
                        <div class="error-message text-red-500"></div>
                    </div>
                    <div class="form-control">
                        <select id="start_time" class="input-field border-2 border-gray-300 rounded-md p-2 w-full bg-white appearance-none">
                            <option value="" disabled selected hidden>Start Time</option>
                        </select>
                        <div class="error-message text-red-500"></div>
                    </div>
                    <div class="form-control">
                        <select id="end_time" class="input-field border-2 border-gray-300 rounded-md p-2 w-full bg-white appearance-none">
                            <option value="" disabled selected hidden>End Time</option>
                        </select>
                        <div class="error-message text-red-500"></div>
                    </div>
                    <div class="form-control col-span-2">
                        <input type="date" id="appointment_date" placeholder="Appointment Date" readonly class="input-field border-2 border-gray-300 rounded-md p-2 w-full">
                        <div class="error-message text-red-500"></div>
                    </div>
                </div>
                <div class="form-buttons flex flex-col md:flex-row gap-4 justify-center mt-4">
                    <button id="book-appointment" class="bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-600 transition-all duration-200 w-full md:w-auto">Book Appointment</button>
                    <button id="back-button" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 transition-all duration-200 w-full md:w-auto mt-2 md:mt-0">Back</button>
                </div>
            </div>
        </div>
    </div>

    <div id="alert-container" class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gray-900 border border-gray-300 p-4 rounded-lg shadow-lg w-full md:w-auto max-w-sm text-center text-white z-50">
        <div id="alert-message">
            <div id="alert-text"></div>
            <div id="ok-button-container">
                <button id="ok-button" class="ok-button bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-all duration-200">OK</button>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/calendar.js') }}"></script>
</body>

</html>
