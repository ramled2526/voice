@extends('layouts.header')

@section('title', 'Admin - Set Availability')

@section('content')
<body class="bg-gray-200 font-sans">
    <div class="content mx-auto max-w-screen-lg py-8 px-4 md:py-24 md:px-0">
        <h2 class="text-center text-3xl font-bold mb-8">Set Appointment Availability</h2>
        <div class="flex flex-col lg:flex-row gap-6 justify-center items-start">
            <!-- Calendar Container -->
            <div class="calendar-container bg-white shadow-lg overflow-hidden w-full lg:w-1/2 xl:w-5/12">
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

            <!-- Availability Form -->
            <form id="availability-form" class="bg-white shadow-lg p-6 rounded-lg w-full lg:w-1/2 xl:w-5/12" action="{{ route('appoint.set') }}" method="POST">
                @csrf
                <h3 class="text-xl font-bold mb-4 text-center">Set Availability</h3>
                <div id="form-messages" class="form-messages text-red-500 font-bold mb-4"></div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form">
                        <input type="date" id="availability_date" name="date" class="border-2 border-gray-300 rounded-md p-2 w-full" readonly>
                    </div>
                    <div class="form">
                        <select id="day_type" name="day_type" class="input-field border-2 border-gray-300 rounded-md p-2 w-full bg-white appearance-none">
                            <option value="" disabled selected hidden>Select Day Type</option>
                            <option value="full_day">Full Day</option>
                            <option value="half_day">Half Day</option>
                        </select>
                    </div>
                    <div class="form">
                        <select id="start_time" name="start_time" class="input-field border-2 border-gray-300 rounded-md p-2 w-full bg-white appearance-none">
                            <option value="" disabled selected hidden>Start Time</option>
                            @for ($i = 0; $i < 24; $i++)
                                @php
                                    $time = \Carbon\Carbon::createFromTime($i, 0, 0);
                                @endphp
                                <option value="{{ $time->format('H:i') }}">{{ $time->format('g:i A') }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form">
                        <select id="end_time" name="end_time" class="input-field border-2 border-gray-300 rounded-md p-2 w-full bg-white appearance-none">
                            <option value="" disabled selected hidden>End Time</option>
                            @for ($i = 0; $i < 24; $i++)
                                @php
                                    $time = \Carbon\Carbon::createFromTime($i, 0, 0);
                                @endphp
                                <option value="{{ $time->format('H:i') }}">{{ $time->format('g:i A') }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="form-buttons flex flex-col md:flex-row gap-4 justify-center mt-4">
                    <button id="set-available" type="button" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition-all duration-200 w-full md:w-auto">Set Available</button>
                    <button id="set-unavailable" type="button" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition-all duration-200 w-full md:w-auto">Set Unavailable</button>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection

