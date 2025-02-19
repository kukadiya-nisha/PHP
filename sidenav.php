<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="css/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <style>
            .nav-link:hover {
                background-color: #dc3545 !important; /* Bootstrap 5 red color */
                color: white !important;
                transition: all 0.3s ease;
            }
            .dropdown-item:hover {
                background-color: #dc3545 !important;
                color: white !important;
                transition: all 0.3s ease;
            }
            .nav-pills .nav-link.active {
                background-color: #dc3545 !important;
            }
        </style>
        <button class="btn bg-light btn-dark d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidenavContent" aria-controls="sidenavContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse d-md-block" id="sidenavContent">
    <div class="d-flex flex-column flex-shrink-0 bg-light" style="width: 280px; min-height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none p-3">
        <span class="fs-4">Dashboard</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#" class="nav-link active bg-danger" aria-current="page">
                <i class="bi bi-house-door me-2"></i>
                Home
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">
                <i class="bi bi-table me-2"></i>
                Orders
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">
                <i class="bi bi-grid me-2"></i>
                Products
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">
                <i class="bi bi-person-circle me-2"></i>
                Customers
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown p-3">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>User Name</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</div>
</body>
</html>



