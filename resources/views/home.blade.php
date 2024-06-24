<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Selection</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="role-selection">
        <h1>Please select your role to register</h1>
        <div class="roles">
            <div class="role" data-role="student">
                <img src="https://img.icons8.com/ios-filled/100/000000/student-center.png" alt="Student Role">
                <span>Student</span>
            </div>
            <div class="role" data-role="instructor">
                <img src="https://img.icons8.com/ios-filled/100/000000/teacher.png" alt="Instructor Role">
                <span>Instructor</span>
            </div>
            <div class="role" data-role="lab technician">
                <img src="https://img.icons8.com/ios-filled/100/000000/staff.png" alt="Lab Technician Role">
                <span>Lab Technician</span>
            </div>
        </div>
        <div class="button-container">
            <a href="#" class="btn btn-primary btn-lg btn-continue disabled">Continue</a>
            <a href="{{ route('admin-login') }}" class="admin-login">Admin Login</a> 
        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
