<?php
require_once('../dbcon/conn.php');

// check 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$month = isset($_GET['month']) ? $_GET['month'] : 'overall';
$dataPoints = [];

$colors = [
    "dodgerblue", "#ff7b00", "#ffb700", "#48ff00", "#00ffd5", "#002aff",
    "#fd2323", "#ff00c8", "#ff0000", "#00ff00", "#0000ff", "#ff00ff"
];

try {
    if ($month === 'overall') {
        $sql = "SELECT 
                    months.month,
                    COALESCE(SUM(o.totalPrice), 0) as order_total,
                    COALESCE(s.PAYMENT, 0) as summary_total
                FROM 
                    (SELECT 1 as month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4
                    UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8
                    UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) as months
                LEFT JOIN orderpos o ON months.month = MONTH(o.orderDate) AND YEAR(o.orderDate) = 2024
                LEFT JOIN (
                    SELECT MONTH(ORDEREDDATE) as month, SUM(PAYMENT) as PAYMENT
                    FROM tblsummary
                    WHERE YEAR(ORDEREDDATE) = 2024
                    GROUP BY MONTH(ORDEREDDATE)
                ) s ON months.month = s.month
                GROUP BY months.month
                ORDER BY months.month";
        
        $stmt = mysqli_prepare($conn, $sql);
    } else {
        $sql = "SELECT 
                    ?,
                    COALESCE(SUM(o.totalPrice), 0) as order_total,
                    COALESCE(s.PAYMENT, 0) as summary_total
                FROM 
                    (SELECT ? as month) as months
                LEFT JOIN orderpos o ON months.month = MONTH(o.orderDate) AND YEAR(o.orderDate) = 2024
                LEFT JOIN (
                    SELECT MONTH(ORDEREDDATE) as month, SUM(PAYMENT) as PAYMENT
                    FROM tblsummary
                    WHERE YEAR(ORDEREDDATE) = 2024 AND MONTH(ORDEREDDATE) = ?
                    GROUP BY MONTH(ORDEREDDATE)
                ) s ON months.month = s.month";
        
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'iii', $month, $month, $month);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $total = $row['order_total'] + $row['summary_total'];
        $month_index = ($month === 'overall') ? $row['month'] - 1 : $month - 1;

        $dataPoints[] = [
            "label" => date('F', mktime(0, 0, 0, $row['month'] ?? $month, 10)),
            "y" => $total,
            "color" => $colors[$month_index]
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($dataPoints, JSON_NUMERIC_CHECK);

} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
} finally {
    mysqli_close($conn);
}
?>