<?php
// Include database configuration
include 'config.php';

// Fetch only the latest version of each prompt_id
$sql = "SELECT * FROM prompts WHERE version = (SELECT MAX(version) FROM prompts p2 WHERE p2.prompt_id = prompts.prompt_id) AND hidden = 0 ORDER BY updated_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>_logix - Home</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>_logix</h1>
        <a href="add.php" class="btn">New</a> | 
        <a href="hidden.php" class="btn">Archive</a> |
        <a href="export.php" class="btn">Export</a>
        <table>
            <thead>
                <tr>
                    <th>Prompt ID</th>
                    <th>Name</th>
                    <th>Version</th>
                    <th>Prompt</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['prompt_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['version']; ?></td>
                        <td><a href="view.php?pid=<?php echo $row['prompt_id']; ?>" class="btn"><?php echo $row['content']; ?></a></td>
                        <td><a href="#" onclick="copyToClipboard(`<?php echo addslashes($row['content']); ?>`); return false;">Copy</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php
// Include footer
include 'assets/footer.php';
?>
</body>
</html>
