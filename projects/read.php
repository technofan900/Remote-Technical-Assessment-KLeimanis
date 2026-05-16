<?php

require '../config/database.php';

$stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC;");
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

print_r($projects);

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
                Projects:
            </h1>
        </div>
    </section>

    <section class="container my-5">
        <div class="row g-4">
        <?php foreach ($projects as $project) : ?>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">
                        <h3 class="card-title text-primary">
                            <?= htmlspecialchars($project['name']); ?>
                        </h3>

                        <p class="card-text text-muted">
                            <?= htmlspecialchars($project['description']); ?>
                        </p>

                        <a href="./update.php?id=<?= $project['id'] ?>" class="btn btn-warning">
                            Edit Project
                        </a>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $project['id'] ?>">
                            Delete Project
                        </button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteModal<?= $project['id'] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Delete Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete:
                    <strong><?= htmlspecialchars($project['name']) ?></strong>?
                </div>

                <div class="modal-footer">

                    <form method="POST" action="delete.php">
                        <input type="hidden" name="id" value="<?= $project['id'] ?>">
                        <button type="submit" class="btn btn-danger">
                            Yes, Delete
                        </button>
                    </form>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                </div>

                </div>
            </div>
            </div>

        <?php endforeach; ?>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>