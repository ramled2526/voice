document.addEventListener('DOMContentLoaded', function () {
    // Students by Course, Year, and Section Chart
    var ctx = document.getElementById('studentsByCourseYearSectionChart').getContext('2d');
    var studentsByCourseYearSectionChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: studentsByCourseYearSectionLabels,
            datasets: [{
                data: studentsByCourseYearSectionData,
                backgroundColor: [
                    '#007bff', '#ffc107', '#28a745', '#17a2b8', '#dc3545', '#fd7e14', '#6610f2', '#6c757d'
                ],
            }]
        }
    });
});
