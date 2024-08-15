<?php
require_once('../dbcon/conn.php');

$sql = "SELECT productName, productStock FROM stocks";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>