<?php

require "../config/database.php";

$issue_id = $_GET['id'] ?? null;

if (!$issue_id) {
    die("Invalid issue ID");
}

$stmt = $pdo->prepare("SELECT * FROM issues WHERE id = ?");
$stmt->execute([$issue_id]);
$issue = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$issue) {
    die("Issue not found");
}

$stmt = $pdo->query("SELECT id, name FROM projects");
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
            "UPDATE issues
            SET project_id = ?, title = ?, description = ?, status = ?, priority = ?
            WHERE id = ?
            ");
        $stmt->execute([$project_id, $title, $description, $status, $priority, $issue_id]);

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
                Edit issue
            </h1>
        </div>
    </section>

    <?php if (!empty($errors)): ?>
        <div class="d-flex justify-content-center mt-3">
            <div class="alert alert-danger w-50 text-center" role="alert">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <section class="container my-5">
        <form method="POST">
            <div class="form-group pb-3">
                <label for="project">Project</label>
                <select name="project" id="project" class="form-select">
                    <option disabled>Select</option>
                    <?php foreach ($projects as $project): ?>
                        <option value="<?= $project['id'] ?>" <?= $project['id'] == $issue['project_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($project['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group pb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($issue['title']) ?>">
            </div>
            <div class="form-group pb-3">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description"><?= htmlspecialchars($issue['description']) ?></textarea>
            </div>
            <div class="form-group pb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="open" <?= $issue['status'] == 'open' ? 'selected' : '' ?>>Open</option>
                    <option value="in_progress" <?= $issue['status'] == 'in_progress' ? 'selected' : '' ?>>In progress</option>
                    <option value="closed" <?= $issue['status'] == 'closed' ? 'selected' : '' ?>>Closed</option>
                </select>
            </div>
            <div class="form-group pb-3">
                <label for="priority">Priority</label>
                <select name="priority" id="priority" class="form-select">
                    <option value="low" <?= $issue['priority'] == 'low' ? 'selected' : '' ?>>Low</option>
                    <option value="medium" <?= $issue['priority'] == 'medium' ? 'selected' : '' ?>>Medium</option>
                    <option value="high" <?= $issue['priority'] == 'high' ? 'selected' : '' ?>>High</option>
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