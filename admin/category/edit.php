<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal span6" action="controller.php?action=edit" method="POST">
                    <input id="CATEGID" name="CATEGID" type="HIDDEN" value="">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="CATEGORY">Category:</label>
                        <div class="col-md-8">
                            <input class="form-control input-sm" id="CATEGORY" name="CATEGORY" placeholder="Category" type="text" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>