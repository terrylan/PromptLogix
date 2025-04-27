<?php
include 'config.php';

$id = $_GET['id'] ?? 0;

if ($id) {
    // Fetch prompt_id of the prompt being hidden
    $stmt = $conn->prepare("SELECT prompt_id FROM prompts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $pid = $row['prompt_id'];

        // Update the prompt to hidden
        $updateStmt = $conn->prepare("UPDATE prompts SET hidden = 1 WHERE id = ?");
        $updateStmt->bind_param("i", $id);
        $updateStmt->execute();

        // Check if there are remaining visible versions for this prompt_id
        $checkStmt = $conn->prepare("SELECT id FROM prompts WHERE prompt_id = ? AND hidden = 0");
        $checkStmt->bind_param("i", $pid);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows == 0) {
            // No more visible versions, redirect to home
            header("Location: /PromptLogix/");
            exit();
        } else {
            // Versions still exist, redirect to version list
            header("Location: view.php?pid=$pid");
            exit();
        }
    } else {
        echo "Prompt not found.";
    }
} else {
    echo "Invalid ID.";
}
?>
