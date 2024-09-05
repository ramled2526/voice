@php
    $availableTime = old('available_time');
@endphp

<div>
    <select id="available_time" name="available_time" class="input-field border-2 border-gray-300 rounded-md p-3 w-full bg-white appearance-none focus:outline-none focus:ring-2 focus:ring-purple-600">
        <option value="" disabled selected hidden>Select Available Time</option>
        <option value="whole_day" {{ $availableTime == 'whole_day' ? 'selected' : '' }}>Whole Day</option>
        <option value="24_hours" {{ $availableTime == '24_hours' ? 'selected' : '' }}>24 Hours</option>
    </select>
</div>

<div>
    <select id="start_time" name="start_time" class="input-field border-2 border-gray-300 rounded-md p-3 w-full bg-white appearance-none focus:outline-none focus:ring-2 focus:ring-purple-600">
        <option value="" disabled selected hidden>Start Time</option>
    </select>
</div>

<div>
    <select id="end_time" name="end_time" class="input-field border-2 border-gray-300 rounded-md p-3 w-full bg-white appearance-none focus:outline-none focus:ring-2 focus:ring-purple-600">
        <option value="" disabled selected hidden>End Time</option>
    </select>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const availableTimeSelect = document.getElementById('available_time');
    const startTimeSelect = document.getElementById('start_time');
    const endTimeSelect = document.getElementById('end_time');

    const wholeDayTimes = [
        { value: '08:00', text: '8:00 AM' },
        { value: '09:00', text: '9:00 AM' },
        { value: '10:00', text: '10:00 AM' },
        { value: '11:00', text: '11:00 AM' },
        { value: '12:00', text: '12:00 PM' },
        { value: '13:00', text: '1:00 PM' },
        { value: '14:00', text: '2:00 PM' },
        { value: '15:00', text: '3:00 PM' },
        { value: '16:00', text: '4:00 PM' },
        { value: '17:00', text: '5:00 PM' },
    ];

    const twentyFourHourTimes = [
        { value: '00:00', text: '12:00 AM' },
        { value: '01:00', text: '1:00 AM' },
        { value: '02:00', text: '2:00 AM' },
        { value: '03:00', text: '3:00 AM' },
        { value: '04:00', text: '4:00 AM' },
        { value: '05:00', text: '5:00 AM' },
        { value: '06:00', text: '6:00 AM' },
        { value: '07:00', text: '7:00 AM' },
        { value: '08:00', text: '8:00 AM' },
        { value: '09:00', text: '9:00 AM' },
        { value: '10:00', text: '10:00 AM' },
        { value: '11:00', text: '11:00 AM' },
        { value: '12:00', text: '12:00 PM' },
        { value: '13:00', text: '1:00 PM' },
        { value: '14:00', text: '2:00 PM' },
        { value: '15:00', text: '3:00 PM' },
        { value: '16:00', text: '4:00 PM' },
        { value: '17:00', text: '5:00 PM' },
        { value: '18:00', text: '6:00 PM' },
        { value: '19:00', text: '7:00 PM' },
        { value: '20:00', text: '8:00 PM' },
        { value: '21:00', text: '9:00 PM' },
        { value: '22:00', text: '10:00 PM' },
        { value: '23:00', text: '11:00 PM' },
    ];

    function updateTimes() {
        const selectedValue = availableTimeSelect.value;

        let times = [];

        if (selectedValue === 'whole_day') {
            times = wholeDayTimes;
        } else if (selectedValue === '24_hours') {
            times = twentyFourHourTimes;
        }

        updateSelectOptions(startTimeSelect, times);
        updateSelectOptions(endTimeSelect, times);
    }

    function updateSelectOptions(selectElement, options) {
        // Clear existing options
        while (selectElement.options.length > 1) {
            selectElement.remove(1);
        }

        // Add new options
        options.forEach(option => {
            const newOption = document.createElement('option');
            newOption.value = option.value;
            newOption.text = option.text;
            selectElement.add(newOption);
        });
    }

    // Update times on load if there's a pre-selected value
    if (availableTimeSelect.value) {
        updateTimes();
    }

    availableTimeSelect.addEventListener('change', updateTimes);
});
</script>
