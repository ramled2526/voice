document.addEventListener("DOMContentLoaded", function () {
    const monthYearDisplay = document.getElementById("month-year");
    const datesContainer = document.getElementById("dates");
    const prevMonthButton = document.getElementById("prev-month");
    const nextMonthButton = document.getElementById("next-month");
    const bookAppointmentButton = document.getElementById("book-appointment");
    const appointmentForm = document.getElementById("appointment-form");
    const appointmentDateInput = document.getElementById("appointment_date");
    const formMessages = document.getElementById("form-messages");
    const alertContainer = document.getElementById("alert-container");
    const alertMessage = document.getElementById("alert-message");
    const backButton = document.getElementById("back-button");

    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    let currentDate = new Date();
    let selectedDateElement = null; // Keep track of the selected date element

    function renderCalendar(date) {
        datesContainer.innerHTML = "";
        const year = date.getFullYear();
        const month = date.getMonth();
        const today = new Date();

        monthYearDisplay.textContent = `${months[month]} ${year}`;

        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
        const lastDateOfLastMonth = new Date(year, month, 0).getDate();

        for (let i = firstDayOfMonth; i > 0; i--) {
            const dateElement = document.createElement("div");
            dateElement.classList.add("date", "other-month", "text-gray-400");
            dateElement.textContent = lastDateOfLastMonth - i + 1;
            datesContainer.appendChild(dateElement);
        }

        for (let i = 1; i <= lastDateOfMonth; i++) {
            const dateElement = document.createElement("div");
            dateElement.classList.add("date");
            if (i === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                dateElement.classList.add("today");
            }
            dateElement.textContent = i;

            dateElement.addEventListener("click", function () {
                const selectedDate = new Date(year, month, i);
                const formattedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
                appointmentDateInput.value = formattedDate;
                appointmentForm.classList.add("active");
                appointmentForm.classList.remove("hidden");
                appointmentDateInput.classList.add("appointment-date-filled");

                if (selectedDateElement) {
                    selectedDateElement.classList.remove("selected");
                }
                dateElement.classList.add("selected");
                selectedDateElement = dateElement;
            });
            datesContainer.appendChild(dateElement);
        }

        const nextDays = 42 - (firstDayOfMonth + lastDateOfMonth);
        for (let i = 1; i <= nextDays; i++) {
            const dateElement = document.createElement("div");
            dateElement.classList.add("date", "other-month", "text-gray-400");
            dateElement.textContent = i;
            datesContainer.appendChild(dateElement);
        }
    }

    prevMonthButton.addEventListener("click", () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate);
    });

    nextMonthButton.addEventListener("click", () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate);
    });

    function populateTimeDropdowns() {
        const startTimeSelect = document.getElementById("start_time");
        const endTimeSelect = document.getElementById("end_time");

        function formatTime(hours) {
            const period = hours >= 12 ? 'PM' : 'AM';
            const adjustedHours = hours % 12 || 12;
            return `${adjustedHours}:00 ${period}`;
        }

        for (let i = 0; i < 24; i++) {
            const timeString = formatTime(i);
            const startOption = document.createElement("option");
            startOption.value = i;
            startOption.textContent = timeString;

            const endOption = document.createElement("option");
            endOption.value = i;
            endOption.textContent = timeString;

            startTimeSelect.appendChild(startOption);
            endTimeSelect.appendChild(endOption);
        }
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

    function showAlert(message) {
        const note = "Note: Please follow your set schedule; when the time start it expires after 4 hours.";
        const alertText = `${message}<br><small>${note}</small>`;
        alertContainer.style.display = 'block';
        alertMessage.innerHTML = `<div id="alert-text">${alertText}</div><button id="ok-button" class="ok-button">OK</button>`;

        // Add event listener to the OK button
        const okButton = document.getElementById("ok-button");
        okButton.addEventListener("click", function () {
            alertContainer.style.display = 'none';
        });
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
        const yearSectionRegex = /^[1-4]-[A-Z]$/;
        return yearSectionRegex.test(yearSection);
    }

    bookAppointmentButton.addEventListener("click", function () {
        clearErrors();

        const studentId = document.getElementById("student_id").value;
        const firstname = document.getElementById("firstname").value;
        const lastname = document.getElementById("lastname").value;
        const middlename = document.getElementById("middlename").value;
        const course = document.getElementById("course").value;
        const yearSection = document.getElementById("year_section").value;
        const startTime = document.getElementById("start_time").value;
        const endTime = document.getElementById("end_time").value;
        const appointmentDate = document.getElementById("appointment_date").value;

        let valid = true;

        if (!studentId) {
            valid = false;
            displayError(document.getElementById("student_id"), "Student ID is required.");
        }
        if (!firstname) {
            valid = false;
            displayError(document.getElementById("firstname"), "Firstname is required.");
        } else if (!validateName(firstname)) {
            valid = false;
            displayError(document.getElementById("firstname"), "Firstname must start with a capital letter followed by lowercase letters.");
        }
        if (!lastname) {
            valid = false;
            displayError(document.getElementById("lastname"), "Lastname is required.");
        } else if (!validateName(lastname)) {
            valid = false;
            displayError(document.getElementById("lastname"), "Lastname must start with a capital letter followed by lowercase letters.");
        }
        if (!middlename) {
            valid = false;
            displayError(document.getElementById("middlename"), "Middlename is required.");
        } else if (middlename !== "None" && !validateName(middlename)) {
            valid = false;
            displayError(document.getElementById("middlename"), "Middlename must start with a capital letter followed by lowercase letters, or be 'None'.");
        }
        if (!course) {
            valid = false;
            displayError(document.getElementById("course"), "Course is required.");
        }
        if (!yearSection) {
            valid = false;
            displayError(document.getElementById("year_section"), "Year and Section is required.");
        } else if (!validateYearSection(yearSection)) {
            valid = false;
            displayError(document.getElementById("year_section"), "Year and Section is required and must be in the format (e.g., 4-C)");
        }
        if (!startTime) {
            valid = false;
            displayError(document.getElementById("start_time"), "Start Time is required.");
        }
        if (!endTime) {
            valid = false;
            displayError(document.getElementById("end_time"), "End Time is required.");
        }
        if (!appointmentDate) {
            valid = false;
            displayError(document.getElementById("appointment_date"), "Appointment Date is required.");
        }

        if (!validateTimeRange(startTime, endTime)) {
            valid = false;
            displayError(document.getElementById("end_time"), "Time range should not exceed 4 hours.");
        }

        if (valid) {
            // Simulate form submission for demonstration purposes
            displayFormMessage("Appointment booked successfully!", "success");
            showAlert("Appointment booked successfully!");

            // Clear the form fields
            document.getElementById("student_id").value = "";
            document.getElementById("firstname").value = "";
            document.getElementById("lastname").value = "";
            document.getElementById("middlename").value = "";
            document.getElementById("course").value = "";
            document.getElementById("year_section").value = "";
            document.getElementById("start_time").value = "";
            document.getElementById("end_time").value = "";
            document.getElementById("appointment_date").value = "";

        } else {
            displayFormMessage("Please fix the errors in the form.", "error");
        }
    });

    populateTimeDropdowns();
    renderCalendar(currentDate);

    backButton.addEventListener("click", function () {
        window.location.href = "/"; 
    });
});
