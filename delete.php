/* delete.php - Delete a prompt */
<?php
include 'config.php';
$id = $_GET['id'];
$conn->query("DELETE FROM prompts WHERE id=$id"); /* instead of delete, just display or hide */
header("Location: index.php");
?>

/* */
/* display or hide each insert */
/* view.php will pull only with display */