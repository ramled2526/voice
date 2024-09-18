document.addEventListener('DOMContentLoaded', function() {
    window.showConfirmationModal = function() {
        document.getElementById('confirmationModal').classList.remove('hidden');
    }

    window.hideConfirmationModal = function() {
        document.getElementById('confirmationModal').classList.add('hidden');
    }

    window.submitRegistrationForm = function() {
        const form = document.getElementById('registrationForm');
        const successMessageDiv = document.getElementById('successMessage');

        if (form) {
            const formData = new FormData(form);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/student', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                hideConfirmationModal();
                if (data.success) {
                    // Display the success message
                    successMessageDiv.textContent = 'Student registered successfully.';
                    successMessageDiv.classList.remove('hidden');

                    // Optionally, reset the form fields
                    form.reset();
                } else {
                    // Handle validation errors
                    console.error(data.errors);
                    // Optionally, display errors on the page
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        } else {
            console.error("Registration form not found.");
        }
    }
});
