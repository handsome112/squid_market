<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-2 d-flex"
    style="border-bottom: 1px solid;">
    <!-- <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
            <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
        </a> -->
    <div class="d-flex align-items-center">
        <a href="#" class="sidebar-toggler d-lg-none flex-shrink-0" style="margin-right:3px">
            <i class="fa fa-bars"></i>
        </a>
        <a href="{{ route('home') }}">
            <div class="d-flex align-items-center"><i class="bi bi-house-fill"
                    style="font-size:28px;margin-right:3px"></i>
                <span style="margin-top:3px" class="backmarket">Back to Market</span>
            </div>
        </a>
    </div>
    <a href="{{ route('home') }}" class="m-auto"><img src="{{ asset('img/logo.png') }}" width="300px" /></a>
    <!-- <div class="navbar-nav" style="margin-right:20px"> -->
    <!-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-envelope me-lg-2"></i>
                    <span class="d-none d-lg-inline-flex">Message</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                    <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <div class="ms-2">
                                <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                <small>15 minutes ago</small>
                            </div>
                        </div>
                    </a>
                    <hr class="dropdown-divider">
                    <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <div class="ms-2">
                                <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                <small>15 minutes ago</small>
                            </div>
                        </div>
                    </a>
                    <hr class="dropdown-divider">
                    <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <div class="ms-2">
                                <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                <small>15 minutes ago</small>
                            </div>
                        </div>
                    </a>
                    <hr class="dropdown-divider">
                    <a href="#" class="dropdown-item text-center">See all message</a>
                </div>
            </div> -->
    <!-- <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bell me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Notificatin</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Profile updated</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">New user added</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Password changed</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all notifications</a>
            </div>
        </div> -->
    <div class="nav-item dropdown" style="margin-right:5px">
        <a href="#" class="nav-link dropdown-toggle" id="dropdown123" data-toggle="dropdown" aria-expanded="false">
            <img class="rounded-circle me-lg-2" src="{{ auth()->user()->avatar }}" alt=""
                style="width: 40px; height: 40px;">
            <span class="d-none d-lg-inline-flex">{{ auth()->user()->username }}</span>
        </a>
        <div class="dropdown-menu bg-secondary border-0 rounded-0 rounded-bottom m-0" aria-labelledby="dropdown123">
            <a href="#" class="dropdown-item">My Profile</a>
            <a href="#" class="dropdown-item">Settings</a>
            <a href="#" class="dropdown-item">Back to Market</a>
            <hr class="dropdown-divider">
            <a href="#" class="dropdown-item" style="color:red"><i class="bi bi-box-arrow-in-left"></i> Log Out</a>
        </div>
    </div>
    <!-- </div> -->

</nav>

<!-- Navbar End -->