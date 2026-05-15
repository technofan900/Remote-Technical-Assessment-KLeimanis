<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects & Issues Tracker</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                Projects & Issues
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link active" href="./index.php">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="./projects/read.php">Projects</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="./issues/read.php">Issues</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h1 class="display-5 fw-bold">
                Project & Issue Management System
            </h1>

            <div class="mt-4">
                <a href="./projects/create.php" class="btn btn-light btn-lg me-2">
                    Create Project
                </a>

                <a href="./issues/create.php" class="btn btn-outline-light btn-lg">
                    Create Issue
                </a>
            </div>
        </div>
    </section>

    <!-- Dashboard Cards -->
    <section class="container my-5">

        <div class="row g-4">

            <!-- Projects Card -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">
                        <h3 class="card-title text-primary">
                            Projects
                        </h3>

                        <p class="card-text text-muted">
                            Manage software projects, update details,
                            and organize development tasks.
                        </p>

                        <a href="./projects/read.php" class="btn btn-primary">
                            View Projects
                        </a>
                    </div>

                </div>
            </div>

            <!-- Issues Card -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">
                        <h3 class="card-title text-danger">
                            Issues
                        </h3>

                        <p class="card-text text-muted">
                            Track bugs, tasks, feature requests,
                            and project-related problems.
                        </p>

                        <a href="./issues/read.php" class="btn btn-danger">
                            View Issues
                        </a>
                    </div>

                </div>
            </div>

        </div>

    </section>


    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto fixed-bottom">
        <div class="container">
            <p class="mb-0">
                Projects & Issues Tracker
            </p>
        </div>
    </footer>


</body>
</html>