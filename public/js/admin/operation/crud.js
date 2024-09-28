let deleteStudentId, deleteInstructorId, deleteTechnicianId, deleteAppointId, deleteAvailId;

document.addEventListener('DOMContentLoaded', function () {
    // Handle delete student modal
    const deleteStudentModal = document.getElementById('deleteStudentModal');
    if (deleteStudentModal) {
        deleteStudentModal.addEventListener('hidden.bs.modal', function () {
            deleteStudentId = null;
        });
    }

    // Handle delete instructor modal
    const deleteInstructorModal = document.getElementById('deleteInstructorModal');
    if (deleteInstructorModal) {
        deleteInstructorModal.addEventListener('hidden.bs.modal', function () {
            deleteInstructorId = null;
        });
    }

    // Handle delete technician modal
    const deleteTechnicianModal = document.getElementById('deleteTechnicianModal');
    if (deleteTechnicianModal) {
        deleteTechnicianModal.addEventListener('hidden.bs.modal', function () {
            deleteTechnicianId = null;
        });
    }

    // Handle delete appointment modal
    const deleteAppointModal = document.getElementById('deleteAppointModal');
    if (deleteAppointModal) {
        deleteAppointModal.addEventListener('hidden.bs.modal', function () {
            deleteAppointId = null;
        });
    }

    // Handle delete availability modal
    const deleteAvailModal = document.getElementById('deleteAvailModal');
    if (deleteAvailModal) {
        deleteAvailModal.addEventListener('hidden.bs.modal', function () {
            deleteAvailId = null;
        });
    }

    const deleteVoucherModal = document.getElementById('deleteVoucherModal');
    if (deleteVoucherModal) {
        deleteVoucherModal.addEventListener('hidden.bs.modal', function () {
            deleteVoucherId = null;
        });
    }
});

// Set delete functions
function setDeleteStudent(studentId) {
    deleteStudentId = studentId;
    const form = document.getElementById('deleteStudentForm');
    if (form) form.action = `/student/${studentId}`;
}

function setDeleteInstructor(instructorId) {
    deleteInstructorId = instructorId;
    const form = document.getElementById('deleteInstructorForm');
    if (form) form.action = `/instructor/${instructorId}`;
}

function setDeleteTechnician(technicianId) {
    deleteTechnicianId = technicianId;
    const form = document.getElementById('deleteTechnicianForm');
    if (form) form.action = `/technician/${technicianId}`;
}

function setDeleteAppoint(appointId) {
    deleteAppointId = appointId;
    const form = document.getElementById('deleteAppointForm');
    if (form) form.action = `/appoint/${appointId}`;
}

function setDeleteAvail(availId) {
    deleteAvailId = availId;
    const form = document.getElementById('deleteAvailForm');
    if (form) form.action = `/availability/${availId}`;
}

function setDeleteVoucher(voucherId) {
    deleteVoucherId = voucherId;
    const form = document.getElementById('deleteVoucherForm');
    if (form) form.action = `/voucher/${voucherId}`;
}

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

function showEditAvailModal(availability) {
    document.getElementById('availability_date').value = availability.availability_date;
    document.getElementById('available_time').value = availability.available_time;
    document.getElementById('start_time').value = availability.start_time;
    document.getElementById('end_time').value = availability.end_time;
    document.getElementById('status').value = availability.status;

    document.getElementById('editAvailForm').action = '/availability/' + availability.id;

    new bootstrap.Modal(document.getElementById('editAvailModal')).show();

}

function showEditStudentModal(student) {

    document.getElementById('student_lastname').value = student.student_lastname;
    document.getElementById('student_firstname').value = student.student_firstname;
    document.getElementById('student_middlename').value = student.student_middlename;
    document.getElementById('student_id').value = student.student_id;
    document.getElementById('course').value = student.course;
    document.getElementById('year_section').value = student.year_section;

    document.getElementById('editStudentForm').action = '/student/' + student.id;

    new bootstrap.Modal(document.getElementById('editStudentModal')).show();
}

function showEditInstructorModal(instructor) {
    document.getElementById('instructor_lastname').value = instructor.instructor_lastname;
    document.getElementById('instructor_firstname').value = instructor.instructor_firstname;
    document.getElementById('instructor_middlename').value = instructor.instructor_middlename;
    document.getElementById('instructor_id').value = instructor.instructor_id;

    document.getElementById('editInstructorForm').action = '/instructor/' + instructor.id;

    new bootstrap.Modal(document.getElementById('editInstructorModal')).show();
}

function showEditTechnicianModal(technician) {
    document.getElementById('technician_lastname').value = technician.technician_lastname;
    document.getElementById('technician_firstname').value = technician.technician_firstname;
    document.getElementById('technician_middlename').value = technician.technician_middlename;
    document.getElementById('technician_id').value = technician.technician_id;

    document.getElementById('editTechnicianForm').action = '/technician/' + technician.id;

    new bootstrap.Modal(document.getElementById('editTechnicianModal')).show();
}
