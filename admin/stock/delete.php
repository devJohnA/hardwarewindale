<?php
require_once '../../admin/dbcon/conn.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM stocks WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete product.']);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare SQL statement.']);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No product ID specified.']);
}
?>
