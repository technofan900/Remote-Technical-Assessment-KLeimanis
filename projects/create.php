<?php

require '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = trim($_POST['name']) ?? '';
    $description = trim($_POST['description']) ?? '';

    if (!empty($name) && !empty($description)) {

        $stmt = $pdo->prepare("INSERT INTO projects (name, description) VALUES (?,?)");
        $stmt->execute([$name, $description]);

        header('Location: ./read.php');
        exit;
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects & Issues Tracker</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/style.css">
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
                        <a class="nav-link active" href="../index.php">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="./read.php">Projects</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../issues/read.php">Issues</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <section class="py-3 bg-primary text-white text-left">
        <div class="container">
            <h1 class="display-5 fw-bold">
                Create project
            </h1>
        </div>
    </section>

    <section class="container my-5">
        <form method="POST">
            <div class="form-group pb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group pb-3">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description"></textarea>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="./read.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </section>


    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto fixed-bottom">
        <div class="container">
            <p class="mb-0">
                Projects & Issues Tracker
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>