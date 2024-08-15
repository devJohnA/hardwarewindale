<?php
require_once '../../admin/dbcon/conn.php';

$dateFrom = $_POST['dateFrom'];
$dateTo = $_POST['dateTo'];

if (!empty($dateFrom) && !empty($dateTo)) {
    // Convert input dates to ensure no time component is considered
    $dateFrom .= ' 00:00:00';
    $dateTo .= ' 23:59:59';

    // Prepare the query with datetime bounds
    $stmt = $conn->prepare("SELECT orNumber, productDetails, totalPrice, orderDate FROM orderpos WHERE orderDate BETWEEN ? AND ?");
    $stmt->bind_param("ss", $dateFrom, $dateTo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $overallTotalPrice = 0;
        echo '<style>
        @media screen, print {
            .custom-table {
                width: 100%;
                border-collapse: collapse;
            }
            .custom-table thead th {
                background-color: #033f63 !important;
                color: white !important;
                padding: 10px;
            }
            .custom-table td {
                border-bottom: 1px solid #033f63 !important;
                padding: 8px;
            }
            @media print {
                .custom-table {
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                }
            }
        }
    </style>';
        echo '<table class="table custom-table">';
        echo '<thead><tr><th>OR Number</th><th>Product Details</th><th>Total Price</th><th>Order Date</th></tr></thead><tbody>';

        while ($row = $result->fetch_assoc()) {
            $overallTotalPrice += $row['totalPrice'];
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['orNumber']) . '</td>';
            echo '<td>' . htmlspecialchars($row['productDetails']) . '</td>';
            echo '<td>' . htmlspecialchars(number_format($row['totalPrice'], 2)) . '</td>';
            echo '<td>' . htmlspecialchars($row['orderDate']) . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
        echo '<div class="text-end" style="text-align: right;"><strong>Overall Total Price: </strong> <br>' . htmlspecialchars(number_format($overallTotalPrice, 2)) . '</div>';
    } else {
        echo '<p class="text-center">No records found for the selected date range.</p>';
    }

    $stmt->close();
} else {
    echo '<p class="text-center">Invalid date range.</p>';
}

$conn->close();
?>
