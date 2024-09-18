document.addEventListener('DOMContentLoaded', function() {
    window.showInstructorConfirmationModal = function() {
        document.getElementById('instructorConfirmationModal').classList.remove('hidden');
    }

    window.hideInstructorConfirmationModal = function() {
        document.getElementById('instructorConfirmationModal').classList.add('hidden');
    }

    window.submitInstructorForm = function() {
        const form = document.getElementById('instForm');
        const successMessageDiv = document.getElementById('instSuccessMessage');
        const errorMessageDiv = document.getElementById('instFormErrors'); 

        if (form) {
            const formData = new FormData(form);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const base64AudioData = document.getElementById('voice-data').value; 

            if (base64AudioData) {
                document.getElementById('voice-data').value = base64AudioData; 
            }

            formData.append('lastname', form.lastname.value);
            formData.append('firstname', form.firstname.value);
            formData.append('middlename', form.middlename.value);
            formData.append('instructor_id', form.instructor_id.value);
            formData.append('voice_recording', base64AudioData); 

            fetch('/instructor', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData, // Send the form data directly
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(text);
                    });
                }
                return response.json();
            })
            .then(data => {
                hideInstructorConfirmationModal();
            
                if (data.success) {
                    successMessageDiv.textContent = data.message;
                    successMessageDiv.classList.remove('hidden');
                    errorMessageDiv.classList.add('hidden'); 
            
                    form.reset(); 
                } else if (data.errors) {
                    let errorMessages = '';
                    for (let field in data.errors) {
                        errorMessages += data.errors[field].join(', ') + '\n';
                    }
                    errorMessageDiv.textContent = errorMessages;
                    errorMessageDiv.classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorMessageDiv.textContent = `Error: ${error.message}`;
                errorMessageDiv.classList.remove('hidden');
            });
        }
  } 
});
