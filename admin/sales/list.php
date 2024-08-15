<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<?php
require_once '../../admin/dbcon/conn.php';


$query = "SELECT * FROM orderpos ORDER BY orderDate DESC";


$result = mysqli_query($conn, $query);
?>
<style>
@media print {
    body {
        margin: 0;
        padding: 0;
        text-align: center;
    }

    body * {
        visibility: hidden;
    }

    #orders-table-tab-content,
    #orders-table-tab-content * {
        visibility: visible;
    }

    #orders-table-tab-content {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    .no-print {
        display: none;
    }

    .table-responsive {
        margin: 0 auto;
        width: 80%;
    }
}
.bold-quantity {
    color: dodgerblue; 
}
</style>
<div class="tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body" style="margin: 0 15px;">
                <!-- <div class="search-container no-print">
                    <input type="text" id="searchInput" class="form-control" placeholder="Enter OR Number"
                        value="<?php echo htmlspecialchars($search_query); ?>" oninput="filterTable()">
                </div> -->
                
                <div class="table-responsive">
                    <table id="myTable" class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">OR Number</th>
                                <th class="cell">Products and Quantity</th>
                                <th class="cell">Total Price</th>
                                <th class="cell">Order Date</th>
                            </tr>
                        </thead>
                        <tbody id="orderTableBody">
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
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
                                    $sortableDate = $date->format('Y-m-d H:i:s'); 
                                    $formattedDate = $date->format('F d, Y H:i');
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['orNumber']) . "</td>";
                                    echo "<td>" . $formattedDetails . "</td>";
                                    echo "<td> &#8369;" . htmlspecialchars($row['totalPrice']) . "</td>";
                                    echo "<td>" . $formattedDate . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>No data available</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function printTable() {
    window.print();
}
</script>
<script>$(document).ready(function() {
    $('#myTable').DataTable({
        "order": [[3, "desc"]],
        "language": {
            "search": "Search OR Number:"
        },
        "columnDefs": [
            { "type": "date", "targets": 3 } 
        ]
    });
});</script>
