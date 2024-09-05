
    function showConfirmationModal() {
        document.getElementById('confirmationModal').classList.remove('hidden');
    }

    function hideConfirmationModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
    }

    function submitRegistrationForm() {
        const form = document.getElementById('registrationForm');
        if (form) {
            form.submit();
        } else {
            console.error("Registration form not found.");
        }
    }
    
    function submitInstructorForm() {
        const form = document.getElementById('instructorForm');
        if (form) {
            form.submit();
        } else {
            console.error("Instructor form not found.");
        }
    }
    
    function submitTechnicianForm() {
        const form = document.getElementById('technicianForm');
        if (form) {
            form.submit();
        } else {
            console.error("Technician form not found.");
        }
    }
    