document.addEventListener('DOMContentLoaded', function() {
    window.showTechnicianConfirmationModal = function() {
        document.getElementById('technicianConfirmationModal').classList.remove('hidden');
    }

    window.hideTechnicianConfirmationModal = function() {
        document.getElementById('technicianConfirmationModal').classList.add('hidden');
    }

    window.submitTechnicianForm = function() {
        const form = document.getElementById('techForm');
        const successMessageDiv = document.getElementById('techSuccessMessage');
        const errorMessageDiv = document.getElementById('techFormErrors'); 

        if (form) {
            const formData = new FormData(form);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const base64AudioData = document.getElementById('voice_data').value; 

            if (base64AudioData) {
                document.getElementById('voice_data').value = base64AudioData; 
            }

            formData.append('lastname', form.lastname.value);
            formData.append('firstname', form.firstname.value);
            formData.append('middlename', form.middlename.value);
            formData.append('technician_id', form.technician_id.value);
            formData.append('voice_recording', base64AudioData); 

            fetch('/technician', {
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
                hideTechnicianConfirmationModal();
            
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
