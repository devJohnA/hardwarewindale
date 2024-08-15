<?php
require '../../admin/dbcon/conn.php';

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $stmt = $conn->prepare("SELECT id, images, productName, productPrice, productStock FROM stocks WHERE productName LIKE ?");
    $search = "%".$query."%";
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = array();
    while ($row = $result->fetch_assoc()) {
        $row['imageUrl'] = '../stock/upload/' . $row['images'];
        $products[] = $row;
    }
    echo json_encode($products);
}
?>