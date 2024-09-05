document.addEventListener("DOMContentLoaded", function () {
    const monthYearDisplay = document.getElementById("month-year");
    const datesContainer = document.getElementById("dates");
    const prevMonthButton = document.getElementById("prev-month");
    const nextMonthButton = document.getElementById("next-month");
    const bookAppointmentButton = document.getElementById("book-appointment");
    const appointmentForm = document.getElementById("appointment-form");
    const appointmentDateInput = document.getElementById("appointment_date");
    const formMessages = document.getElementById("form-messages");
    const backButton = document.getElementById("back-button");

    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    let currentDate = new Date();
    let selectedDateElement = null;

    const successModal = document.getElementById("success-modal");
    const successCloseButton = document.getElementById("success-close");
    const successOkButton = document.getElementById("success-ok");

    function changeMonth(direction) {
        const day = currentDate.getDate(); 

        currentDate.setDate(1);
        currentDate.setMonth(currentDate.getMonth() + direction);

        const maxDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
        currentDate.setDate(Math.min(day, maxDay));

        renderCalendar(currentDate);
    }

    function showSuccessModal() {
        successModal.classList.remove('hidden');
        appointmentForm.classList.add("hidden");
    }

    function hideSuccessModal() {
        successModal.classList.add('hidden');
    }

    if (successCloseButton) {
        successCloseButton.addEventListener("click", hideSuccessModal);
    }

    if (successOkButton) {
        successOkButton.addEventListener("click", hideSuccessModal);
    }

    function populateTimeDropdowns(availability) {
        const startTimeSelect = document.getElementById("start_time");
        const endTimeSelect = document.getElementById("end_time");

        // Clear existing options
        startTimeSelect.innerHTML = '<option value="">Select Start Time</option>';
        endTimeSelect.innerHTML = '<option value="">Select End Time</option>';

        if (!availability) {
            // If no availability, do not populate the dropdowns
            return;
        }

        const availableTimes = availability.available_time.split(","); // Split the available times by commas
        const startTimeOptions = [];
        const endTimeOptions = [];

        availableTimes.forEach(timeRange => {
            const [start, end] = timeRange.split(" - ");
            if (start && end) { // Ensure both start and end times are present
                const startTimeFormatted = formatTimeForDisplay(start.trim());
                const endTimeFormatted = formatTimeForDisplay(end.trim());

                // Add options for start and end times
                startTimeOptions.push(`<option value="${start.trim()}">${startTimeFormatted}</option>`);
                endTimeOptions.push(`<option value="${end.trim()}">${endTimeFormatted}</option>`);
            }
        });

        // Populate the dropdowns with the available times
        startTimeSelect.innerHTML += startTimeOptions.join('');
        endTimeSelect.innerHTML += endTimeOptions.join('');
    }

      function renderCalendar(date) {
        datesContainer.innerHTML = "";
        const year = date.getFullYear();
        const month = date.getMonth();
        const today = new Date();
    
        monthYearDisplay.textContent = `${months[month]} ${year}`;
    
        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
        const lastDateOfLastMonth = new Date(year, month, 0).getDate();
    
        fetch(`/availability/${year}/${month + 1}`)
            .then(response => response.json())
            .then(data => {
                const availabilityData = data;

                for (let i = firstDayOfMonth; i > 0; i--) {
                    const dateElement = document.createElement("div");
                    dateElement.classList.add("date", "other-month", "text-gray-400");
                    dateElement.textContent = lastDateOfLastMonth - i + 1;
                    datesContainer.appendChild(dateElement);
                }

                for (let i = 1; i <= lastDateOfMonth; i++) {
                    const dateElement = document.createElement("div");
                    dateElement.classList.add("date");
                    const currentDate = new Date(year, month, i);
                    const formattedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;

                    if (currentDate < today && currentDate.toDateString() !== today.toDateString()) {
                        dateElement.classList.add("past-date", "text-gray-400");
                        dateElement.textContent = i;
                    } else {
                        if (i === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                            dateElement.classList.add("today", "text-red-600");
                        }
                        dateElement.textContent = i;

                        const availability = availabilityData.find(avail => avail.availability_date === formattedDate);

                        if (availability) {
                            const availabilityDetails = `
                                <div class="absolute">
                                    <div class="relative sm:left-12 md:left-28 lg:left-24 xl:left-20 flex flex-col items-start bg-red-200 border-t border-gray-200 shadow-md 
                                        p-2 sm:p-1 md:p-2 lg:p-3 xl:p-2 
                                        sm:w-20 md:w-24 lg:w-32 xl:w-32">
                                        <p class="text-xs sm:text-[8px] md:text-[10px] lg:text-[8px] xl:text-[8px]">${availability.available_time}</p>
                                        <p class="text-xs sm:text-[8px] md:text-[10px] lg:text-[8px] xl:text-[8px]">${formatTimeForDisplay(availability.start_time)} - ${formatTimeForDisplay(availability.end_time)}</p>
                                        <p class="text-xs sm:text-[8px] md:text-[10px] lg:text-[8px] xl:text-[8px]">${availability.status}</p>
                                    </div>
                                </div>
                            `;
                            dateElement.innerHTML += availabilityDetails;
                        }

                        dateElement.addEventListener("click", function () {
                            appointmentDateInput.value = formattedDate;

                            appointmentForm.classList.add("active");
                            appointmentForm.classList.remove("hidden");

                            if (selectedDateElement) {
                                selectedDateElement.classList.remove("selected");
                            }
                            dateElement.classList.add("selected");
                            selectedDateElement = dateElement;

                            // Check availability and populate dropdowns accordingly
                            if (availability) {
                                populateTimeDropdowns(availability);
                            } else {
                                populateTimeDropdowns(null); // No availability for this date
                            }
                        });
                    }

                    datesContainer.appendChild(dateElement);
                }

                const nextDays = 42 - (firstDayOfMonth + lastDateOfMonth);
                for (let i = 1; i <= nextDays; i++) {
                    const dateElement = document.createElement("div");
                    dateElement.classList.add("date", "other-month", "text-gray-400");
                    dateElement.textContent = i;
                    datesContainer.appendChild(dateElement);
                }
            })
            .catch(error => console.error('Error fetching calendar data:', error));
    }

    prevMonthButton.addEventListener("click", () => changeMonth(-1));
    nextMonthButton.addEventListener("click", () => changeMonth(1));

    function formatTimeForDisplay(timeString) {
        if (!timeString) return "";
    
        const timeParts = timeString.match(/^(\d{1,2}):(\d{2})(?::(\d{2}))?$/);
        if (timeParts) {
            let hours = parseInt(timeParts[1], 10);
            const minutes = parseInt(timeParts[2], 10);
            const isPM = hours >= 12;
    
            hours = hours % 12 || 12;
    
            return `${hours}:${minutes < 10 ? '0' + minutes : minutes} ${isPM ? 'PM' : 'AM'}`;
        }
    
        return timeString; 
    }    

function displayError(input, message) {
    const formControl = input.parentElement;
    const errorElement = formControl.querySelector('.error-message');
    errorElement.innerText = message;
    formControl.classList.add('error');
}

function clearErrors() {
    formMessages.innerText = '';
    formMessages.className = 'form-messages';
    const errorMessages = appointmentForm.querySelectorAll('.error-message');
    errorMessages.forEach(msg => msg.innerText = '');
    const errorFields = appointmentForm.querySelectorAll('.form-control.error');
    errorFields.forEach(field => field.classList.remove('error'));
}

function displayFormMessage(message, type) {
    formMessages.innerText = message;
    formMessages.className = `form-messages ${type}`;
}

function showAlert(onConfirm, additionalDetails = "") {
    const alertModal = document.getElementById("alert-modal");
    const alertDetails = document.getElementById("alert-details");

    alertDetails.innerHTML = additionalDetails;

    const confirmButton = document.getElementById("confirm-button");
    const cancelButton = document.getElementById("cancel-button");

    function hideAlert() {
        alertModal.classList.remove('visible');

        confirmButton.removeEventListener("click", confirmAction);
        cancelButton.removeEventListener("click", hideAlert);
    }

    function confirmAction() {
        onConfirm();
        hideAlert();
    }

    confirmButton.addEventListener("click", confirmAction);
    cancelButton.addEventListener("click", hideAlert);

    alertModal.classList.add('visible');
}

function validateTimeRange(startTime, endTime) {
    const startHours = parseInt(startTime, 10);
    const endHours = parseInt(endTime, 10);

    const difference = endHours - startHours;

    return difference <= 4;
}

function validateName(name) {
    return /^[A-Z][a-z]+(\s[A-Z][a-z]+)*$/.test(name);
}

function validateYearSection(yearSection) {
    return /^[1-4]-[A-Z]$/.test(yearSection);
}

function confirmBooking(appointmentData) {
    const formattedStartTime = formatTimeForDisplay(appointmentData.start_time);
    const formattedEndTime = formatTimeForDisplay(appointmentData.end_time);

    const appointmentDetails = `
            <p><strong>Date:</strong> ${appointmentData.appointment_date}</p>
            <p><strong>Time:</strong> ${formattedStartTime} to ${formattedEndTime}</p>
        `;

    showAlert(() => {
        bookAppointment(appointmentData);
    }, appointmentDetails);
}

function resetForm() {
    document.querySelectorAll('#appointment-form input, #appointment-form select, #appointment-form textarea').forEach(element => {
        element.value = '';
        element.classList.remove('filled');
    });

    // Clear error and form messages
    clearErrors();
    formMessages.innerText = '';

    // Deselect the previously selected date
    if (selectedDateElement) {
        selectedDateElement.classList.remove('selected');
        selectedDateElement = null;
    }
}

function bookAppointment(data) {
    fetch('/appointment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(data),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Clear the form before showing the success modal
                resetForm();
                // Show the success modal
                showSuccessModal();
                // Re-render the calendar to reflect the new appointments
                renderCalendar(currentDate);
            } else {
                displayFormMessage(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}


bookAppointmentButton.addEventListener("click", function (e) {
    e.preventDefault();
    clearErrors();

    const appointmentData = {
        student_id: document.getElementById("student_id").value,
        firstname: document.getElementById("firstname").value,
        lastname: document.getElementById("lastname").value,
        middlename: document.getElementById("middlename").value,
        course: document.getElementById("course").value,
        year_section: document.getElementById("year_section").value,
        appointment_date: appointmentDateInput.value,
        start_time: document.getElementById("start_time").value,
        end_time: document.getElementById("end_time").value,
        csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };

    let isValid = true;

    if (!appointmentData.appointment_date) {
        displayError(appointmentDateInput, "Please select a date.");
        isValid = false;
    }
    if (!appointmentData.student_id) {
        displayError(document.getElementById("student_id"), "Student ID is required.");
        isValid = false;
    }
    if (!appointmentData.firstname || !validateName(appointmentData.firstname)) {
        displayError(document.getElementById("firstname"), "Please enter a valid first name.");
        isValid = false;
    }
    if (!appointmentData.lastname || !validateName(appointmentData.lastname)) {
        displayError(document.getElementById("lastname"), "Please enter a valid last name.");
        isValid = false;
    }
    if (!appointmentData.year_section || !validateYearSection(appointmentData.year_section)) {
        displayError(document.getElementById("year_section"), "Year and Section should be in the format '4-C'.");
        isValid = false;
    }
    if (!appointmentData.start_time) {
        displayError(document.getElementById("start_time"), "Start time is required.");
        isValid = false;
    }
    if (!appointmentData.end_time) {
        displayError(document.getElementById("end_time"), "End time is required.");
        isValid = false;
    }
    if (!validateTimeRange(appointmentData.start_time, appointmentData.end_time)) {
        displayError(document.getElementById("end_time"), "Time range should not exceed 4 hours.");
        isValid = false;
    }

    if (isValid) {
        confirmBooking(appointmentData);
    }
});

backButton.addEventListener("click", function () {
    appointmentForm.classList.remove("active");
    appointmentForm.classList.add("hidden");
    clearErrors();
});

    renderCalendar(currentDate);
    populateTimeDropdowns();
});
