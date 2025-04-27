<?php
// Include database configuration
include 'config.php';

// Get prompt_id from request
$prompt_id = $_GET['pid'] ?? 0;


// Fetch all versions of the prompt, starting with the latest
$sql = "SELECT * FROM prompts WHERE prompt_id = $prompt_id and hidden = 0 ORDER BY version DESC";
$result = $conn->query($sql);

// Check if there are any versions available
if ($result->num_rows == 0) {
    die("No prompt versions found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>_Logix- View Prompt <?php echo $prompt_id ?></title>
    <link rel="stylesheet" href="assets/style.css">
    <script>
        function copyToClipboard(content) {
            // Create a temporary textarea to hold decoded text
            let tempTextarea = document.createElement("textarea");
            tempTextarea.value = content;
            document.body.appendChild(tempTextarea);
            tempTextarea.select();
            document.execCommand("copy");
            document.body.removeChild(tempTextarea);
            alert("Copied to clipboard!");
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Versions of Prompt <?php echo $prompt_id ?></h1>
        <a href="index.php" class="btn">Home</a> | <a href="hidden.php" class="btn">Archive</a>
        <table>
            <thead>
                <tr>
                    <th>Version</th>
                    <th>Name</th>
                    <th>Prompt</th>
                    <!--th>Last Updated</th-->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['version']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo nl2br($row['content']); ?></td>
                        <!--td><?php echo $row['updated_at']; ?></td-->
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a> |
                            <a href="branch.php?id=<?php echo $row['id']; ?>" class="btn">Branch</a> |
                            <a href="hide.php?id=<?php echo $row['id']; ?>" class="btn">Hide</a> |
	          <a href="#" onclick="copyToClipboard(`<?php echo addslashes($row['content']); ?>`); return false;">Copy</a>
                        </td>
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
