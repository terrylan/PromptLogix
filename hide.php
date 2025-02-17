<?php
include 'config.php';
$id = $_GET['id'] ?? 0;

if ($id) {
    $conn->query("UPDATE prompts SET hidden = 1 WHERE id = $id");
}

header("Location: index.php");
exit();
?>
