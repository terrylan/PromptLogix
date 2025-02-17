<?php
// Include database configuration
include 'config.php';

// Get the existing prompt details
$id = $_GET['id'] ?? 0;
$result = $conn->query("SELECT * FROM prompts WHERE id=$id");
$row = $result->fetch_assoc();
if (!$row) {
    die("Prompt not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $content = $_POST['content'];
    $prompt_id = $row['prompt_id'];
    $new_version = $row['version'] + 0.1;
    
    // Insert a new version instead of updating the existing entry
    $sql = "INSERT INTO prompts (prompt_id, name, content, version, change_type, hidden, created_at, updated_at) 
            VALUES ($prompt_id, '$name', '$content', $new_version, 'Update', 0, NOW(), NOW())";
    $conn->query($sql);
    
    header("Location: view.php?id=$prompt_id");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Prompt</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Prompt</h1>
        <form action="edit.php?id=<?php echo $id; ?>" method="POST">
            <label for="name">Prompt Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
            
            <label for="content">Prompt Content:</label>
            <textarea id="content" name="content" required><?php echo htmlspecialchars($row['content']); ?></textarea>
            
            <button type="submit" class="btn">Save New Version</button>
        </form>
        <a href="index.php" class="btn">Back to Home</a>
    </div>
<?php
// Include footer
include 'assets/footer.php';
?>
</body>
</html>
