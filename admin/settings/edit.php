<!-- Edit Category Modal -->
<div class="modal fade" id="editDeliveryModal" tabindex="-1" aria-labelledby="editDeliveryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDeliveryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal span6" action="controller.php?action=edit" method="POST">
                <input id="SETTINGID" name="SETTINGID" type="hidden"  value="">
                    <div class="form-group">
                        <label for="PLACE">Location:</label>
                        <input class="form-control input-sm" id="PLACE" name="PLACE" placeholder="Location"
                                    type="text" value="">

                    </div>

                    <div class="form-group">
                    <label for="DELPRICE">Price:</label>
                    <input class="form-control input-sm" id="DELPRICE" name="DELPRICE"
                    placeholder="Delivery Price" type="text" value="">

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
