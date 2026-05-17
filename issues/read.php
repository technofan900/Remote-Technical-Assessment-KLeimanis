<?php

require '../config/database.php';

$stmt = $pdo->query("SELECT i.id, p.name, i.title, i.description, i.status, i.priority, i.created_at
                        FROM issues i
                        JOIN projects p ON i.project_id = p.id
                        ORDER BY created_at DESC;");
$issues = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                        <a class="nav-link" href="../projects/read.php">Projects</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../issues/read.php">Issues</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <section class="py-3 bg-primary text-white">
        <div class="container d-flex justify-content-between align-items-center">
            
            <h1 class="display-5 fw-bold mb-0">
                Issues:
            </h1>

            <a href="../issues/create.php" class="btn btn-success btn-lg">
                Create
            </a>

        </div>
    </section>

    <section class="container my-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Project</th>
                    <th scope="col">Title</th>
                    <th scope="col">description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php $count=1; foreach($issues as $issue) : ?>
                    <tr>
                        <th scope="row"><?= $count ?></th>
                        <td><?= htmlspecialchars($issue['name']) ?></th>
                        <td><?= htmlspecialchars($issue['title']) ?></th>
                        <td><?= htmlspecialchars($issue['description']) ?></th>
                        <td><?= htmlspecialchars($issue['status']) ?></th>
                        <td><?= htmlspecialchars($issue['priority']) ?></th>
                        <td><a href="./update.php?id=<?= $issue['id'] ?>" class="btn btn-warning">Edit</a></td>
                        <td>                        
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $issue['id'] ?>">
                            delete
                        </button>
                        </td>
                    </tr>


                    <div class="modal fade" id="deleteModal<?= $issue['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Delete Issue</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            Are you sure you want to delete:
                            <strong><?= htmlspecialchars($issue['name']) ?></strong>?
                        </div>

                        <div class="modal-footer">

                            <form method="POST" action="delete.php">
                                <input type="hidden" name="id" value="<?= $issue['id'] ?>">
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


                <?php $count++; endforeach; ?>
            </tbody>
        </table>
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