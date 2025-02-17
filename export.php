<?php
include 'config.php';

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=prompts_export.csv");

$output = fopen("php://output", "w");
fputcsv($output, ["ID", "Name", "Version", "Change Type", "Content", "Created At", "Updated At"]);

$result = $conn->query("SELECT * FROM prompts");
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [$row['id'], $row['name'], $row['version'], $row['change_type'], $row['content'], $row['created_at'], $row['updated_at']]);
}

fclose($output);
exit();
?>
