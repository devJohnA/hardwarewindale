<?php
require_once '../../admin/dbcon/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $productName = $_POST['productName'];
    $productCategory = $_POST['productCategory'];
    $productPrice = $_POST['productPrice'];
    $newStock = $_POST['productStock'];
    $checkStock = $_POST['checkStock'];

    // Get the current stock and other details from the database
    $currentDetailsQuery = "SELECT * FROM stocks WHERE id='$id'";
    $result = $conn->query($currentDetailsQuery);
    $currentDetails = $result->fetch_assoc();

    // Check if any changes were made
    $onlyStockUpdated = false;
    $changes = false;

    if ($newStock != 0) {
        $onlyStockUpdated = true;
    }

    if ($currentDetails['productName'] != $productName ||
        $currentDetails['productCategory'] != $productCategory ||
        $currentDetails['productPrice'] != $productPrice ||
        $currentDetails['checkStock'] != $checkStock ||
        (isset($_FILES['images']) && $_FILES['images']['name'])) {
        $changes = true;
        $onlyStockUpdated = false; // Other fields are changed
    }

    if ($changes || $onlyStockUpdated) {
        // Calculate the new total stock
        $totalStock = $currentDetails['productStock'] + $newStock;

        if (isset($_FILES['images']) && $_FILES['images']['name']) {
            $targetDir = "upload/";
            $fileName = basename($_FILES['images']['name']);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES['images']['tmp_name'], $targetFilePath)) {
                    $sql = "UPDATE stocks SET productName='$productName', productCategory='$productCategory', productPrice='$productPrice', productStock='$totalStock', checkStock='$checkStock', images='$fileName' WHERE id='$id'";
                    if ($conn->query($sql) === TRUE) {
                        echo json_encode(['success' => true, 'message' => 'Product updated successfully with new image']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error updating product: ' . $conn->error]);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error uploading file']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid file format. Please upload JPG, JPEG, PNG, or GIF files']);
            }
        } else {
            $sql = "UPDATE stocks SET productName='$productName', productCategory='$productCategory', productPrice='$productPrice', productStock='$totalStock', checkStock='$checkStock' WHERE id='$id'";
            if ($conn->query($sql) === TRUE) {
                if ($onlyStockUpdated) {
                    echo json_encode(['success' => true, 'message' => 'Stock added successfully']);
                } else {
                    echo json_encode(['success' => true, 'message' => 'Product updated successfully']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Error updating product: ' . $conn->error]);
            }
        }
    } else {
        echo json_encode(['success' => false, 'info' => true, 'message' => 'No changes made']);
    }
    exit();
}

$conn->close();
?>
