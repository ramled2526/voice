document.addEventListener("DOMContentLoaded", function () {
    const monthYearDisplay = document.getElementById("month-year");
    const datesContainer = document.getElementById("dates");
    const prevMonthButton = document.getElementById("prev-month");
    const nextMonthButton = document.getElementById("next-month");
    const setAvailableButton = document.getElementById("set-available");
    const setUnavailableButton = document.getElementById("set-unavailable");
    const availabilityForm = document.getElementById("availability-form");
    const availabilityDateInput = document.getElementById("availability_date");
    const availableTimeInput = document.getElementById("available_time");
    const startTimeInput = document.getElementById("start_time");
    const endTimeInput = document.getElementById("end_time");
    const statusDisplay = document.getElementById("status_display");
    const formMessages = document.getElementById("form-messages");
    
    const closeModalButton = document.getElementById("close-modal");
    const confirmationModal = document.getElementById("confirmation-modal");
    const confirmationMessage = document.getElementById("confirmation-message");
    const confirmYesButton = document.getElementById("confirm-yes");
    const confirmNoButton = document.getElementById("confirm-no");

    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    let currentDate = new Date();
    let selectedDateElement = null;
    let previousDateElement = null;

    function renderCalendar(date) {
        datesContainer.innerHTML = "";
        const year = date.getFullYear();
        const month = date.getMonth();
        const today = new Date();
        today.setHours(0, 0, 0, 0); 
    
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
            dateElement.classList.add("date", "relative");
    
            const currentDate = new Date(year, month, i);
            if (i === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                dateElement.classList.add("today");
            }
    
            dateElement.textContent = i;
    
            // Check if the date is today or in the future
            if (currentDate >= today) {
                dateElement.addEventListener("click", function () {
                    const formattedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
                    availabilityDateInput.value = formattedDate;
                    availabilityForm.classList.add("active");
                    availabilityForm.classList.remove("hidden");
    
                    clearPreviousNoDataMessage();
    
                    if (selectedDateElement) {
                        selectedDateElement.classList.remove("selected");
                        selectedDateElement.style.backgroundColor = "";
                    }
                    dateElement.classList.add("selected");
                    selectedDateElement = dateElement;
    
                    fetchAvailabilityData(formattedDate);
                });
            } else {
                dateElement.classList.add("text-gray-400", "cursor-not-allowed");
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
    }    

    function fetchAvailabilityData(date) {
        console.log('Fetching data for date:', date);
        fetch(`/availability/${date}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Data received:', data);
                if (data.success && data.availability) {
                    clearPreviousNoDataMessage();
                    console.log('Availability data found:', data.availability);
                    populateModalFields(data.availability);
                    showModal();
                } else {
                    console.log('No availability data found.');
                    clearModalFields();
                    displayNoDataMessage(selectedDateElement);
                }
            })
            .catch(error => {
                console.error("Error fetching availability data:", error);
                displayFormMessage("Error fetching availability data.", "error");
            });
    }

    function displayNoDataMessage(selectedDateElement) {
        if (!selectedDateElement) {
            console.error('selectedDateElement is undefined or null.');
            return;
        }

        let messageElement = selectedDateElement.querySelector('.no-data-message');
        if (!messageElement) {
            messageElement = document.createElement("span");
            messageElement.classList.add(
                "no-data-message",
                "absolute",
                "w-full",
                "h-full",
                "flex",
                "items-center",
                "justify-center",
                "bg-black",
                "text-white",
                "font-bold",
                "pointer-events-none",
                "rounded-lg",
                "text-center",
                "border",
                "border-gray-300",
                "shadow-lg",
                "box-border",
                "p-10"
            );

            messageElement.style.fontSize = "10px";
            messageElement.innerHTML = "No availability<br>data found for this date.";
            selectedDateElement.style.position = "relative";
            selectedDateElement.appendChild(messageElement);
        }

        previousDateElement = selectedDateElement;
    }

    function clearPreviousNoDataMessage() {
        if (previousDateElement) {
            let previousMessageElement = previousDateElement.querySelector('.no-data-message');
            if (previousMessageElement) {
                previousMessageElement.remove();
            }
        }
    }

    function populateModalFields(availability) {
        document.getElementById("modal_availability_date").value = availability.availability_date;
        document.getElementById("modal_available_time").value = availability.available_time;
        document.getElementById("modal_start_time").value = formatTimeForDisplay(availability.start_time);
        document.getElementById("modal_end_time").value = formatTimeForDisplay(availability.end_time);
        document.getElementById("modal_status_display").value = availability.status;
    }

    function clearModalFields() {
        document.getElementById("modal_availability_date").value = "";
        document.getElementById("modal_available_time").value = "";
        document.getElementById("modal_start_time").value = "";
        document.getElementById("modal_end_time").value = "";
        document.getElementById("modal_status_display").value = "";
    }

    function showModal() {
        const modal = document.getElementById("availability-modal");
        if (modal) {
            modal.classList.remove("hidden");
        } else {
            console.error("Modal element not found");
        }
    }

    function hideModal() {
        document.getElementById("availability-modal").classList.add("hidden");
    }

    if (closeModalButton) {
        closeModalButton.addEventListener("click", hideModal);
    } else {
        console.error('Close modal button not found');
    }

    if (prevMonthButton) {
        prevMonthButton.addEventListener("click", () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar(currentDate);
        });
    }

    if (nextMonthButton) {
        nextMonthButton.addEventListener("click", () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar(currentDate);
        });
    }

    setAvailableButton.addEventListener("click", () => {
        statusDisplay.value = "available";
        displayFormMessage("Status set to available.", "success");
        availabilityForm.dispatchEvent(new Event('submit', { 'bubbles': true, 'cancelable': true }));
    });

    setUnavailableButton.addEventListener("click", () => {
        statusDisplay.value = "unavailable";
        displayFormMessage("Status set to unavailable.", "success");
        availabilityForm.dispatchEvent(new Event('submit', { 'bubbles': true, 'cancelable': true }));
    });

    function displayError(input, message) {
        const formControl = input.parentElement;
        let errorElement = formControl.querySelector('.error-message');

        if (!errorElement) {
            errorElement = document.createElement('span');
            errorElement.classList.add('error-message');
            formControl.appendChild(errorElement);
        }

        errorElement.innerText = message;
        formControl.classList.add('error');
    }

    function clearErrors() {
        formMessages.innerText = '';
        formMessages.className = 'form-messages';
        const errorMessages = availabilityForm.querySelectorAll('.error-message');
        errorMessages.forEach(msg => msg.innerText = '');
        const errorFields = availabilityForm.querySelectorAll('.form-control.error');
        errorFields.forEach(field => field.classList.remove('error'));
    }

    function displayFormMessage(message, type) {
        formMessages.innerText = message;
        formMessages.className = 'form-messages';
    
        if (type === "success") {
            formMessages.classList.add("bg-green-100", "text-green-700", "border", "border-green-300", "p-2", "rounded-lg", "mb-4");
            formMessages.style.backgroundColor = "#DFF6DD"; 
        } else if (type === "error") {
            formMessages.classList.add("bg-red-100", "text-red-700", "border", "border-red-300", "p-2", "rounded-lg", "mb-4");
            formMessages.style.backgroundColor = "#FEE2E2"; 
        }
    }    

    function formatTimeForDisplay(timeString) {
        if (!timeString) return ""; 
    
        const timeParts = timeString.match(/^(\d{1,2}):(\d{2})(?::(\d{2}))?$/);
        if (timeParts) {
            const hours = parseInt(timeParts[1], 10);
            const minutes = parseInt(timeParts[2], 10);
            const isPM = hours >= 12;
            const formattedHours = isPM ? hours - 12 : hours;
            const formattedTime = `${formattedHours === 0 ? 12 : formattedHours}:${minutes < 10 ? '0' + minutes : minutes} ${isPM ? 'PM' : 'AM'}`;
            return formattedTime;
        } else {
            return timeString;
        }
    }    

    availabilityForm.addEventListener("submit", function (event) {
        event.preventDefault();
        clearErrors();
    
        const availabilityDate = availabilityDateInput.value.trim();
        const availableTime = availableTimeInput.value.trim();
        const startTime = startTimeInput.value.trim();
        const endTime = endTimeInput.value.trim();
        const status = statusDisplay.value.trim();
    
        let isValid = true;
    
        if (!availabilityDate) {
            displayError(availabilityDateInput, "Please select a date.");
            isValid = false;
        }
        if (!availableTime) {
            displayError(availableTimeInput, "Please select available time.");
            isValid = false;
        }
        if (!startTime) {
            displayError(startTimeInput, "Please select start time.");
            isValid = false;
        }
        if (!endTime) {
            displayError(endTimeInput, "Please select end time.");
            isValid = false;
        }
    
        if (isValid) {
            const formData = new FormData();
            formData.append("availability_date", availabilityDate);
            formData.append("available_time", availableTime);
            formData.append("start_time", startTime);
            formData.append("end_time", endTime);
            formData.append("status", status);
    
            confirmationMessage.textContent = `Are you sure you want to set availability to ${status} on ${availabilityDate}?`;
            confirmationModal.classList.remove("hidden");
    
            confirmYesButton.addEventListener("click", () => {
                fetch('/availability', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            displayFormMessage("Availability saved successfully.", "success");
                            hideModal();

                            document.getElementById("availability_date").value = "";
                            document.getElementById("available_time").value = "";
                            document.getElementById("start_time").value = "";
                            document.getElementById("end_time").value = "";
                            
                        } else {
                            displayFormMessage("Failed to save availability.", "error");
                        }
                    })
                    .catch(error => {
                        console.error("Error saving availability:", error);
                        displayFormMessage("Error saving availability.", "error");
                    });
    
                confirmationModal.classList.add("hidden");
            });
    
            confirmNoButton.addEventListener("click", () => {
                confirmationModal.classList.add("hidden");
            });
        }
    });    

    renderCalendar(currentDate);
});
