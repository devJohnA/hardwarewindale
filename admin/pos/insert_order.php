<?php
require_once '../../admin/dbcon/conn.php';

$orNumber = $_POST['orNumber'];
$productDetails = $_POST['productDetails'];
$totalPrice = $_POST['totalPrice'];

$conn->begin_transaction();

try {

    $stmt = $conn->prepare("INSERT INTO orderpos (orNumber, productDetails, totalPrice) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $orNumber, $productDetails, $totalPrice);
    
    if ($stmt->execute()) {
        $products = explode(', ', $productDetails);
        
        foreach ($products as $product) {
            list($productName, $quantity) = explode(':', $product);
    $quantity = intval($quantity);
            
            $updateStmt = $conn->prepare("UPDATE stocks SET productStock = productStock - ? WHERE productName = ?");
            $updateStmt->bind_param("is", $quantity, $productName);
            $updateStmt->execute();
            $updateStmt->close();
        }
        
        $conn->commit();
        echo "Order inserted and stock updated successfully";
    } else {
        throw new Exception($stmt->error);
    }
} catch (Exception $e) {
    
    $conn->rollback();
    echo "Error: " . $e->getMessage();
} finally {
    $stmt->close();
    $conn->close();
}
?>