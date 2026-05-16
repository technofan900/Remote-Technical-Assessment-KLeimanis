<?php

require "../config/database.php";

$project_id = $_POST['id'] ?? null;

if (!$project_id) {
    die("Invalid request");
}

$stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
$stmt->execute([$project_id]);

header("Location: ./read.php");
exit;