<?php
require_once '../dbcon/conn.php';

$query = "SELECT productDetails FROM orderpos";
$result = $conn->query($query);

$productCounts = array();

while ($row = $result->fetch_assoc()) {
    $products = explode(', ', $row['productDetails']);
    foreach ($products as $product) {
        preg_match('/^(.*?)\s+(\d+)$/', $product, $matches);
        if (count($matches) == 3) {
            $productName = trim($matches[1]);
            $quantity = intval($matches[2]);
            if (!isset($productCounts[$productName])) {
                $productCounts[$productName] = 0;
            }
            $productCounts[$productName] += $quantity;
        }
    }
}

arsort($productCounts);

$data = array();
$count = 0;
foreach ($productCounts as $productName => $totalSold) {
    if ($count >= 10) break;
    $data[] = array(
        "label" => $productName,
        "y" => $totalSold
    );
    $count++;
}

echo json_encode($data);

$conn->close();
?>