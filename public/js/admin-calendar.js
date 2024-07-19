document.addEventListener("DOMContentLoaded", function () {
    const monthYearDisplay = document.getElementById("month-year");
    const datesContainer = document.getElementById("dates");
    const prevMonthButton = document.getElementById("prev-month");
    const nextMonthButton = document.getElementById("next-month");
    const availabilityForm = document.getElementById("availability-form");
    const availabilityDateInput = document.getElementById("availability_date");
    const setAvailableButton = document.getElementById("set-available");
    const setUnavailableButton = document.getElementById("set-unavailable");
    const formMessages = document.getElementById("form-messages");

    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    let currentDate = new Date();
    let selectedDateElement = null;

    function renderCalendar(date) {
        datesContainer.innerHTML = ""; // Clears previous dates
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
            const currentDate = new Date(year, month, i);
            if (i === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                dateElement.classList.add("today");
            }

            dateElement.addEventListener("click", function () {
                const selectedDate = new Date(year, month, i);
                const formattedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
                availabilityDateInput.value = formattedDate;
                availabilityForm.classList.add("active");
                availabilityForm.classList.remove("hidden");

                if (selectedDateElement) {
                    selectedDateElement.classList.remove("selected");
                }
                dateElement.classList.add("selected");
                selectedDateElement = dateElement;
            });

            dateElement.textContent = i;
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

    function sendAvailabilityRequest(available) {
        const date = availabilityDateInput.value;
        if (!date) {
            formMessages.textContent = "Please select a date.";
            return;
        }
    
        fetch("{{ route('appoint.set') }}", {
            method: "POST", 
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({
                date: date,
                start_time: document.getElementById("start_time").value,
                end_time: document.getElementById("end_time").value,
                available: available
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Response data:", data);
            formMessages.textContent = data.message;
        })
        .catch(error => {
            console.error("Error:", error);
        });
    }    

    setAvailableButton.addEventListener("click", () => {
        sendAvailabilityRequest(true);
    });

    setUnavailableButton.addEventListener("click", () => {
        sendAvailabilityRequest(false);
    });

    renderCalendar(currentDate);
});