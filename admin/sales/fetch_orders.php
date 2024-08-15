<?php
require '../../admin/dbcon/conn.php';

if (isset($_GET['orNumber'])) {
    $orNumber = $_GET['orNumber'];

    $query = "SELECT productName, productStock, productPrice FROM pos WHERE orNumber = '$orNumber'";
    $result = mysqli_query($conn, $query);

    $orders = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }

    echo json_encode($orders);
} else {
    echo json_encode(array()); 
}
?>