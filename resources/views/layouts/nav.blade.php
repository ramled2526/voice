<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-6 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Right Align -->
    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('admin.login')}}">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
