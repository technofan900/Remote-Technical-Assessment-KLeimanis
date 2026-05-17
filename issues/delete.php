<?php

require "../config/database.php";

$issue_id = $_POST['id'] ?? null;

if (!$issue_id) {
    die("Invalid request");
}

$stmt = $pdo->prepare("DELETE FROM issues WHERE id = ?");
$stmt->execute([$issue_id]);

header("Location: ./read.php");
exit;