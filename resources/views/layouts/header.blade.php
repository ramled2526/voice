<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Voice</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/student/index.css')}}" />
    <link href="{{ asset('css/appoint.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/availability/avail.css')}}" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    @include('layouts.nav')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <div class="flex flex-col justify-center items-center mb-4">
                            <img src="{{ asset('images/ccs-logo.png') }}" alt="Logo" class="h-16 w-auto">
                            <span class="text-3xl font-extrabold mt-2" style="font-family: 'Courier New', Courier, monospace;">Astrazon</span>
                        </div>

                        <a class="nav-link" href="{{ route('admin.dashboard')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsers"
                            aria-expanded="false" aria-controls="collapseUsers">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Registered Users
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseUsers" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('student.index') }}">Students</a>
                                <a class="nav-link" href="{{ route('instructor.index')}}">Instructors</a>
                                <a class="nav-link" href="{{ route('technician.index') }}">Lab Technicians</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAppointments"
                            aria-expanded="false" aria-controls="collapseAppointments">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                            Appointments
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseAppointments" aria-labelledby="headingThree"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('appoint.student') }}">View Appointments</a>
                            </nav>
                        </div>

                         <!-- New Availability Section -->
                         <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAvailability"
                            aria-expanded="false" aria-controls="collapseAvailability">
                            <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                            Availability
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseAvailability" aria-labelledby="headingAvailability"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                             <a class="nav-link" href="{{ route('availability.set')}}">Create Availability</a>
                             <a class="nav-link" href="{{ route('availability.view')}}">View Availability</a>
                            </nav>
                        </div>
                       <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVoucher"
                            aria-expanded="false" aria-controls="collapseVoucher">
                            <div class="sb-nav-link-icon"><i class="fas fa-ticket-alt"></i></div>
                            Voucher
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseVoucher" aria-labelledby="headingVoucher"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('voucher.generate')}}">Generate Code</a>
                                <a class="nav-link" href="{{ route('voucher.index')}}">View Generated Code</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Settings</div>
                        <a class="nav-link" href="{{ route('admin.login') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Your Name
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            @include('layouts.footer')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('template/js/scripts.js') }}"></script>
    <script src="{{ asset('js/admin/operation/crud.js') }}"></script>
    <script src="{{ asset('js/admin/availability/admin-availability.js') }}"></script>
    <script src="{{ asset('template/js/database-simple-demo.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    @yield('scripts')
</body>

</html>
