function confirmDelete() {
    return confirm('Are you sure you want to delete this?');
}

function showEditModal(instructor) {
    document.getElementById('lastname').value = instructor.lastname;
    document.getElementById('firstname').value = instructor.firstname;
    document.getElementById('middlename').value = instructor.middlename;
    document.getElementById('instructor_id').value = instructor.instructor_id;

    document.getElementById('editInstructorForm').action = '/instructor/' + instructor.id;

    new bootstrap.Modal(document.getElementById('editInstructorModal')).show();
}