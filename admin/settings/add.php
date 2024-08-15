<!-- Add Category Modal -->
<div class="modal fade" id="addDeliveryModal" tabindex="-1" aria-labelledby="addDeliveryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDeliveryModalLabel">Add New Delivery & Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <form class="form-horizontal span6" action="controller.php?action=add" method="POST">
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
