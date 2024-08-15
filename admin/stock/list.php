<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
            <div class="app-card-body" style="margin: 0 15px;">
                <div class="row">
                    <div class="col-lg-12" style="margin: 15px">
                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#newProductModal">
                            <i class="fa fa-plus-circle fw-fa"></i> New
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">ID</th>
                                <th class="cell">Image</th>
                                <th class="cell">Product name</th>
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
                                    $statusClass = 'badge bg-success text-white';
                                    if ($row['calculated_status'] == 'Low stock') {
                                        $statusClass = 'badge bg-warning ';
                                    } elseif ($row['calculated_status'] == 'Out of stock') {
                                        $statusClass = 'badge bg-danger text-white';
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
                                <td class="cell">&#8369;<?php echo $row['productPrice']; ?></td>
                                <td class="cell"><?php echo $row['productStock']; ?></td>
                                <td class="cell"><?php echo $row['productDate']; ?></td>
                                <td class="cell"><a class="btn-sm btn <?php echo $statusClass; ?>">
                                        <?php echo $row['calculated_status']; ?></a></td>
                                <td class="cell">
                                    <a href="#" class="btn btn-sm btn-primary me-1" data-bs-toggle="modal"
                                        data-bs-target="#editProductModal<?php echo $row['id']; ?>" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger delete-btn"
   data-id="<?php echo $row['id']; ?>"
   title="Delete">
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
<script>
$(document).ready(function () {
    $('#myTable').DataTable();
});

document.addEventListener('DOMContentLoaded', function () {
    // Event delegation for dynamically generated delete buttons
    document.querySelectorAll('.delete-btn').forEach(function (element) {
        element.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default link behavior

            var id = this.getAttribute('data-id');
            var url = 'delete.php?id=' + id;

            Swal.fire({
                title: 'Are you sure you want to delete this product?',
                text: "This action cannot be undone. The product will be permanently removed from your inventory.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'The product has been deleted successfully.',
                                    confirmButtonColor: '#3085d6'
                                }).then(() => {
                                    // Optionally, reload the page or remove the row from the table
                                    location.reload(); // Reload the page
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: data.message || 'There was a problem deleting the product.',
                                    confirmButtonColor: '#d33'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'There was a problem with the request.',
                                confirmButtonColor: '#d33'
                            });
                        });
                }
            });
        });
    });
});

</script>



<?php $conn->close(); ?>