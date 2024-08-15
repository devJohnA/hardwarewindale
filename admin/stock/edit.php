<!-- Example of modal_edit.php -->
<div class="modal fade" id="editProductModal<?php echo $row['id']; ?>" tabindex="-1"
    aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form fields for editing -->
                <form action="update.php" method="POST" enctype="multipart/form-data"  id="editProductForm<?php echo $row['id']; ?>">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName"
                            value="<?php echo $row['productName']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Product Category</label>
                        <input type="text" class="form-control" id="productCategory" name="productCategory"
                            value="<?php echo $row['productCategory']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Product Price</label>
                        <input type="text" class="form-control" id="productPrice" name="productPrice"
                            value="<?php echo $row['productPrice']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="productStock" class="form-label">Product Stock</label>
                        <input type="text" class="form-control" id="productStock" name="productStock"
                        value="0">
                    </div>

                    <div class="mb-3">
                        <label for="checkStock" class="form-label">Set Stock Monitoring</label>
                        <input type="text" class="form-control" id="checkStock" name="checkStock"
                            value="<?php echo $row['checkStock']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="images" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="images" name="images">
                        <small class="text-muted">Leave empty if you don't want to change the image.</small>
                    </div>

                    <!-- Add more fields as needed -->

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.querySelectorAll('[id^="editProductForm"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const inputs = this.querySelectorAll('input:not([type="file"]):not([type="hidden"])');
        let isValid = true;
        let stockAdded = false;
        let otherFieldsUpdated = false;

        inputs.forEach(input => {
            if (input.value.trim() === '') {
                isValid = false;
            }
            if (input.name === 'productStock' && input.value !== '0' && input.value !== '') {
                stockAdded = true;
            }
            if (input.name !== 'productStock' && input.value !== input.defaultValue) {
                otherFieldsUpdated = true;
            }
        });

        if (isValid) {
            fetch(this.action, {
                method: this.method,
                body: new FormData(this)
            }).then(response => response.json())
            .then(data => {
                let message = data.message;
                let icon = data.success ? "success" : (data.info ? "info" : "error");

                Swal.fire({
                    text: message,
                    icon: icon,
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then((result) => {
                    if (result.isConfirmed && data.success) {
                        window.location.href = "index.php";
                    }
                });
            }).catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    text: "An error occurred. Please try again.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            });
        }
    });
});
</script>
