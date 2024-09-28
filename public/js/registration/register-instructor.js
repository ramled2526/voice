document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('instForm');

    function validateInstructorForm() {
        let isValid = true;

        // Clear previous errors
        document.querySelectorAll('.text-red-500').forEach(el => el.innerHTML = '');

        // Validate Lastname
        const instructor_lastname = document.getElementById('instructor_lastname')?.value.trim();
        const instructor_lastnameError = document.getElementById('instructor_lastnameError');
        if (!instructor_lastname.match(/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/)) {
            instructor_lastnameError.innerHTML = 'Lastname must start with a capital letter.';
            isValid = false;
        }

        // Validate Firstname
        const instructor_firstname = document.getElementById('instructor_firstname')?.value.trim();
        const instructor_firstnameError = document.getElementById('instructor_firstnameError');
        if (!instructor_firstname.match(/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/)) {
            instructor_firstnameError.innerHTML = 'Firstname must start with a capital letter.';
            isValid = false;
        }

        // Validate Middlename
        const instructor_middlename = document.getElementById('instructor_middlename')?.value.trim();
        const instructor_middlenameError = document.getElementById('instructor_middlenameError');
        if (instructor_middlename && !instructor_middlename.match(/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$|^None$/)) {
            instructor_middlenameError.innerHTML = 'Middlename must be a full name or "None".';
            isValid = false;
        }

        // Validate Instructor ID
        const instructorId = document.getElementById('instructor_id')?.value.trim();
        const instructorIdError = document.getElementById('instructorIdError');
        if (!instructorId) {
            instructorIdError.innerHTML = 'Instructor ID is required.';
            isValid = false;
        }

        // Validate Voice Recording
        const voiceRecording = document.getElementById('voice-data')?.value.trim(); // Corrected ID reference
        const voiceRecordingError = document.getElementById('voiceRecordingError');
        if (!voiceRecording) {
            voiceRecordingError.innerHTML = 'Voice recording is required.';
            isValid = false;
        }

        return isValid;
    }

    window.showInstructorConfirmationModal = function() {
        if (validateInstructorForm()) {
            document.getElementById('instructorConfirmationModal').classList.remove('hidden');
        }
    }

    window.hideInstructorConfirmationModal = function() {
        document.getElementById('instructorConfirmationModal').classList.add('hidden');
    }

    window.submitInstructorForm = function() {
        if (validateInstructorForm()) {
            const formData = new FormData(form);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
            fetch('/instructor', {
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
                    document.getElementById('instructorSuccessMessage').innerHTML = data.message;
                    document.getElementById('instructorSuccessMessage').classList.remove('hidden');
                    form.reset();
                    hideInstructorConfirmationModal();
    
                    // Reset voice recording elements
                    const audioPlayback = document.getElementById('audio-playback');
                    audioPlayback.src = ''; // Clear the audio source
                    const voiceDataInput = document.getElementById('voice-data');
                    voiceDataInput.value = ''; // Clear the hidden voice data input
    
                    // Reset buttons
                    document.getElementById('start-recording').disabled = false;
                    document.getElementById('stop-recording').disabled = true;
                    document.getElementById('reset-recording').disabled = true;
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
