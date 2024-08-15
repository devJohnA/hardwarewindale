<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="controller.php?action=add" method="POST">
                    <div class="col-md-6">
                        <label for="U_NAME" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="U_NAME" name="U_NAME" placeholder="Account Name" required>
                    </div>

                    <div class="col-md-6">
                        <label for="U_USERNAME" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="U_USERNAME" name="U_USERNAME" placeholder="Username" required>
                    </div>

                    <div class="col-md-6">
                        <label for="U_CON" class="form-label">Contact No:</label>
                        <input type="text" class="form-control" id="U_CON" name="U_CON" placeholder="Contact Number" required>
                    </div>

                    <div class="col-md-6">
                        <label for="U_EMAIL" class="form-label">Address:</label>
                        <input type="text" class="form-control" id="U_EMAIL" name="U_EMAIL" placeholder="Email Address" required>
                    </div>

                    <div class="col-md-6">
                        <label for="U_PASS" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="U_PASS" name="U_PASS" placeholder="Account Password" required>
                    </div>

                    <div class="col-md-6">
                        <label for="U_ROLE" class="form-label">Role:</label>
                        <select class="form-control" name="U_ROLE" id="U_ROLE" required>
                            <option value="Administrator">Administrator</option>
                            <option value="Staff">Staff</option>
                        </select>
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
