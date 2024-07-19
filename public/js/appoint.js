let deleteStudentId;

function setDeleteStudent(studentId) {
    deleteStudentId = studentId;
    const form = document.getElementById('deleteStudentForm');
    form.action = `/student/${studentId}`;
}

document.addEventListener('DOMContentLoaded', (event) => {
    const deleteStudentModal = document.getElementById('deleteStudentModal');
    deleteStudentModal.addEventListener('hidden.bs.modal', (event) => {
        deleteStudentId = null;
    });
});

let deleteInstructorId;

function setDeleteInstructor(instructorId) {
    deleteInstructorId = instructorId;
    const form = document.getElementById('deleteInstructorForm');
    form.action = `/instructor/${instructorId}`;
}

document.addEventListener('DOMContentLoaded', (event) => {
    const deleteInstructorModal = document.getElementById('deleteInstructorModal');
    deleteInstructorModal.addEventListener('hidden.bs.modal', (event) => {
        deleteInstructorId = null;
    });
});

let deleteTechnicianId;

function setDeleteTechnician(technicianId) {
    deleteTechnicianId = technicianId;
    const form = document.getElementById('deleteTechnicianForm');
    form.action = `/technician/${technicianId}`;
}

document.addEventListener('DOMContentLoaded', (event) => {
    const deleteTechnicianModal = document.getElementById('deleteTechnicianModal');
    deleteTechnicianModal.addEventListener('hidden.bs.modal', (event) => {
        deleteTechnicianId = null;
    });
});

let deleteAppointId;

function setDeleteAppoint(appointId) {
    deleteAppointId = appointId;
    const form = document.getElementById('deleteAppointForm');
    form.action = `/appoint/${appointId}`;
}

document.addEventListener('DOMContentLoaded', (event) => {
    const deleteAppointModal = document.getElementById('deleteAppointModal');
    deleteAppointModal.addEventListener('hidden.bs.modal', (event) => {
        deleteAppointId = null;
    });
});

function showEditAppointModal(appoint) {
    document.getElementById('student_id').value = appoint.student_id;
    document.getElementById('lastname').value = appoint.lastname;
    document.getElementById('firstname').value = appoint.firstname;
    document.getElementById('middlename').value = appoint.middlename;
    document.getElementById('course').value = appoint.course;
    document.getElementById('year_section').value = appoint.year_section;
    document.getElementById('start_time').value = appoint.start_time;
    document.getElementById('end_time').value = appoint.end_time;
    document.getElementById('appointment_date').value = appoint.appointment_date;

    document.getElementById('editAppointForm').action = '/appoint/' + appoint.id;

    new bootstrap.Modal(document.getElementById('editAppointModal')).show();

}

function showEditStudentModal(student) {

    document.getElementById('lastname').value = student.lastname;
    document.getElementById('firstname').value = student.firstname;
    document.getElementById('middlename').value = student.middlename;
    document.getElementById('student_id').value = student.student_id;
    document.getElementById('course').value = student.course;
    document.getElementById('year_section').value = student.year_section;

    document.getElementById('editStudentForm').action = '/student/' + student.id;

    new bootstrap.Modal(document.getElementById('editStudentModal')).show();
}

function showEditInstructorModal(instructor) {
    document.getElementById('lastname').value = instructor.lastname;
    document.getElementById('firstname').value = instructor.firstname;
    document.getElementById('middlename').value = instructor.middlename;
    document.getElementById('instructor_id').value = instructor.instructor_id;

    document.getElementById('editInstructorForm').action = '/instructor/' + instructor.id;

    new bootstrap.Modal(document.getElementById('editInstructorModal')).show();
}

function showEditTechnicianModal(technician) {
    document.getElementById('lastname').value = technician.lastname;
    document.getElementById('firstname').value = technician.firstname;
    document.getElementById('middlename').value = technician.middlename;
    document.getElementById('technician_id').value = technician.technician_id;

    document.getElementById('editTechnicianForm').action = '/technician/' + technician.id;

    new bootstrap.Modal(document.getElementById('editTechnicianModal')).show();
}