<?php

require '../config/database.php';

$stmt = $pdo->query("SELECT id, name FROM projects");
$issues = $stmt->fetchAll(PDO::FETCH_ASSOC);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $project_id = trim($_POST['project'] ?? '');
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status = trim($_POST['status'] ?? '');
    $priority = trim($_POST['priority'] ?? '');

    if (empty($project_id)) {
        $errors[] = "Project is required.";
    }

    if (empty($title)) {
        $errors[] = "Title is required.";
    }

    if (empty($description)) {
        $errors[] = "Description is required.";
    }

    if (empty($status)) {
        $errors[] = "Status is required.";
    }

    if (empty($priority)) {
        $errors[] = "Priority is required.";
    }

    if (empty($errors)) {

        $stmt = $pdo->prepare(
            "INSERT INTO issues (project_id, title, description, status, priority)
             VALUES (?,?,?,?,?)"
        );

        $stmt->execute([$project_id, $title, $description, $status, $priority]);

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
                Create issue
            </h1>
        </div>
    </section>

    <section class="container my-5">
        <form method="POST">
            <div class="form-group pb-3">
                <label for="project">Project</label>
                <select name="project" id="project" class="form-select">
                    <option selected disabled value="">Select</option>
                    <?php foreach($issues as $issue) : ?>
                    <option value="<?= $issue['id'] ?>"><?= $issue['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group pb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="form-group pb-3">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description"></textarea>
            </div>
            <div class="form-group pb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-select">
                    <option selected value="open">Open</option>
                    <option value="in_progress">In progress</option>
                    <option value="closed">Closed</option>
                </select>
            </div>
            <div class="form-group pb-3">
                <label for="priority">Priority</label>
                <select name="priority" id="priority" class="form-select">
                    <option value="low">Low</option>
                    <option selected value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
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