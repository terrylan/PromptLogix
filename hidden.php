<?php
// Include database configuration
include 'config.php';

// Fetch all hidden prompts
$result = $conn->query("SELECT * FROM prompts WHERE hidden = 1 ORDER BY updated_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hidden Prompts</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>Hidden Prompts</h1>
        <a href="delete.php" class="btn">Delete Archive</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prompt ID</th>
                    <th>Name</th>
                    <th>Version</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['prompt_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo $row['version']; ?></td>
                    <td><?php echo $row['updated_at']; ?></td>
                    <td>
                        <a href="unhide.php?id=<?php echo $row['id']; ?>" class="btn">Unhide</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn">Back to Home</a>
    </div>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> PromptLogix. All rights reserved.</p>
    </footer>
</body>
</html>
