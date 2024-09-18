document.getElementById('userType').addEventListener('change', function() {
    var selectedType = this.value;
    var forms = document.querySelectorAll('#studentForm, #instructorForm, #technicianForm');
    
    forms.forEach(function(form) {
        form.classList.add('hidden');
    });
    
    if (selectedType) {
        var selectedForm = document.getElementById(selectedType + 'Form');
        if (selectedForm) {
            selectedForm.classList.remove('hidden');
        }
    }
});
