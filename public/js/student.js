document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('student-registration-form');
    
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);
        const data = Object.fromEntries(formData);

        console.log(data);

    });
});

document.addEventListener('DOMContentLoaded', function() {
    const courseSelect = document.getElementById('course');
    const courseLabel = document.getElementById('courseLabel');

    courseSelect.addEventListener('change', function() {
        if (courseSelect.value) {
            courseLabel.style.display = 'none';
        } else {
            courseLabel.style.display = 'block';
        }
    });
});







