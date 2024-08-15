<?php  
     if (!isset($_SESSION['USERID'])){
      redirect(web_root."admin/index.php");
     }

  @$USERID = $_GET['id'];
    if($USERID==''){
  redirect("index.php");
}
  $user = New User();
  $singleuser = $user->single_user($USERID);

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" action="controller.php?action=edit" method="POST" id="accountForm">
                    <fieldset>
                        <legend> Update User Account</legend>

                        <input class="form-control input-sm" id="USERID" name="USERID" type="hidden" value="<?php echo $singleuser->USERID; ?>">

                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="U_NAME">Name:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" id="U_NAME" name="U_NAME" placeholder="Account Name" type="text" value="<?php echo $singleuser->U_NAME; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="U_CON">Contact No.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" id="U_CON" name="U_CON" placeholder="Contact Number" type="text" value="<?php echo $singleuser->U_CON; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="U_PASS">Password:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" id="U_PASS" name="U_PASS" placeholder="Account Password" type="password" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="U_USERNAME">Email:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" id="U_USERNAME" name="U_USERNAME" placeholder="Username" type="text" value="<?php echo $singleuser->U_USERNAME; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="U_EMAIL">Address:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" id="U_EMAIL" name="U_EMAIL" placeholder="Email Address" type="text" value="<?php echo $singleuser->U_EMAIL; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="U_ROLE">Role:</label>
                                    <div class="col-md-8">
                                        <select class="form-control input-sm" name="U_ROLE" id="U_ROLE">
                                            <option value="Administrator" <?php echo ($singleuser->U_ROLE=='Administrator') ? 'selected="true"': '' ; ?>>Administrator</option>
                                            <option value="Staff" <?php echo ($singleuser->U_ROLE=='Staff') ? 'selected="true"': '' ; ?>>Staff</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary" name="save" type="submit"><span class="fa fa-save fw-fa"></span> Save</button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End of container-->

<script>
$(document).ready(function() {
    // Store initial values
    var initialValues = {
        U_NAME: $('#U_NAME').val(),
        U_USERNAME: $('#U_USERNAME').val(),
        U_CON: $('#U_CON').val(),
        U_EMAIL: $('#U_EMAIL').val(),
        U_ROLE: $('#U_ROLE').val()
    };

    // On form submit
    $('form').on('submit', function(e) {
        // Check if any changes were made
        if (
            $('#U_NAME').val() === initialValues.U_NAME &&
            $('#U_USERNAME').val() === initialValues.U_USERNAME &&
            $('#U_CON').val() === initialValues.U_CON &&
            $('#U_EMAIL').val() === initialValues.U_EMAIL &&
            $('#U_ROLE').val() === initialValues.U_ROLE &&
            $('#U_PASS').val() === ''
        ) {
            e.preventDefault();
            Swal.fire({
                icon: 'info',
                title: 'No changes made',
                text: 'Please make changes to the user before saving.'
            });
        }
    });
});
</script>