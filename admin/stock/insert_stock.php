<?php
require_once '../../admin/dbcon/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['form_submitted'])) {
        $_SESSION['form_submitted'] = true;

        $productName = $conn->real_escape_string($_POST['productName']);
        $productCategory = $conn->real_escape_string($_POST['productCategory']);
        $productPrice = $conn->real_escape_string($_POST['productPrice']);
        $productStock = $conn->real_escape_string($_POST['productStock']);
        $checkStock = $conn->real_escape_string($_POST['checkStock']);
        $productDate = $conn->real_escape_string($_POST['productDate']);

        $targetDir = "upload/";
        $fileName = basename($_FILES["images"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array(strtolower($fileType), $allowTypes)) {
            if (move_uploaded_file($_FILES["images"]["tmp_name"], $targetFilePath)) {
                $conn->begin_transaction();

                try {
    

                    $sql = "INSERT INTO stocks (productName, productCategory, productPrice, productStock, checkStock, productDate, images, productStatus)
                            VALUES ('$productName', '$productCategory', '$productPrice', $productStock, $checkStock, '$productDate', '$fileName', '$productStatus')";
                    $conn->query($sql);
                    
                    $conn->commit();

                    header("Location: ../../admin/stock/index.php");
                    exit();
                } catch (Exception $e) {
                    $conn->rollback();
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, GIF files are allowed.";
        }
    } else {
        echo "Form already submitted. Please do not refresh the page.";
    }
}

$conn->close();
?>