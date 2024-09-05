// public/js/dashboard-charts.js

document.addEventListener('DOMContentLoaded', function() {
    // Existing Chart: Students by Course, Year, and Section
    var ctx1 = document.getElementById('studentsByCourseYearSectionChart').getContext('2d');
    var studentsByCourseYearSectionChart = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: studentsByCourseYearSectionLabels,
            datasets: [{
                data: studentsByCourseYearSectionData,
                backgroundColor: [
                    '#6c757d', '#17a2b8', '#ffc107', '#28a745', '#007bff', 
                    '#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#fd7e14', 
                    '#20c997', '#6610f2', '#e83e8c', '#dc3545', '#28a745'
                ],
            }]
        },
        options: {
            responsive: true
        }
    });

    // New Chart: Appointments by Course, Year, and Section
    var ctx2 = document.getElementById('appointmentsByCourseYearSectionChart').getContext('2d');
    var appointmentsByCourseYearSectionChart = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: appointmentsByCourseYearSectionLabels,
            datasets: [{
                data: appointmentsByCourseYearSectionData,
                backgroundColor: [
                    '#6c757d', '#17a2b8', '#ffc107', '#28a745', '#007bff', 
                    '#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#fd7e14', 
                    '#20c997', '#6610f2', '#e83e8c', '#dc3545', '#28a745'
                ],
            }]
        },
        options: {
            responsive: true
        }
    });
});
