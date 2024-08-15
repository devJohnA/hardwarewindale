<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<?php

	 if (!isset($_SESSION['USERID'])){

      redirect(web_root."admin/index.php");

     }

     if (isset($_SESSION['success'])) {
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "'.$_SESSION['success'].'"
            });
        </script>';
        unset($_SESSION['success']);
    }

?>

<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body" style="margin: 0 15px;">
                <div class="row">
                    <div class="col-lg-12" style="margin: 15px">

                            <h1><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addUserModal">
                                <i class="fa fa-plus-circle fw-fa"></i> New
                            </button>
                            </h1>

                        </div>

                        <!-- /.col-lg-12 -->

                    </div>

                    <form action="controller.php?action=delete" Method="POST">

                        <div class="table-responsive">

                            <table id="myTable"
                                class="table app-table-hover mb-0 text-left">



                                <thead>

                                    <tr>

                                        <th>#</th>

                                        <th>

                                            <!-- <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">  -->

                                            Account Name
                                        </th>

                                        <th>Email Account</th>

                                        <th>Contact No.</th>

                                        <th>Address</th>

                                        <th>Role</th>

                                        <th>Action</th>



                                    </tr>

                                </thead>

                                <tbody>

                                    <?php 

				  		// $mydb->setQuery("SELECT * 

								// 			FROM  `tblusers` WHERE TYPE != 'Customer'");

				  		$mydb->setQuery("SELECT * 

											FROM  `tbluseraccount`");

				  		$cur = $mydb->loadResultList();



						foreach ($cur as $result) {

				  		echo '<tr>';

						  echo '<td width="3%" align="center" >' . $result->USERID.'</a></td>';

				  		// echo '<td width="5%" align="center"></td>';

				  		echo '<td>' . $result->U_NAME.'</a></td>';

						  echo '<td>'. $result->U_USERNAME.'</td>';

						  echo '<td>'. $result->U_CON.'</td>';

						  echo '<td>'. $result->U_EMAIL.'</td>';

				  		echo '<td>'. $result->U_ROLE.'</td>';

				  		if($result->USERID==$_SESSION['USERID'] || $result->U_ROLE=='Administrator' || $result->U_ROLE=='Staff') {

				  			$active = "Disabled";



				  		}else{

				  			$active = "";



				  		}



				  		echo '<td align="center" > <a title="Edit" href="#" class="btn btn-primary btn-sm edit-user-btn" 
                                                    data-id="' . $result->USERID . '" 
                                                    data-name="' . $result->U_NAME . '"
                                                    data-username="' . $result->U_USERNAME . '"
                                                    data-contact="' . $result->U_CON . '"
                                                    data-email="' . $result->U_EMAIL . '"
                                                    data-role="' . $result->U_ROLE . '">
                                                    <i class="fas fa-edit"></i>
                                                </a>

				  					 <a title="Delete" href="controller.php?action=delete&id='.$result->USERID.'" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash"></i></a>

				  					 </td>';

				  		echo '</tr>';

				  	} 

				  	?>

                                </tbody>



                            </table>



                            <!-- <div class="btn-group">

				  <a href="index.php?view=add" class="btn btn-default">New</a>

				  <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button>

				</div>

 -->

                        </div>

                    </form>





                </div>
                <!---End of container-->
            </div>
        </div>
    </div>
</div>

<?php 
include 'add.php';
?>

<?php 
include 'edit.php';
?>

<script>$(document).ready( function () {
    $('#myTable').DataTable();
} );</script>
<script>

$('.edit-user-btn').click(function() {
    var userId = $(this).data('id');
    var userName = $(this).data('name');
    var userUsername = $(this).data('username');
    var userContact = $(this).data('contact');
    var userEmail = $(this).data('email');
    var userRole = $(this).data('role');
    var userPass = ''; 

    // Populate the modal fields with user data
    $('#editUserModal #USERID').val(userId);
    $('#editUserModal #U_NAME').val(userName);
    $('#editUserModal #U_USERNAME').val(userUsername);
    $('#editUserModal #U_CON').val(userContact);
    $('#editUserModal #U_EMAIL').val(userEmail);
    $('#editUserModal #U_ROLE').val(userRole);
    $('#editUserModal #U_PASS').val(userPass);

    // Set the initial values for comparison
    $('#editUserModal').data('initialName', userName);
    $('#editUserModal').data('initialUsername', userUsername);
    $('#editUserModal').data('initialContact', userContact);
    $('#editUserModal').data('initialEmail', userEmail);
    $('#editUserModal').data('initialRole', userRole);
    $('#editUserModal').data('initialPass', userPass);
    

    $('#editUserModal #U_PASS').val('');
    // Show the modal
    $('#editUserModal').modal('show');
});

// Validation to check if no changes are made
$('#editUserModal form').on('submit', function(e) {
  var initialName = $('#editUserModal').data('initialName');
  var initialUsername = $('#editUserModal').data('initialUsername');
  var initialContact = $('#editUserModal').data('initialContact');
  var initialEmail = $('#editUserModal').data('initialEmail');
  var initialRole = $('#editUserModal').data('initialRole');
  var initialPass = $('#editUserModal').data('initialPass');

  var currentName = $('#editUserModal #U_NAME').val();
  var currentUsername = $('#editUserModal #U_USERNAME').val();
  var currentContact = $('#editUserModal #U_CON').val();
  var currentEmail = $('#editUserModal #U_EMAIL').val();
  var currentRole = $('#editUserModal #U_ROLE').val();
  var currentPass = $('#editUserModal #U_PASS').val();

  // Check if any changes were made
  if (initialName === currentName &&
            initialUsername === currentUsername &&
            initialContact === currentContact &&
            initialEmail === currentEmail &&
            initialRole === currentRole &&
            initialPass === currentPass) {

            e.preventDefault();
            Swal.fire({
                icon: 'info',
                title: 'No changes made',
                text: 'Please make changes to the user before saving.'
            });
        }
    });


$('.delete-btn').click(function(e) {
        e.preventDefault(); // Prevent the default link behavior
        var deleteUrl = $(this).attr('href'); // Get the URL from the link

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, redirect to the delete URL
                window.location.href = deleteUrl;
            }
        });
    });

</script>
