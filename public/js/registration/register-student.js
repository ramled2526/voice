document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');

    // Client-side validation function
    function validateForm() {
        let isValid = true;

        // Clear previous errors
        document.querySelectorAll('.text-red-500').forEach(el => el.innerHTML = '');

        // Validate Lastname
        const lastname = document.getElementById('student_lastname').value.trim();
        const lastnameError = document.getElementById('lastnameError');
        if (!lastname.match(/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/)) {
            lastnameError.innerHTML = 'Lastname must start with a capital letter.';
            isValid = false;
        }

        // Validate Firstname
        const firstname = document.getElementById('student_firstname').value.trim();
        const firstnameError = document.getElementById('firstnameError');
        if (!firstname.match(/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/)) {
            firstnameError.innerHTML = 'Firstname must start with a capital letter.';
            isValid = false;
        }

        // Validate Middlename
        const middlename = document.getElementById('student_middlename').value.trim();
        const middlenameError = document.getElementById('middlenameError');
        if (middlename && !middlename.match(/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$|^None$/)) {
            middlenameError.innerHTML = 'Middlename must be a full name or "None".';
            isValid = false;
        }

        // Validate Student ID
        const studentId = document.getElementById('student_id').value.trim();
        const studentIdError = document.getElementById('studentIdError');
        if (!studentId) {
            studentIdError.innerHTML = 'Student ID is required.';
            isValid = false;
        }
        // Validate Course
        const course = document.getElementById('course').value;
        const courseError = document.getElementById('courseError');
        if (!course) {
            courseError.innerHTML = 'Course is required.';
            isValid = false;
        }

        // Validate Year and Section
        const yearSection = document.getElementById('year_section').value.trim();
        const yearSectionError = document.getElementById('yearSectionError');
        if (!yearSection.match(/^[1-4]-[A-Z]$/)) {
            yearSectionError.innerHTML = 'Year and Section must have this format (e.g., 4-C).';
            isValid = false;
        }

        return isValid;
    }

    window.showConfirmationModal = function() {
        if (validateForm()) {
            document.getElementById('confirmationModal').classList.remove('hidden');
        }
    }

    window.hideConfirmationModal = function() {
        document.getElementById('confirmationModal').classList.add('hidden');
    }

    window.submitRegistrationForm = function() {
        if (validateForm()) {
            const formData = new FormData(form);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/student', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('successMessage').innerHTML = data.message;
                    document.getElementById('successMessage').classList.remove('hidden');
                    form.reset();
                    hideConfirmationModal(); 
                } else {
                    
                    if (data.errors) {
                        for (const [field, messages] of Object.entries(data.errors)) {
                            const errorField = document.getElementById(`${field}Error`);
                            if (errorField) {
                                errorField.innerHTML = messages.join(', '); // Display the error message
                            }
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }
});
