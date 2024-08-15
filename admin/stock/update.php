<?php
require_once '../../admin/dbcon/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $productName = $_POST['productName'];
    $productCategory = $_POST['productCategory'];
    $productPrice = $_POST['productPrice'];
    $productStock = $_POST['productStock'];
    $checkStock = $_POST['checkStock'];

    if (isset($_FILES['images']) && $_FILES['images']['name']) {
        $targetDir = "upload/";
        $fileName = basename($_FILES['images']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES['images']['tmp_name'], $targetFilePath)) {
                $sql = "UPDATE stocks SET productName='$productName', productCategory='$productCategory', productPrice='$productPrice', productStock='$productStock', checkStock='$checkStock', images='$fileName' WHERE id='$id'";
                if ($conn->query($sql) === TRUE) {
                    echo '<script>alert("Product updated successfully"); window.location.href = "index.php";</script>';
                    exit();
                } else {
                    echo "Error updating product: " . $conn->error;
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo 'Invalid file format. Please upload JPG, JPEG, PNG, or GIF files.';
        }
    } else {
        $sql = "UPDATE stocks SET productName='$productName', productCategory='$productCategory', productPrice='$productPrice', productStock='$productStock', checkStock='$checkStock' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Product updated successfully"); window.location.href = "index.php";</script>';
                    exit();
        } else {
            echo "Error updating product: " . $conn->error;
        }
    }
}

$conn->close();
?>