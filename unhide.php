<?php
// Include database configuration
include 'config.php';

// Get the ID from the URL
$id = $_GET['id'] ?? 0;

// Update the hidden status to 0 (unhide)
if ($id) {
    $stmt = $conn->prepare("UPDATE prompts SET hidden = 0 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Redirect back to hidden.php
header("Location: hidden.php");
exit();
?>
