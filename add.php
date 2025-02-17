<?php
// Include database configuration
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $content = $_POST['content'];

    // Get the next available prompt_id
    $promptIdResult = $conn->query("SELECT MAX(prompt_id) AS max_id FROM prompts");
    $row = $promptIdResult->fetch_assoc();
    $new_prompt_id = $row['max_id'] + 1;

    // Insert new prompt with initial version 1.0
    $sql = "INSERT INTO prompts (prompt_id, name, content, version, change_type, hidden, created_at, updated_at) 
            VALUES ($new_prompt_id, '$name', '$content', 1.0, 'Initial', 0, NOW(), NOW())";
    $conn->query($sql);
    
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Prompt</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>Add New Prompt</h1>
        <form action="add.php" method="POST">
            <label for="name">Prompt Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="content">Prompt Content:</label>
            <textarea id="content" name="content" required></textarea>
            
            <button type="submit" class="btn">Save Prompt</button>
        </form>
        <a href="index.php" class="btn">Back to Home</a>
    </div>
</body>
</html>
