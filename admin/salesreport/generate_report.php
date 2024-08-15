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
                background-color: #fd2323 !important;
                color: white !important;
                padding: 10px;
            }
            .custom-table td {
                border-bottom: 1px solid #black !important;
                padding: 8px;
            }
            @media print {
                .custom-table {
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                }
            }
        }
            .bold-quantity {
    color: dodgerblue; 
}
     .header-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 10px;
            }
            .logo {
                height: 100px; /* Adjust the height as needed */
            }
                .mb{
                margin-bottom:7px;
                }
    </style>';
      // Format and print header
      $fromDate = new DateTime($_POST['dateFrom']);
        $toDate = new DateTime($_POST['dateTo']);
        echo '<div class="header-container">';
        echo '<div>';
        echo '<p class="mb">Company Name: Windale Hardware</p>';
        echo '<p class="mb">Date Range: ' . $fromDate->format('F j, Y') . ' to ' . $toDate->format('F j, Y') . '</p>';
        echo '</div>';
        echo '<img src="../../img/windalelogo.jpg" alt="Windale Logo" class="logo">'; // Adjust the path to your logo
        echo '</div>';

        echo '<table class="table custom-table">';
        echo '<thead><tr><th>Product Details</th><th>Total Price</th><th>Order Date</th></tr></thead><tbody>';

        while ($row = $result->fetch_assoc()) {
            $overallTotalPrice += $row['totalPrice'];
            $productDetails = htmlspecialchars($row['productDetails']);

            $detailsArray = explode(", ", $productDetails);
            $formattedDetails = '';
            foreach ($detailsArray as $detail) {

                if (preg_match('/(.*?)(\d+)$/', $detail, $matches)) {
                    $product = $matches[1];
                    $quantity = $matches[2];
                    $formattedDetails .= $product . ' <span class="bold-quantity">' . $quantity . ' - Quantity</span><br>';
                } else {
                    $formattedDetails .= $detail . '<br>';
                }
            }
            $date = new DateTime($row['orderDate']);
            $formattedDate = $date->format('F - d - Y H:i');
            echo "<tr>";
            // echo "<td>" . htmlspecialchars($row['orNumber']) . "</td>";
            echo "<td>" . $formattedDetails . "</td>";
            echo "<td> &#8369;" . htmlspecialchars($row['totalPrice']) . "</td>";
            echo "<td>" . $formattedDate . "</td>";
            echo "</tr>";
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
