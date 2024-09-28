document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('techForm');

    function validateTechnicianForm() {
        let isValid = true;

        // Clear previous errors
        document.querySelectorAll('.text-red-500').forEach(el => el.innerHTML = '');

        // Validate Lastname
        const technician_lastname = document.getElementById('technician_lastname')?.value.trim();
        const technician_lastnameError = document.getElementById('technician_lastnameError');
        if (!technician_lastname.match(/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/)) {
            technician_lastnameError.innerHTML = 'Lastname must start with a capital letter.';
            isValid = false;
        }

        // Validate Firstname
        const technician_firstname = document.getElementById('technician_firstname')?.value.trim();
        const technician_firstnameError = document.getElementById('technician_firstnameError');
        if (!technician_firstname.match(/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/)) {
            technician_firstnameError.innerHTML = 'Firstname must start with a capital letter.';
            isValid = false;
        }

        // Validate Middlename
        const technician_middlename = document.getElementById('technician_middlename')?.value.trim();
        const technician_middlenameError = document.getElementById('technician_middlenameError');
        if (technician_middlename && !technician_middlename.match(/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$|^None$/)) {
            technician_middlenameError.innerHTML = 'Middlename must be a full name or "None".';
            isValid = false;
        }

        // Validate Instructor ID
        const technicianId = document.getElementById('technician_id')?.value.trim();
        const technicianIdError = document.getElementById('technicianIdError');
        if (!technicianId) {
            technicianIdError.innerHTML = 'Technician ID is required.';
            isValid = false;
        }

        // Validate Voice Recording
        const voiceTechRecording = document.getElementById('voice_data')?.value.trim(); // Corrected ID reference
        const voiceTechRecordingError = document.getElementById('voiceTechRecordingError');
        if (!voiceTechRecording) {
            voiceTechRecordingError.innerHTML = 'Voice recording is required.';
            isValid = false;
        }

        return isValid;
    }

    window.showTechnicianConfirmationModal = function() {
        if (validateTechnicianForm()) {
            document.getElementById('technicianConfirmationModal').classList.remove('hidden');
        }
    }

    window.hideTechnicianConfirmationModal = function() {
        document.getElementById('technicianConfirmationModal').classList.add('hidden');
    }

    window.submitTechnicianForm = function() {
        if (validateTechnicianForm()) {
            const formData = new FormData(form);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
            fetch('/technician', {
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
                    document.getElementById('technicianSuccessMessage').innerHTML = data.message;
                    document.getElementById('technicianSuccessMessage').classList.remove('hidden');
                    form.reset();
                    hideTechnicianConfirmationModal();
    
                    // Reset voice recording elements
                    const audioPlayback = document.getElementById('audio_playback');
                    audioPlayback.src = ''; // Clear the audio source
                    const voiceDataInput = document.getElementById('voice_data');
                    voiceDataInput.value = ''; // Clear the hidden voice data input
    
                    // Reset buttons
                    document.getElementById('start_recording').disabled = false;
                    document.getElementById('stop_recording').disabled = true;
                    document.getElementById('reset_recording').disabled = true;
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
