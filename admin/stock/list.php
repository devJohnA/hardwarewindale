<?php
require_once '../../admin/dbcon/conn.php';

$sql = "SELECT *,
        CASE
            WHEN productStock = 0 THEN 'Out of stock'
            WHEN productStock <= checkStock THEN 'Low stock'
            WHEN productStock != checkStock THEN 'Sufficient Stock'
            ELSE productStatus
        END AS calculated_status
        FROM stocks
        ORDER BY id DESC";

$result = $conn->query($sql);
?>

<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#newProductModal">
                            <i class="fa fa-plus-circle fw-fa"></i> New
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">ID</th>
                                <th class="cell">Image</th>
                                <th class="cell">Product item</th>
                                <th class="cell">Category</th>
                                <th class="cell">Price</th>
                                <th class="cell">Stock</th>
                                <th class="cell">Date of Product</th>
                                <th class="cell">Status</th>
                                <th class="cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $statusClass = 'btn-success';
                                    if ($row['calculated_status'] == 'Low stock') {
                                        $statusClass = 'btn-warning';
                                    } elseif ($row['calculated_status'] == 'Out of stock') {
                                        $statusClass = 'btn-danger';
                                    }
                            ?>
                            <tr>
                                <td class="cell"><?php echo $row['id']; ?></td>
                                <td class="cell">
                                    <img src="upload/<?php echo $row['images']; ?>" alt="Product Image"
                                        style="width: 50px; height: 50px;">
                                </td>
                                <td class="cell"><?php echo $row['productName']; ?></td>
                                <td class="cell"><?php echo $row['productCategory']; ?></td>
                                <td class="cell"><?php echo $row['productPrice']; ?></td>
                                <td class="cell"><?php echo $row['productStock']; ?></td>
                                <td class="cell"><?php echo $row['productDate']; ?></td>
                                <td class="cell"><a class="btn-sm btn <?php echo $statusClass; ?>">
                                        <?php echo $row['calculated_status']; ?></a></td>
                                <td class="cell">
                                    <a href="#" class="btn btn-sm btn-primary me-1" data-bs-toggle="modal"
                                        data-bs-target="#editProductModal<?php echo $row['id']; ?>" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger"
                                        title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this item?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                include 'edit.php'; // Include modal for each row
                                }
                            } else {
                                echo "<tr><td colspan='9'>No records found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'modal_add.php'; ?>

<?php $conn->close(); ?>