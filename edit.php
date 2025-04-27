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
    $name = trim($_POST['name']);
    $content = trim($_POST['content']);
    if ($name === '' || $content === '') die("Invalid input.");
    $prompt_id = $row['prompt_id'];
    $new_version = $row['version'] + 0.1;
    
    // Insert a new version instead of updating the existing entry
$stmt = $conn->prepare("INSERT INTO prompts (prompt_id, name, content, version, change_type, hidden, created_at, updated_at) 
                        VALUES (?, ?, ?, ?, 'Update', 0, NOW(), NOW())");
$stmt->bind_param("issd", $prompt_id, $name, $content, $new_version);
$stmt->execute();
$stmt->close();

    
    header("Location: view.php?pid=$prompt_id");
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
        <a href="index.php" class="btn">Home</a>
        <form action="edit.php?id=<?php echo $id; ?>" method="POST">
            <label for="name">Prompt Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?>" required>
            
            <label for="content">Prompt Content:</label>
            <textarea id="content" name="content" required><?php echo htmlspecialchars_decode($row['content']); ?></textarea>
            
            <button type="submit" class="btn">Save New Version</button>
        </form>
    </div>
<?php
// Include footer
include 'assets/footer.php';
?>
</body>
</html>
