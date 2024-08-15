<?php
$query = "SELECT * FROM tblcategory";
$result = mysqli_query($conn, $query);
?>
<div class="modal fade" id="newProductModal" tabindex="-1" aria-labelledby="newProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newProductModalLabel">New Product Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="insert_stock.php" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="productName" id="productName">
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select class="form-control" name="productCategory" id="productCategory" required>
                            <option value="" disabled selected>Select a category</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['CATEGORIES']}'>{$row['CATEGORIES']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" name="productPrice" id="productPrice">
                    </div>
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Stock</label>
                        <input type="number" class=" form-control" name="productStock" id="productStock">
                    </div>
                    <div class="mb-3">
                        <label for="checkStock" class="form-label">Set Stock Monitoring</label>
                        <input type="text" class="form-control" name="checkStock" id="checkStock"
                            placeholder="Set a number">
                    </div>
                    <div class="mb-3">
                        <label for="productDate" class="form-label">Date of Product</label>
                        <input type="date" class="form-control" name="productDate" id="productDate">
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">Upload Image (Only JPG, JPEG, PNG, GIF): </label>
                        <input type="file" name="images" id="images" accept=".jpg, .jpeg, .png, .gif" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="productStatus" class="form-label">Status</label>
                        <input type="text" class="form-control" name="productStatus" id="productStatus">
                    </div> -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>