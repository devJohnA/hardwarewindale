<?php
require_once '../../admin/dbcon/conn.php';

$search_query = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT * FROM orderpos";
if (!empty($search_query)) {
    $search_query = mysqli_real_escape_string($conn, $search_query);
    $query .= " WHERE orNumber LIKE '%$search_query%'";
}

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
</style>
<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="search-container no-print">
                    <input type="text" id="searchInput" class="form-control" placeholder="Enter OR Number"
                        value="<?php echo htmlspecialchars($search_query); ?>" oninput="filterTable()">
                </div>
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
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
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['orNumber']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['productDetails']) . "</td>";
                                    echo "<td> &#8369;" . htmlspecialchars($row['totalPrice']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['orderDate']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>No data available</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <button onclick="printTable()" class="btn btn-secondary mt-2 mb-2 no-print">Print Table</button>
            </div>
        </div>
    </div>
</div>
<script>
function filterTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("orderTableBody");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0]; // Assuming first column is OR Number
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function printTable() {
    window.print();
}
</script>
